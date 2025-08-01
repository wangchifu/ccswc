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
          @auth
          <li class="dropdown"><a href="#"><span>公告訊息</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>              
              <li><a href="{{ route('posts.view') }}">一般公告</a></li>
              @if(in_array(auth()->user()->code,config('ccswc.codes')))                  
              <li><a href="{{ route('posts.school_index') }}">公告簽收</a></li>
              @endif                  
            </ul>
          </li>
          @endauth
          @guest
            <li><a class="nav-link scrollto" href="{{ route('posts.view') }}">公告訊息</a></li>
          @endguest        
          <li><a class="nav-link scrollto" href="{{ route('history.view') }}">彰化縣社區大學沿革</a></li>
          <li><a class="nav-link scrollto" href="{{ route('community.view') }}">社大一覽表</a></li>
          <li><a class="nav-link scrollto" href="{{ route('law.view') }}">法令規章</a></li>
          @auth
            <li class="dropdown"><a href="#"><span>資料填報</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li class="dropdown"><a href="#"><span>資料平台</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                  <ul>
                    <li><a href="{{ route('courses.index') }}">課程表</a></li>
                    <li><a href="{{ route('staffs.index') }}">行政人員名冊</a></li>
                    <li><a href="{{ route('teachers.index') }}">教師名冊</a></li>
                    <li><a href="{{ route('students.index') }}">學員統計資料</a></li>
                  </ul>
                </li>
                @if(in_array(auth()->user()->code,config('ccswc.codes')))    
                  <li><a href="{{ route('reports.school_index') }}">調查填報</a></li>    
                @endif              
              </ul>
            </li>
          @endauth
          @guest
          <li class="dropdown"><a href="#"><span>資料平台</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="{{ route('courses.index') }}">課程表</a></li>
              <li><a href="{{ route('staffs.index') }}">行政人員名冊</a></li>
              <li><a href="{{ route('teachers.index') }}">教師名冊</a></li>
              <li><a href="{{ route('students.index') }}">學員統計資料</a></li>
            </ul>
          </li>
          @endguest
          <li><a class="nav-link scrollto" href="{{ route('resource.view') }}">網路資源</a></li>
          @guest
          <li><a class="nav-link scrollto" href="{{ route('logins') }}">登入</a></li>
          @endguest
          @auth
          <li class="dropdown"><a href="#"><span><i class="fas fa-user"></i>
            <?php  $communities = config('ccswc.communities'); ?>
            @if(isset($communities[auth()->user()->code]))
              {{ $communities[auth()->user()->code] }}
            @elseif(auth()->user()->code == "079999" or auth()->user()->code == "079998")
              教育處
            @endif
             {{ auth()->user()->name }}</span> 
             <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              @if(auth()->user()->school_admin==1)
                <li><a class="nav-link scrollto" href="{{ route('users.school_index') }}">本校使用者管理</a></li>
              @endif
              @if(auth()->user()->admin==1)
                <li><a class="nav-link scrollto" href="{{ route('users.index') }}">使用者管理</a></li>
                <li><a class="nav-link scrollto" href="{{ route('title_image') }}">首頁圖片</a></li>
              @endif
              @if(auth()->user()->social_education > 0)
                <li><a class="nav-link scrollto" href="{{ route('posts.index') }}">公告系統</a></li>
                <li><a class="nav-link scrollto" href="{{ route('reports.index') }}">填報系統</a></li>
              @endif
              <!--   
              @if(auth()->user()->code <> "079999")
                <li><a class="nav-link scrollto" href="{{ route('posts.school_index') }}">公告簽收</a></li>
                <li><a class="nav-link scrollto" href="{{ route('reports.school_index') }}">調查填報</a></li>
              @endif
              -->
              @if(auth()->user()->login_type=="local")
                <li><a class="nav-link scrollto" href="{{ route('users.reset_pwd') }}">更改密碼</a></li>
              @endif
              @impersonating
                <li><a class="nav-link scrollto" href="{{ route('sims.impersonate_leave') }}" onclick="return confirm('確定返回原本帳琥？')">結束模擬</a></li>
              @endImpersonating
              <li><a class="nav-link scrollto" href="{{ route('logout') }}" onclick="return confirm('確定登出？')">登出</a></li>
            </ul>
          </li>

          
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->
      @auth
      @if(auth()->user()->code=="079999")
        @if(auth()->user()->social_education === null)
          <a class="btn btn-primary btn-sm scrollto" href="{{ route('users.apply_section') }}" onclick="return confirm('確定申請嗎？')">申請為社教科成員</a>
        @endif
        @if(auth()->user()->social_education === 0)
          <button class="btn btn-primary btn-sm scrollto" disabled>請耐心等待</button>
        @endif
      @endif
      @endauth
    </div>
  </header><!-- End Header -->