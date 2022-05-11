<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Themesdesign">
    <meta name="description" content="Premium Bootstrap 4 Landing Page Template">
    <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link href="{{ asset('destin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('destin/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('destin/css/style.min.css') }}" rel="stylesheet">
    <style>
        .is-sticky .navbar-custom {
            background-color: black;
        }

        .is-sticky .navbar-nav li a {
            color: #ffffff !important;
        }

        .is-sticky .navbar-custom .navbar-nav li.active a, .is-sticky .navbar-custom .navbar-nav li a:hover, .is-sticky .navbar-custom .navbar-nav li a:active {
            color: #86c240 !important;
        }

        .section:nth-of-type(2) {
            /*background:  #282C35;*/
            background: linear-gradient(180deg, rgba(39, 39, 38, 0.9897001036742822) 17%, rgba(0, 0, 0, 1) 80%);
        }

        .section:not(:nth-of-type(2)) {
            background: radial-gradient(circle, rgba(59, 60, 54, 1) 20%, rgba(0, 0, 0, 1) 80%);
        }

        a:not(.btn):hover {
            color: #86c240 !important;
        }

        .text-telcast {
            color: #86c240 !important;
        }

        .bg-telcast {
            background: #86c240 !important;
        }

        .carousel-indicators .active {
            border-top: 3px solid #86c240;
        }

        .client-icon i:before {
            color: #86c240;
        }
    </style>
</head>
<body>
<div id="navbar">
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark" id="main-menu">
        <div class="container">
            <!-- LOGO -->
            <a href="/" class="navbar-brand logo text-uppercase">
                <img src="{{ asset('frontend/images/logo-full.png') }}" class="logo-light" alt="" height="24">
                <img src="{{ asset('frontend/images/logo-full.png') }}" class="logo-dark" alt="" height="24">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-center mx-auto" id="navbar-navlist">
                    <li class="nav-item">
                        <a data-scroll href="#services" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll href="#features" class="nav-link">Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll href="#testimonial" class="nav-link">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll href="#contact" class="nav-link">Contact</a>
                    </li>
                </ul>
                <div class="nav-button">
                    <ul class="list-inline d-none d-lg-inline-block  mb-0">
                        <li class="list-inline-item ps-1">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-warning" style="">
                                Get Started <i class="mdi mdi-login ms-2"></i>
                            </a>
                        </li>
                        {{--                        <li class="list-inline-item ps-1"><a href="#">Signup <i class="mdi mdi-draw-pen ms-2"></i></a></li>--}}
                        {{--                        <li class="list-inline-item ps-1"><a href="#"><i class="mdi mdi-linkedin"></i></a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<!--START HOME-->
<section class="bg-home-4" id="home">
    <div class="bg-overlay-black"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="home-contact mt-4">
                    <p class="home-heading-title bg-soft-white text-white">TELCAST</p>
                    <h1 class="home-title text-white mt-3">Super Fast Professional Media & TV Platform</h1>
                    <p class="home-desc text-white-50 mt-4">
                        Etiam sed.Interdum consequat proin vestibulum class a euismod mus
                        luctus quam amet, constur adipisicing eli.
                    </p>

                    <div class="mt-4 pt-3">
                        <!-- 1 -->
                        <a href="{{ route('login') }}?purpose=2" class="btn btn-primary me-3">
                            Start Advertising <i class="mdi mdi-bullseye ms-2"></i>
                        </a>
                        <a href="{{ route('login') }}?purpose=2" class="btn btn-primary me-3">
                            Start a Channel
                            <i class="mdi mdi-access-point-network ms-2"></i>
                        </a>
                        <span class="fw-bold text-white f-14">OR</span>
                        <a href="" class="play-shadow ms-3" data-bs-toggle="modal" data-bs-target="#watchvideomodal">
                            <span class="play-btn video-play-icon"><i class="mdi mdi-play text-center"></i></span>
                        </a>

                        <!-- MODAL -->
                        <div class="modal fade bd-example-modal-lg" id="watchvideomodal" data-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                <div class="modal-content home-modal">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <video src="https://www.w3schools.com/html/mov_bbb.mp4" class="video-box" controls>
                                        <source type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-5">
                        <p class="text-white fw-normal my-4 mx-5">
                            Just wanna watch tv, shows, movies, media and a lot more?
                            Get started now to enjoy 10000+ resources available on telcast
                        </p>
<!-- 3 -->
                        <a href="{{ route('login') }}?purpose=2" class="btn btn-warning me-3">
                            Start Watching <i class="mdi mdi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END HOME-->


<!-- START SERVICES -->
<section class="section" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="title-box text-center">
                    <h6 class="title-sub-title mb-0 text-primary bg-light">Lots of Content</h6>
                    <h3 class="title-heading text-white mt-3">
                        Watch 100+ channels and 1,000s of movies and shows on demand for free.
                    </h3>
                </div>
            </div>
        </div>


        <div class="row mt-5 pt-4">
            <div class="col-lg-4">
                <div class="service-box text-center uim-icon-primary mt-4">
                    <div class="service-icon icon-xxl mx-auto">
                        <i class="uim uim-cube"></i>
                    </div>
                    <h5 class="f-18 mt-4">Shared Hosting</h5>

                    <div class="service-border mt-4 mx-auto"></div>

                    <p class="text-muted mt-3 mb-0">Some quick example text to build card title and make up
                        the bulk tempus nun card's content platform.</p>

                    <a href="#">
                        <div class="read-more mt-3">
                            <span class="arrow text-dark">&#8594;</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="service-box text-center active uim-icon-primary mt-4">
                    <div class="service-icon icon-xxl mx-auto">
                        <i class="uim uim-layer-group"></i>
                    </div>
                    <h5 class="f-18 mt-4">VPS Hosting</h5>

                    <div class="service-border mt-4 mx-auto"></div>

                    <p class="text-muted mt-3 mb-0">Credibly brand standards compliant users without extensible
                        services.
                        Anibh euismod laoreet.</p>

                    <a href="#">
                        <div class="read-more mt-3">
                            <span class="arrow text-dark">&#8594;</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="service-box text-center uim-icon-primary mt-4">
                    <div class="service-icon icon-xxl mx-auto">
                        <i class="uim uim-briefcase"></i>
                    </div>
                    <h5 class="f-18 mt-4">Reseller Hosting</h5>

                    <div class="service-border mt-4 mx-auto"></div>

                    <p class="text-muted mt-3 mb-0">Separated they live in Bookmarksgrove right at the coast of the
                        Semantics,
                        a large necessary regelialia.</p>

                    <a href="#">
                        <div class="read-more mt-3">
                            <span class="arrow text-dark">&#8594;</span>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- END SERVICES -->


<!-- START FEATURES -->

<section class="section overflow-hidden" id="features">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="features-1 mt-4">
                    <img src="{{ asset('destin/images/features/img-1.png') }}" alt="">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="features-box mt-4">
                    <h3 class="text-light">Watch Anywhere</h3>
                    <p class="text-light mt-3">
                        Stream unlimited films and TV programmes on your phone, tablet, laptop and TV without paying
                        more.
                    </p>

                    <div class="mt-4">
                        <a href="#">
                            <div class="read-more mt-3">
                                <span class="arrow text-primary">&#8594;</span>
                            </div>
                        </a>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <div class="uim-icon-primary mt-4">
                                    <div class="features-icon icon-xl">
                                        <i class="uim uim-window-section"></i>
                                    </div>
                                </div>
                                <h5 class="text-telcast f-18 mt-4">Fast & Reliable </h5>
                                <p class="text-light mt-2">
                                    Pleasure that has no annoying pain that roduces pleasu.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <div class="uim-icon-primary mt-4">
                                    <div class="features-icon icon-xl">
                                        <i class="uim uim-chart-pie"></i>
                                    </div>
                                </div>
                                <h5 class="text-telcast f-18 mt-4">24/7 Support </h5>
                                <p class="text-light">
                                    Reiciendis volupibus maiores alias consur
                                    perfer repellat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-5 align-items-center">
            <div class="col-lg-6">
                <div class="mt-4">
                    <h3 class="text-light w-75">1,000s of movies & TV shows Free to watch anytime</h3>
                    <p class="text-light mt-4">
                        Everything from the latest hit movies, to full seasons of your favourite shows, available
                        anytime, on-demand.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mt-4">
                                <h2 class="text-telcast">1535+</h2>
                                <h5 class="text-light mb-0 f-16">Media Contents</h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mt-4">
                                <h2 class="text-telcast">530+</h2>
                                <h5 class="text-light mb-0 f-16">Customers Happy</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="features-2 mt-4">
                    <img src="{{ asset('destin/images/features/img-2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END FEATURES -->


<!-- START TESTIMONIAL -->
<section class="section" id="testimonial">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="title-box text-center">
                    <h6 class="title-sub-title mb-0 text-primary bg-light">Our Testimonial</h6>
                    <h3 class="title-heading text-light mt-3">What do they say about us?</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
                {{--                <h1 class="client-title-main text-center d-none d-xl-block text-uppercase">Client Love</h1>--}}
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testi-box text-center mt-4">
                                <div class="client-icon">
                                    <i class="mdi mdi-format-quote-open text-teclast"></i>
                                </div>
                                <h4 class="line-height_1_6 fw-normal mt-3 text-light">“I feel confident imposing change
                                    on
                                    myself. It's a lot more fun progressing than looking back.
                                    That's why scelerisque pretium dolor, sit amet vehicula erat pelleque
                                    need throw curve balls.”</h4>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testi-box text-center mt-4">
                                <div class="client-icon">
                                    <i class="mdi mdi-format-quote-open text-teclast"></i>
                                </div>
                                <h4 class="line-height_1_6 fw-normal mt-3 text-light">
                                    “Our task must be to free ourselves by
                                    widening
                                    our circle of compassion to embrace
                                    all living creatures Integer varius lacus non magna tempor congue natuasre
                                    the whole its beauty.”</h4>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testi-box text-center mt-4">
                                <div class="client-icon">
                                    <i class="mdi mdi-format-quote-open text-teclast"></i>
                                </div>
                                <h4 class="line-height_1_6 fw-normal mt-3 text-light">“I've learned that people will
                                    forget
                                    what you said,
                                    people will forget what you did, but people will never aliquam in nunc quis
                                    tincidunt
                                    forget how you vestibulum egestas them feel.”</h4>
                            </div>
                        </div>
                    </div>


                    <div class="carousel-indicators mt-5 pt-4">

                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active text-start" aria-current="true" aria-label="Slide 1">
                            <div class="d-flex p-2">
                                <img src="{{ asset('destin/images/users/img-1.jpg') }}" alt=""
                                     class=" testi-img img-fluid rounded-circle">

                                <div class="flex-1 ps-3">
                                    <h5 class="f-18 mb-1 text-light">Brandon Carney</h5>
                                    <p class="text-light f-15 mb-0">- Designer</p>
                                </div>
                            </div>
                        </button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" class="text-start"
                                data-bs-slide-to="1" aria-label="Slide 2">
                            <div class="d-flex p-2">
                                <img src="{{ asset('destin/images/users/img-2.jpg') }}" alt=""
                                     class=" testi-img img-fluid rounded-circle">

                                <div class="flex-1 ps-3">
                                    <h5 class="f-18 mb-1 text-light">Samuel Campbell</h5>
                                    <p class="text-light f-15 mb-0">- Developer</p>
                                </div>
                            </div>
                        </button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" class="text-start"
                                data-bs-slide-to="2" aria-label="Slide 3">
                            <div class="d-flex p-2">
                                <img src="{{ asset('destin/images/users/img-3.jpg') }}" alt=""
                                     class=" testi-img img-fluid rounded-circle">

                                <div class="flex-1 ps-3">
                                    <h5 class="f-18 mb-1 text-light">Michelle Stehle</h5>
                                    <p class="text-light f-15 mb-0">- Manager</p>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <button class="carousel-control-prev" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-telcast d-flex"><i
                                        class="mdi mdi-chevron-left m-auto"></i></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-telcast d-flex"><i
                                        class="mdi mdi-chevron-right m-auto"></i></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- END TESTIMONIAL -->


<!-- START PRICING -->

<section class="section" id="pricing">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="heading-box">
                    <div class="title-box">
                        <h6 class="title-sub-title mb-0 text-primary bg-light">Pricing</h6>
                        <h3 class="title-heading mt-3 ms-0 text-light">Best pricing package start business</h3>
                    </div>

                    <p class="title-desc text-muted mt-3">
                        Call to action pricing table is really crucial to your for your business website.
                    </p>

                    <div class="pricing-tabs mt-4">
                        <ul class="nav nav-pills rounded justify-content-center d-inline-block pricing-tab-border py-1 px-2"
                            id="pills-tab" role="tablist">
                            <li class="nav-item d-inline-block">
                                <a class="nav-link px-3 rounded active monthly" id="Monthly" data-bs-toggle="pill"
                                   href="#Month" role="tab" aria-controls="Month" aria-selected="true">Monthly</a>
                            </li>
                            <li class="nav-item d-inline-block">
                                <a class="nav-link px-3 rounded yearly" id="Yearly" data-bs-toggle="pill"
                                   href="#Year" role="tab" aria-controls="Year" aria-selected="false">
                                    Yearly <span class="badge bg-success rounded text-white">20% Off </span>
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>


            </div>

            <div class="col-lg-7 g-0 offset-lg-1">

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="Month" role="tabpanel" aria-labelledby="Monthly">
                        <div class="row g-0 align-items-center">
                            <div class="col-lg-6">
                                <div class="pricing-box active bg-white rounded mt-4">
                                    <div class="pricing-badge">
                                        <span class="badge">Best Choose</span>
                                    </div>

                                    <h5 class="fw-normal">Freelancer</h5>
                                    <h1 class="pricing-title mt-3 mb-0">$79<span class="f-20">.99/month</span></h1>
                                    <p class="text-muted f-15 mt-3">For small teams trying out Destrin for an
                                        unlimited period of time</p>

                                    <hr class="mt-4">

                                    <div class="mt-4 pt-1">
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> SSD Storage</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> Bandwith</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Magic</span> Auto Backup
                                        </p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Free</span> Domain</p>


                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">6 Core</span> CPU</p>

                                    </div>
                                    <div class="mt-4 pt-2 text-center">
                                        <a href="#" class="btn btn-primary w-100">Start with Destrin</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="pricing-box bg-white rounded mt-4">


                                    <h5 class="fw-normal">Startup</h5>
                                    <h1 class="pricing-title mt-3 mb-0">$25<span class="f-20">.99/month</span></h1>
                                    <p class="text-muted f-15 mt-3">For larger businesses or those with onal
                                        administration needs</p>
                                    <div class="mt-4 pt-1">
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> SSD Storage</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> Bandwith</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Magic</span> Auto Backup
                                        </p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-close-circle text-danger f-18 me-2"></i><span
                                                    class="fw-normal">Free</span> Domain</p>


                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-close-circle text-danger f-18 me-2"></i><span
                                                    class="fw-normal">6 Core</span> CPU</p>

                                    </div>
                                    <div class="mt-4 pt-2 text-center">
                                        <a href="#" class="btn btn-primary w-100">Start with Destrin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="Year" role="tabpanel" aria-labelledby="Yearly">
                        <div class="row g-0 align-items-center">
                            <div class="col-lg-6">
                                <div class="pricing-box active bg-white rounded mt-4">
                                    <div class="pricing-badge">
                                        <span class="badge">Best Choose</span>
                                    </div>

                                    <h5 class="fw-normal">Freelancer</h5>
                                    <h1 class="pricing-title mt-3 mb-0">$179<span class="f-20">.99/yearly</span>
                                    </h1>
                                    <p class="text-muted f-15 mt-3">For small teams trying out Destrin for an
                                        unlimited period of time</p>

                                    <hr class="mt-4">

                                    <div class="mt-4 pt-1">
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> SSD Storage</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> Bandwith</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Magic</span> Auto Backup
                                        </p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Free</span> Domain</p>


                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">6 Core</span> CPU</p>

                                    </div>
                                    <div class="mt-4 pt-2 text-center">
                                        <a href="#" class="btn btn-primary w-100">Start with Destrin</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="pricing-box bg-white rounded mt-4">


                                    <h5 class="fw-normal">Startup</h5>
                                    <h1 class="pricing-title mt-3 mb-0">$125<span class="f-20">.99/yearly</span>
                                    </h1>
                                    <p class="text-muted f-15 mt-3">For larger businesses or those with onal
                                        administration needs</p>
                                    <div class="mt-4 pt-1">
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> SSD Storage</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Unlimited</span> Bandwith</p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-check-circle text-primary f-18 me-2"></i><span
                                                    class="fw-normal">Magic</span> Auto Backup
                                        </p>
                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-close-circle text-danger f-18 me-2"></i><span
                                                    class="fw-normal">Free</span> Domain</p>


                                        <p class="mb-3 f-16"><i
                                                    class="mdi mdi-close-circle text-danger f-18 me-2"></i><span
                                                    class="fw-normal">6 Core</span> CPU</p>

                                    </div>
                                    <div class="mt-4 pt-2 text-center">
                                        <a href="#" class="btn btn-primary w-100">Start with Destrin</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</section>
<!-- END PRICING -->


<!-- START CONTACT -->

<section class="section" id="contact">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="title-box text-center">
                    <h6 class="title-sub-title mb-0 text-primary bg-light">Contact Us</h6>
                    <h3 class="title-heading text-light mt-3">Have any suggestion or query?</h3>
                </div>


            </div>
        </div>

        <div class="row align-items-center mt-5 pt-2">
            <div class="col-lg-5">
                <div class="mt-4">
                    <h3 class="text-light">Let's talk about everything!</h3>
                    <p class="text-muted mt-2">
                        Don't like forms? Send us an email @
                        <a href="#" class="text-primary fw-normal"><u>support@telcast.com</u></a>
                    </p>

                    <div class="mt-4 pt-1 w-75">
                        <div class="d-flex mt-3">
                            <i class="mdi mdi-map-marker text-primary f-20"></i>
                            <div class="flex-1 ps-3">
                                <p class="text-muted mb-0">
                                    4644 Watson Street Maple Street Shade , NJ 08052
                                </p>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <i class="mdi mdi-phone text-primary f-20"></i>
                            <div class="flex-1 ps-3">
                                <p class="text-muted mb-0">01(220) 856-705-2709</p>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <i class="mdi mdi-email text-primary f-20"></i>
                            <div class="flex-1 ps-3">
                                <p class="text-muted mb-0">AnitaJGarza@teleworm.us</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="custom-form">
                    <form method="post" name="myForm" onsubmit="return validateForm()">
                        <p id="error-msg"></p>
                        <div id="simple-msg"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2 mt-2">
                                    <label class="form-label text-muted">Your Name</label>
                                    <input name="name" id="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2 mt-2">
                                    <label class="form-label text-muted">Your Email</label>
                                    <input name="email" id="email" type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2 mt-2">
                                    <label class="form-label text-muted">Your Subject</label>
                                    <input type="text" class="form-control" id="subject">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2 mt-2">
                                    <label class="form-label text-muted">Your Massage</label>
                                    <textarea name="comments" id="comments" rows="5"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12 text-right">
                                <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary"
                                       value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTACT -->

<!-- START FOOTER -->
<footer class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="mt-4">
                    <img src="{{ asset('frontend/images/logo-full.png') }}" alt="" height="24">
                    <p class="text-muted mt-3 pt-1">
                        In an ideal world this text wouldn’t exist, a client would acknowledge
                        the importance of having web copy before the design starts.
                    </p>
                    <div class="footer-social mt-4">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="#" class="text-reset"><i class="mdi mdi-facebook "></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-reset"><i class="mdi mdi-twitter "></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-reset"><i class="mdi mdi-google "></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-reset"><i class="mdi mdi-pinterest "></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mt-4">
                            <h5 class="f-18 text-muted">Support</h5>
                            <ul class="list-unstyled footer-link mt-3">
                                <li><a href="#">Facebook Integration</a></li>
                                <li><a href="#">wordpress Program</a></li>
                                <li><a href="#">Business Marketing</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mt-4 ps-0 ps-lg-5">
                            <h5 class="f-18 text-muted">More Info</h5>
                            <ul class="list-unstyled footer-link mt-3">
                                <li><a href="#">Pricing</a></li>
                                <li><a href="#">For Marketing</a></li>
                                <li><a href="#">For CEOs</a></li>
                                <li><a href="#">For Agencies</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mt-4 ps-0 ps-lg-5">
                            <h5 class="f-18 text-muted">Resources</h5>
                            <ul class="list-unstyled footer-link mt-3">
                                <li><a href="#">Form validation</a></li>
                                <li><a href="#">Pricacy Policy</a></li>
                                <li><a href="#">Design Defined</a></li>
                                <li><a href="#">Marketplace</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="client-images mt-4">
                    <img src="{{ asset('destin/images/clients/1.png') }}" alt="logo-img"
                         class="mx-auto img-fluid d-block">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="client-images mt-4">
                    <img src="{{ asset('destin/images/clients/2.png') }}" alt="logo-img"
                         class="mx-auto img-fluid d-block">
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="client-images mt-4">
                    <img src="{{ asset('destin/images/clients/3.png') }}" alt="logo-img"
                         class="mx-auto img-fluid d-block">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="client-images mt-4">
                    <img src="{{ asset('destin/images/clients/4.png') }}" alt="logo-img"
                         class="mx-auto img-fluid d-block">
                </div>
            </div>
        </div>

        <hr class="mt-5">
        <div class="row mt-4">
            <div class="col-lg-12">
                <p class="text-center text-muted mb-0">
                    2021 © Teclast. Designed with <i class="mdi mdi-heart-box"></i>. All Rights Reserved.
                </p>

            </div>

        </div>

    </div>
</footer>
<!-- END FOOTER -->

<script src="{{ asset('destin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('destin/js/smooth-scroll.polyfills.min.js') }}"></script>
<script src="{{ asset('destin/js/gumshoe.polyfills.min.js') }}"></script>
<script src="{{ asset('destin/js/unicons.js') }}"></script>
<script src="{{ asset('destin/js/app.js') }}"></script>
</body>
</html>