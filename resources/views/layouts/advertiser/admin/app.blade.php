<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Stylesheets -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">
{{--    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/developer.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/variable.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/typography-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/spacer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >
    @yield('page_css')
</head>
<body class="sidebar-main">
<div id="loading">
    <div id="loading-center"></div>
</div>

<div class="wrapper">
    @include('layouts.advertiser.admin.sidebar')
    @include('layouts.advertiser.admin.header')

    <div id="content-page" class="content-page mb-3">
    @yield('content')

    <!-- CHOOSE MODAL -->
        <div class="modal fade" id="choose-modal">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Choose Media</h5>
                        <button class="btn btn-default btn-sm" data-dismiss="modal">
                            <i class="fas fa-times fa-lg"></i>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <ul class="nav nav-tabs nav-justified mb-0" id="choose-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="choose-upload-tab" data-toggle="tab"
                                   href="#choose-upload-content">Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="choose-media-tab" data-toggle="tab" href="#choose-media-content">
                                    Media
                                    <i class="fas fa-spinner fa-pulse ml-2" style="display: none"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="choose-content">
                            <div class="tab-pane fade show active" id="choose-upload-content">
                                <section class="section-1 h-100 p-5">
                                    <div class="mx-auto bg-light rounded-circle text-dark d-flex justify-content-center mb-4"
                                         style="height: 150px; width: 150px;">
                                        <i class="fas fa-upload fa-4x my-auto"></i>
                                    </div>
                                    <h5 class="text-center">Please select a file to upload</h5>
                                    <fieldset class="my-3 text-center">
                                        <div class="custom-file" style="width: 400px">
                                            <input type="file" class="custom-file-input cursor-pointer" name="media"
                                                   id="choose-media-input" required>
                                            <label class="btn btn-primary bg-primary text-light d-none-after custom-file-label text-truncate"
                                                   for="choose-media-input">Choose media</label>
                                        </div>
                                    </fieldset>
                                </section>

                                <section class="section-2 h-100 p-5" style="display: none">
                                    <fieldset class="mb-3 h5">
                                        <h5 class="mb-1">Uploading ...</h5>
                                        <div class="progress rounded-0 mb-3" style="height: 30px;">
                                            <div class="progress-bar upload-progress-bar">0%</div>
                                        </div>
                                        <h6 class="text-center">Please keep the page open until its uploaded!</h6>
                                    </fieldset>
                                </section>
                            </div>
                            <div class="tab-pane fade p-4" id="choose-media-content">
                                <div class="row"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.advertiser.admin.footer')

<!-- Scripts -->
<script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/js/flatpickr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
{{--<script src="{{ asset('dashboard/js/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('dashboard/js/slick.min.js') }}"></script>
<script src="{{ asset('dashboard/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('dashboard/js/custom.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.appear.js') }}"></script>
<script src="{{ asset('dashboard/js/countdown.min.js') }}"></script>
<script src="{{ asset('dashboard/js/select2.min.js') }}"></script>
<script src="{{ asset('dashboard/js/waypoints.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('dashboard/js/wow.min.js') }}"></script>
<script src="{{ asset('dashboard/js/smooth-scrollbar.js') }}"></script>
<script src="{{ asset('dashboard/js/apexcharts.js') }}"></script>
<script src="{{ asset('dashboard/js/chart-custom.js') }}"></script>
<script src="{{ asset('dashboard/js/rtl.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/Crud-B4.js') }}"></script>
<script src="{{ asset('js/Classes/ChooseMedia.js') }}"></script>
<script>
    $('.modal').on("hidden.bs.modal", function (e) { //fire on closing modal box
        if ($('.modal:visible').length) { // check whether parent modal is opend after child modal close
            $('body').addClass('modal-open'); // if open mean length is 1 then add a bootstrap css class to body of the page
        }
    });

    window.config = {
        asset: "{{ asset('') }}",
        storage: "{{ asset('storage') }}" + "/",
        media: "{{ asset('private/media') }}" + "/"
    }
</script>
@yield('page_js')
</body>
</html>
