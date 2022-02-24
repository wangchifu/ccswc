<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')彰化縣社區大學聯合服務網</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="HeroBiz/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="HeroBiz/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="HeroBiz/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="HeroBiz/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="HeroBiz/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="HeroBiz/assets/css/variables.css" rel="stylesheet">
  <!-- <link href="assets/css/variables-blue.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-green.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-orange.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-purple.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-red.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-pink.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="HeroBiz/assets/css/main.css" rel="stylesheet">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free-5.10.2-web/css/all.css')}}">

  <!-- venobox -->
  <link rel="stylesheet" href="{{ asset('venobox/venobox.min.css') }}" type="text/css" media="screen">
  <script src="{{ asset('venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

  <!-- =======================================================
  * Template Name: HeroBiz - v2.0.0
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

@include('layouts.header')

  @yield('banner')

  <main id="main">
    <section>
      <div class="container">
        @yield('content')
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts.footer')

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="HeroBiz/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="HeroBiz/assets/vendor/aos/aos.js"></script>
  <script src="HeroBiz/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="HeroBiz/ssets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="HeroBiz/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="HeroBiz/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="HeroBiz/assets/js/main.js"></script>

</body>

</html>