@extends('layouts.user.app')

@section('page_css')
    <style>
        .name-icon{
            position: absolute;
            z-index: 1;
            top: 15px;
            left: 13px;
            color: var(--iq-body-text);
            opacity: 0.3;
        }

        input#card-holder-name {
            padding-left: 2.8em;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
        }

        input#card-holder-name:focus {
            color: var(--iq-body-text) !important;
        }

        input#card-holder-name::placeholder {
            color: var(--iq-body-text) !important;
            opacity: 1 !important;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-dark d-flex justify-content-center" style="height: 180px;">
                <span class="my-auto">Ad banner</span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header border">Add Card</div>
                <div class="card-body border border-top-0">
                    <fieldset class="form-group">
                        <label class="form-label font-weight-bold" for="card-element">Cardholder's NAME</label>
                        <div class="position-relative">
                            <i class="fas fa-credit-card name-icon"></i>
                            <input type="text" class="form-control" id="card-holder-name" placeholder="Name on Card" required>
                        </div>
                    </fieldset>

                    <fieldset class="form-group">
                        <label class="form-label font-weight-bold" for="card-element">Credit or debit card</label>
                        <div id="card-element" class="form-control" style='height: 46px; padding-top: 14px;'>
                        </div>
                    </fieldset>

                    <button class="btn-addcard btn btn-primary" data-secret="{{ $intent->client_secret }}">
                        <i class="fas fa-check-circle mr-1"></i>
                        Add Payment Method
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('pk_test_FNr65o2BNvqYxDwR1THvXW0b00jwBRiEKE');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            style: {
                base: {
                    iconColor: '#6e6b7b',
                    color: '#6e6b7b',
                    fontSmoothing: 'antialiased',
                    ':-webkit-autofill': {
                        color: '#6e6b7b',
                    },
                    '::placeholder': {
                        color: '#6e6b7b',
                    },
                },
            },
        });

        cardElement.mount('#card-element');

        $('.btn-addcard').on('click', async (e) => {
            const btn = $('.btn-addcard');
            const clientSecret = btn.attr('data-secret');
            const name = $('#card-holder-name').val();

            btn.addClass('disabled').prop('disabled', true);

            const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: name
                        }
                    }
                }
            );

            if (error) {
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    timer: 1500,
                    icon: 'error',
                    position: 'center',
                    showConfirmButton: false
                });

                btn.removeClass('disabled').prop('disabled', false);
            } else {
                console.log(setupIntent);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    dataType: 'json',
                    url: "{{ route('user.payment-methods.store') }}",
                    data: {
                        pm_id: setupIntent.payment_method,
                        pm_holder: name
                    },
                    success: function (response) {
                        btn.removeClass('disabled').prop('disabled', false);

                        if(response.status){
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                timer: 1500,
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false
                            });

                            window.location.href = "{{ route('user.payment-methods.index') }}";
                        }
                    },
                    error: function (response, status, errorThrown) {
                        btn.removeClass('disabled').prop('disabled', false);
                        swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                    }
                });
            }

            return false;
        });
    </script>
@endsection