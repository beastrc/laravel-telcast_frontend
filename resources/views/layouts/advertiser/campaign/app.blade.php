<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Themesdesign">
    <meta name="description" content="Premium Bootstrap 4 Landing Page Template">
    <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Stint+Ultra+Expanded&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Six+Caps&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
  	<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>

    <link rel="stylesheet" href="{{ asset('css/campaign/beast_campaign.css') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

</head>


</head>
<body class="body">
	@include('layouts.advertiser.campaign.header')
    <div class="container-fluid">
    @yield('content')
    </div>
<!-- footer -->
    <!-- @include('layouts.advertiser.campaign.footer') -->
<!-- end footer -->
</body>
</html>