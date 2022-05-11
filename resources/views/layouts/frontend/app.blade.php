<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Stylesheets -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/dark.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/select2-bootstrap4.min.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/slick-animation.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/slick.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/typography.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/style.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/responsive.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/variable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .avatar-letter {
            background: var(--iq-primary);
            font-size: initial;
            color: white;
            font-weight: bold;
        }

        .img-box img {
            width: 254px;
            height: 142px;
            object-fit: contain;
        }

        .slick-aerrow-block {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slick-aerrow-block .slick-arrow {
            width: 30px !important;
            height: 30px !important;
            border-radius: 0px !important;
            text-align: center;
            opacity: 1;
            font-size: 24px;
            z-index: 9;
        }

        .slick-aerrow-block .slick-arrow {
            position: static;
            background: #86c240;
            margin: 0 0 0 10px;
            line-height: 5px;
            font-size: 80%;
            transform: none;
            color: #ffffff;
            transition: all 0.4s ease-in-out 0s;
        }

        .slick-aerrow-block .slick-arrow::before {
            display: none;
        }

        .block-social-info li.active span {
            background: var(--iq-primary);
            color: #FFFFFF;
        }
    </style>
    <style>
        .trailor-video {
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: 999;
            text-align: center;
        }

        [dir="rtl"] .trailor-video {
            left: 0;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    @yield('page_css')
</head>
<body>
<div id="loading">
    <div id="loading-center"></div>
</div>

@include('layouts.frontend.header')

<div class="content-page">
@yield('content')

@auth
    <!-- SUBSCRIPTION MODAL-->
        <div class="modal fade" id="subscription-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="subscription-modal-form" method="POST">
                        @csrf

                        <input type="hidden" name="type">

                        <div class="modal-header align-items-center">
                            <h5 class="modal-title text-dark">Review</h5>
                            <i class="fas fa-times fa-lg text-dark cursor-pointer" data-dismiss="modal"></i>
                        </div>
                        <div class="modal-body">
                            <fieldset class="mb-3">
                                <label class="form-label font-weight-bold">{{ __('Payment Method') }}</label>
                                <select class="form-control text-capitalize" name="payment_method" required>
                                    @if(isset(auth()->user()->userPaymentMethods) && auth()->user()->userPaymentMethods->isNotEmpty())
                                        @foreach(auth()->user()->userPaymentMethods as $payment_method)
                                            <option value="{{ $payment_method->id }}" class="text-capitalize">
                                                {{ $payment_method->pm_brand }} ending
                                                at {{ $payment_method->pm_last_four }}
                                                @if($payment_method->pm_default === 1) (default) @endif
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </fieldset>

                            <fieldset class="mb-3">
                                <label class="form-label font-weight-bold">{{ __('Price') }}</label>
                                <div class="price text-dark"></div>
                            </fieldset>

                            <fieldset>
                                <label class="form-label font-weight-bold">{{ __('Recurring Period') }}</label>
                                <div class="text-dark">Monthly</div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-arrow-right mr-1"></i>
                                Continue
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endauth

@include('layouts.frontend.footer')

<!-- Scripts -->
<script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('frontend/js/flatpickr.min.js')}}"></script>
{{--        <script src="{{asset('frontend/js/popper.min.js')}}"></script>--}}
{{--        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/slick-animation.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script>
    $('#subscription-modal').on('show.bs.modal', function (e) {
        const btn = $(e.relatedTarget);
        const modal = $(this);

        const price = btn.attr('data-price');
        const type = btn.attr('data-type');

        modal.find('.price').text('$' + price);
        modal.find('[name="type"]').val(type);
        modal.find('form').attr('action', btn.attr('data-action'));
    });

    $('#main-search').on('keydown', delay((e) => {
        const input = $(e.currentTarget);
        const icon = input.prev().find('i');
        const list = input.parent().next('ul');

        if(input.val() === '') return false;

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: "GET",
            dataType: 'json',
            url: "{{ route('pagination.search') }}",
            data: {
                term: input.val()
            },
            beforeSend: function () {
                list.hide().empty();
                icon.removeClass('ri-search-line').addClass('fas fa-spinner fa-pulse');
            },
            success: function (response) {
                icon.removeClass('fas fa-spinner fa-pulse').addClass('ri-search-line');

                if (response.data.length) {
                    let items = '';

                    $.each(response.data, (i, item) => {
                        items +=
                            '<li>' +
                            '   <a href="' + item.route + '" class="d-flex px-2 py-3">' +
                            '       <img src="' + item.poster + '" class="img-fluid mr-3 rounded" style="width: 75px; height: 75px;">' +
                            '       <div class="text-left w-100">' +
                            '           <div class="font-size-lg text-capitalize text-light">' + item.title + '</div>' +
                            '           <div class="small text-light text-capitalize">' + item.modal + '</div>' +
                            '           <div class="small text-light d-flex justify-content-between">' +
                            '               <span>' + item.duration + '</span>' +
                            '               <span class="small text-light text-right">' + item.created_at_ago + '</span>' +
                            '           </div>' +
                            '       </div>' +
                            '   </a>' +
                            '</li>';
                    });

                    list.append(items).show();
                } else {
                    list.append('<li class="text-center p-2">No result found!</li>').show();
                }
            },
            error: function (response, status, errorThrown) {
                icon.removeClass('fas fa-spinner fa-pulse').addClass('ri-search-line');
                swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
            }
        });
    }, 500));
</script>
@yield('page_js')
</body>
</html>
