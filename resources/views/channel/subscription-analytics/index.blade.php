@extends('layouts.channel.app')

@section('page_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.29.0/apexcharts.min.css"
          integrity="sha512-Tv+8HvG00Few62pkPxSs1WVfPf9Hft4U1nMD6WxLxJzlY/SLhfUPFPP6rovEmo4zBgwxMsArU6EkF11fLKT8IQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .input-group-prepend .input-group-text {
            border-radius: 0.25rem 0 0 0.25rem !important;
        }

        .rounded-left-0 {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-8">
            <div class="card">
                <div class="card-header border-0">Subscription Prices</div>
                <div class="card-body border">
                    <form id="subscription-prices">
                        <fieldset class="form-group mb-3">
                            <label class="form-label font-weight-bold d-block">Subscription Price Without Ads</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text border">$</span></div>
                                <input type="text" class="form-control rounded-left-0"
                                       name="subscription_price_without_ads"
                                       placeholder="Type in the price without ads"
                                       value="{{ $channel->subscription_price_without_ads }}" required>
                            </div>
                        </fieldset>
                        <fieldset class="form-group mb-3">
                            <label class="form-label font-weight-bold d-block">Subscription Price With Ads</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text border">$</span></div>
                                <input type="text" class="form-control rounded-left-0"
                                       name="subscription_price_with_ads"
                                       placeholder="Type in the price with ads"
                                       value="{{ $channel->subscription_price_with_ads }}" required>
                            </div>
                        </fieldset>
                        <fieldset class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle mr-1"></i>
                                Update
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header border-0">
                    Basic Analytics
                </div>
                <div class="card-body border">
                    <fieldset class="d-flex justify-content-between mb-3">
                        <div id="basic-analytics"></div>
                    </fieldset>

                    <fieldset class="d-flex align-items-center mb-1">
                        <i class="fas fa-square mr-2" style="color: #e20e02;"></i>
                        <div class="d-flex justify-content-between line-height w-100">
                            <span>Subscribers without <br> Ads</span>
                            <span>345334</span>
                        </div>
                    </fieldset>

                    <fieldset class="d-flex align-items-center mb-1">
                        <i class="fas fa-square mr-2" style="color: #f68a04;"></i>
                        <div class="d-flex justify-content-between line-height w-100">
                            <span>Subscribers with <br> Ads</span>
                            <span>345334</span>
                        </div>
                    </fieldset>

                    <fieldset class="d-flex align-items-center mb-1">
                        <i class="fas fa-square mr-2" style="color: #007aff;"></i>
                        <div class="d-flex justify-content-between align-items-center line-height w-100">
                            <span>Revenue</span>
                            <span>345334</span>
                        </div>
                    </fieldset>

                    <fieldset class="d-flex align-items-center mb-1">
                        <i class="fas fa-square mr-2" style="color: #545e75;"></i>
                        <div class="d-flex justify-content-between align-items-center line-height w-100">
                            <span>Yearly Revenue</span>
                            <span>345334</span>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center border-0">
                    <span>Monthly Subscribers Revenue</span>
                    <select class="select-select2" name="monthly-subscribers-revenue-year">
                    </select>
                </div>
                <div class="card-body border">
                    <canvas id="monthly-subscribers-revenue" width="auto" height="300"></canvas>
                </div>
            </div>

            <div class="card">
                <div class="card-header border-0">
                    Monthly Subscribers
                </div>
                <div class="card-body border">
                    <canvas id="monthly-subscribers" width="auto" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"
            integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.29.0/apexcharts.min.js"
            integrity="sha512-fe6OklXva8AWoqdwgkE7Ni4uWgHGWxFQWZx4lYehzY2Qrst5YfogjAbnLd6egsoTrnjGI9/LYt1Ont2cKNbP2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(window).on('load', e => {
            $('#subscription-prices').on('submit', function (e) {
                const form = $(this);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    dataType: 'json',
                    url: "{{ route('channel.subscription-analytics.store') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        form.find('button:submit').addClass('disabled').prop('disabled', true);
                    },
                    success: function (response) {
                        form.find('button:submit').removeClass('disabled').prop('disabled', false);

                        if (response.status) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                timer: 1500,
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function (response, status, errorThrown) {
                        form.find('button:submit').removeClass('disabled').prop('disabled', false);
                        swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                    }
                });

                return false;
            });

            // Determine the Current Year.
            let currentYear = (new Date()).getFullYear();

            // Loop and add the Year values to DropDownList.
            for (let i = 1950; i <= currentYear; i++) {
                $('[name="monthly-subscribers-revenue-year"]').prepend('<option value="' + i + '">' + i + '</option>');
            }

            $('.select-select2').select2({
                theme: 'bootstrap4',
                width: '25%',
                placeholder: 'Please select option',
            });

            const basicAnalytics = new ApexCharts(document.getElementById("basic-analytics"), {
                series: [44, 55, 30, 30],
                chart: {
                    width: 250,
                    type: 'donut',
                },
                labels: ["Subscribers without Ads", "Subscribers with Ads", "Revenue", "Yearly Revenue"],
                colors: ['#e20e02', '#f68a04', '#007aff', '#545e75'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: false,
                    width: 0
                },
                legend: {
                    show: false,
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }).render();

            const monthlySubscribersRevenue = new Chart(document.getElementById('monthly-subscribers-revenue').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'july'],
                    datasets: [
                        {
                            label: 'Revenue',
                            data: [310, 123, 2354, 234],
                            backgroundColor: ['#e20e02', '#f68a04', '#007aff', '#545e75']
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                },
            });

            const monthlySubscribers = new Chart(document.getElementById('monthly-subscribers').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'july'],
                    datasets: [
                        {
                            label: 'Male',
                            data: [310, 123, 2354, 234],
                            backgroundColor: ['#e20e02', '#f68a04', '#007aff', '#545e75']
                        },
                        {
                            label: 'Female',
                            data: [310, 123, 2354, 234],
                            backgroundColor: ['#e20e02', '#f68a04', '#007aff', '#545e75']
                        },
                        {
                            label: 'Age',
                            data: [310, 123, 2354, 234],
                            backgroundColor: ['#e20e02', '#f68a04', '#007aff', '#545e75']
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                },
            });
        });
    </script>
@endsection