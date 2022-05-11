<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Stylesheets -->
        <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
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
        <link rel="stylesheet" href="{{ asset('dashboard/css/select2-bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/variable.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/typography.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/typography-rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/spacer.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
              integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <style>
            .dataTables_scrollBody{
                min-height: 200px;
            }
            .table img,
            .table video {
                height: 50px;
            }
            .select2-container--bootstrap4.select2-container--focus .select2-selection{
                box-shadow: none !important;
                cursor: text !important;
            }
            .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__rendered{
                padding: 0;
            }
            .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__rendered .select2-search__field{
                width: 80% !important;
                margin: 0px;
                height: auto;
                padding: 0.175rem 0.55rem;
            }
            .select2-selection__choice{
                margin: 0.4rem !important;
            }
            .select2-container .select2-selection--multiple{
                display: inline-block;
                padding: 0.2rem;
                height: auto !important;
                cursor: text;
            }
            .select2-container--bootstrap4.select2-container--open .select2-selection{
                border: 1px solid lightgray !important;
                border-radius: 3px !important;
            }
            .cursor-pointer{
                cursor: pointer !important;
            }
        </style>
        <style>
        
            .select2.select2-container {
                width: 100% !important;
            }
        
            .select2.select2-container .select2-selection {
                border: 1px solid #ccc;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                height: 34px;
                margin-bottom: 15px;
                outline: none !important;
                transition: all .15s ease-in-out;
            }
        
            .select2.select2-container .select2-selection .select2-selection__rendered {
                color: #333;
                line-height: 32px;
                padding-right: 33px;
            }
        
            .select2.select2-container .select2-selection .select2-selection__arrow {
                background: #f8f8f8;
                border-left: 1px solid #ccc;
                -webkit-border-radius: 0 3px 3px 0;
                -moz-border-radius: 0 3px 3px 0;
                border-radius: 0 3px 3px 0;
                height: 32px;
                width: 33px;
            }
        
            .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
                background: #f8f8f8;
            }
        
            .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
                -webkit-border-radius: 0 3px 0 0;
                -moz-border-radius: 0 3px 0 0;
                border-radius: 0 3px 0 0;
            }
        
            .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
                border: 1px solid #34495e;
            }
        
            .select2.select2-container .select2-selection--multiple {
                height: auto;
                min-height: 34px;
            }
        
            .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
                margin-top: 0;
                height: 32px;
            }
        
            .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
                display: block;
                padding: 0 4px;
                line-height: 29px;
            }
        
            .select2.select2-container .select2-selection--multiple .select2-selection__choice {
                background-color: #f8f8f8;
                border: 1px solid #ccc;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                margin: 4px 4px 0 0;
                padding: 0 6px 0 22px;
                height: 24px;
                line-height: 24px;
                font-size: 12px;
                position: relative;
            }
        
            .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
                position: absolute;
                top: 0;
                left: 0;
                height: 22px;
                width: 22px;
                margin: 0;
                text-align: center;
                color: #e74c3c;
                font-weight: bold;
                font-size: 16px;
            }
        
            .select2-container .select2-dropdown {
                background: transparent;
                border: none;
                /*margin-top: -5px;*/
            }
        
            .select2-container .select2-dropdown .select2-search {
                padding: 0;
            }
        
            .select2-container .select2-dropdown .select2-search input {
                outline: none !important;
                border: none !important;
                padding: 4px 6px !important;
                border-radius: 0;
            }
        
            .select2-container .select2-dropdown .select2-results {
                padding: 0;
            }
        
            .select2-container .select2-dropdown .select2-results ul {
                background: #FFFFFF !important;
                border: none !important;
                color: black !important;
            }
        
            .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
                background-color: #86c240;
            }
            
            .d-none-after::after {
                display: none !important;
            }
        </style>
        <style>
            .hover-border {
                border: 2px solid transparent;
                border-radius: .25rem;
            }
        
            .hover-border:hover,
            .hover-border.active {
                border: 2px solid aliceblue;
            }
        </style>
        @yield('page_css')
    </head>
    <body class="sidebar-main">
        <div id="loading">
            <div id="loading-center"></div>
        </div>
        
        <div class="wrapper">
            @include('layouts.admin.sidebar')
            @include('layouts.admin.header')
            
            <div id="content-page" class="content-page mb-3">
                @yield('content')

                <!-- Choose Modal -->
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

        @include('layouts.admin.footer')
        
        <!-- Scripts -->
        <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/flatpickr.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
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
        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="{{ asset('js/Crud-B4.js') }}"></script>
        <script src="{{ asset('js/Classes/ChooseMedia.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"
                integrity="sha512-llCHNP2CQS+o3EUK2QFehPlOngm8Oa7vkvdUpEFN71dVOf3yAj9yMoPdS5aYRTy8AEdVtqUBIsVThzUSggT0LQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('.modal').on("hidden.bs.modal", function (e) { //fire on closing modal box
                if ($('.modal:visible').length) { // check whether parent modal is opend after child modal close
                    $('body').addClass('modal-open'); // if open mean length is 1 then add a bootstrap css class to body of the page
                }
            });
        </script>
        <script>
            window.config = {
                asset: "{{ asset('') }}",
                storage: "{{ asset('storage') }}" + "/",
                media: "{{ asset('private/media') }}" + "/"
            }
        </script>
        @yield('page_js')
    </body>
</html>
