/*
 * Crud.js
 * Description: A Js Class that can perform crud operations with datatables and bootstrap modals with ease
 * Author: MR_AMDEV
 * Copyright (c) 2021. This class is made by the author to be intended used for free. No reselling is allowed although a permission from the developer is needed.
 */

class Crud {
    constructor(options = {}) {
        Object.assign(this, {
            table: null,
            datatables: '.datatables',
            toggleSelector: '.btn-toggle',
            columns: [],
            data: null,
            methods: {
                create: true,
                read: true,
                update: true,
                delete: true,
                toggle: true,
            },
            routes: {
                index: null,
                store: null,
            },
            callbacks: {
                create: null,
                read: null,
                update: null,
                delete: null,
                toggle: null,
            }
        }, options);

        // Initiate all registered events
        this.registerEvents();
    }

    registerEvents() {
        if (this.routes.index) this.initDataTable();
        if (this.methods.create && this.routes.store) this.create();
        if (this.methods.read) this.read();
        if (this.methods.update) this.update();
        if (this.methods.delete) this.delete();
        if (this.methods.toggle) this.toggle();
    }

    initDataTable() {
        let _this = this;

        _this.table = $(_this.datatables).DataTable({
            scrollY: '100%',
            scrollCollapse: true,
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: _this.routes.index,
                data: function (data) {
                    if(_this.data !== null && !$.isEmptyObject(_this.data)){
                        $.each(_this.data, (key, value) => {
                            data[key] = value;
                        });
                    }

                    return data;
                },
            },
            responsive: true,
            columns: _this.columns
        });
    }

    create() {
        let _this = this;

        $('#create-modal-form').on('submit', function (e) {
            const form = $(this);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: 'json',
                url: _this.routes.store,
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    form.find('button:submit').addClass('disabled').prop('disabled', true);
                },
                success: function (response) {
                    form.find('button:submit').removeClass('disabled').prop('disabled', false);

                    if (_this.callbacks.create && typeof (_this.callbacks.create) === "function") {
                        _this.callbacks.create(response, form);
                    }

                    if (response.status) {
                        _this.table.ajax.reload();
                        $('#create-modal').modal('hide');
                    } else {
                        swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function (response, status, errorThrown) {
                    form.find('button:submit').removeClass('disabled').prop('disabled', false);
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                }
            });

            return false;
        });
    }

    read() {
        let _this = this;

        // Get/Read/Retrieve data for edit form in edit modal
        $('#edit-modal').on('show.bs.modal', function (e) {
            const btn = $(e.relatedTarget);
            const url_edit = btn.attr('data-url-edit');
            const url_update = btn.attr('data-url-update');
            const modal = $(this);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "GET",
                dataType: 'json',
                url: url_edit,
                success: function (response) {
                    if (_this.callbacks.read && typeof (_this.callbacks.read) === "function") {
                        _this.callbacks.read(response, modal);
                    } else {
                        console.log('No Callback is provided!', response);
                    }
                },
                error: function (response, status, errorThrown) {
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                }
            });

            modal.find('form').attr({
                'data-url': url_update
            });
        });
    }

    update() {
        let _this = this;

        $('#edit-modal-form').on('submit', function (e) {
            const form = $(this);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: 'json',
                url: form.attr('data-url'),
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    form.find('button:submit').addClass('disabled').prop('disabled', true);
                },
                success: function (response) {
                    form.find('button:submit').removeClass('disabled').prop('disabled', false);

                    if (_this.callbacks.update && typeof (_this.callbacks.update) === "function") {
                        _this.callbacks.update(response, form);
                    }

                    if (response.status) {
                        _this.table.ajax.reload();
                        $('#edit-modal').modal('hide');
                    } else {
                        swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function (response, status, errorThrown) {
                    form.find('button:submit').removeClass('disabled').prop('disabled', false);
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                }
            });

            return false;
        });
    }

    delete() {
        let _this = this;

        $(document).on('click', '.btn-delete', function (e) {
            let url = $(e.currentTarget).attr('data-url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "DELETE",
                        dataType: 'json',
                        url: url,
                        success: function (response) {
                            if (_this.callbacks.delete && typeof (_this.callbacks.delete) === "function") {
                                _this.callbacks.delete(response);
                            }

                            if (response.status) {
                                _this.table.ajax.reload();
                            } else {
                                swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function (response, status, errorThrown) {
                            swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                        }
                    });
                }
            });
        });
    }

    toggle() {
        let _this = this;

        $(document).on('click', _this.toggleSelector, function (e) {
            const url = $(e.currentTarget).attr('data-url');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                dataType: 'json',
                url: url,
                success: function (response) {
                    if (_this.callbacks.toggle && typeof (_this.callbacks.toggle) === "function") {
                        _this.callbacks.toggle(response);
                    }

                    if (response.status) {
                        _this.table.ajax.reload();
                    } else {
                        swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function (response, status, errorThrown) {
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                }
            });

            return false;
        });
    }

    refreshTable(){
        let _this = this;
        _this.table.ajax.reload();
    }
}