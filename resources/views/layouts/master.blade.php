<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')彰化縣社區大學聯合服務網</title>
  <meta content="" name="description">
  <meta content="" name="keywords">    
  <meta http-equiv="Content-Security-Policy" content="default-src 'none';img-src 'self' data:;style-src 'self';script-src 'self' 'unsafe-inline';font-src 'self';">       
  <!-- Favicons -->
  <link href="{{ asset('favicon.ico') }}" rel="icon">
  <link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('HeroBiz/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('HeroBiz/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('HeroBiz/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('HeroBiz/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('HeroBiz/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="{{ asset('HeroBiz/assets/css/variables.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('HeroBiz/assets/css/variables-blue.css" rel="stylesheet') }}"> -->
  <!-- <link href="{{ asset('HeroBiz/assets/css/variables-green.css" rel="stylesheet') }}"> -->
  <!-- <link href="{{ asset('HeroBiz/assets/css/variables-orange.css" rel="stylesheet') }}"> -->
  <!-- <link href="{{ asset('HeroBiz/assets/css/variables-purple.css" rel="stylesheet') }}"> -->
  <!-- <link href="{{ asset('HeroBiz/assets/css/variables-red.css" rel="stylesheet') }}"> -->
  <!-- <link href="{{ asset('HeroBiz/assets/css/variables-pink.css" rel="stylesheet') }}"> -->

  <!-- Template Main CSS File -->
  <link href="{{ asset('HeroBiz/assets/css/main.css') }}" rel="stylesheet">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free-5.10.2-web/css/all.css')}}">

  <!-- venobox -->
  <link rel="stylesheet" href="{{ asset('venobox/venobox.min.css') }}" type="text/css" media="screen">
  <script src="{{ asset('venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>


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
  <script src="{{ asset('HeroBiz/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('HeroBiz/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('HeroBiz/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('HeroBiz/ssets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('HeroBiz/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('HeroBiz/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('HeroBiz/assets/js/main.js') }}"></script>
  <script>
    var vb = new VenoBox({
        selector: '.venobox',
        overlayClose:false,
    });

    $(document).on('click', '.vbox-close', function() {
        window.location.reload();
        vb.close();
    });
</script>
</body>

</html>