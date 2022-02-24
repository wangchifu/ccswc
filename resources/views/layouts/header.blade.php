  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="{{ route('index') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1><img src="{{ asset('images/assembly.png') }} ">彰化縣社區大學聯合服務網<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>

          <li><a class="nav-link scrollto" href="index.html#about">公告訊息</a></li>
          <li><a class="nav-link scrollto" href="index.html#about">彰化縣社區大學沿革</a></li>
          <li><a class="nav-link scrollto" href="index.html#about">法令規章</a></li>
          <li class="dropdown"><a href="#"><span>資料填報</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="index.html" class="active">資料平台</a></li>
              <li><a href="index-2.html">調查填報</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="index.html#about">網路資源</a></li>
          @guest
          <li class="dropdown"><a href="#"><span><i class="fas fa-sign-in-alt"></i> 登入</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a class="nav-link scrollto" href="{{ route('login') }}">本機登入</a></li>
              <li><a class="nav-link scrollto" href="{{ route('g_login') }}">GSuite登入</a></li>
            </ul>
          </li>
          @endguest
          @auth
          <li><a class="nav-link scrollto" href="{{ route('logout') }}" onclick="return confirm('確定登出？')"><span><i class="fas fa-user"></i> {{ auth()->user()->name }} 登出</span></a></li>
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->