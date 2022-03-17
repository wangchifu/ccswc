@extends('layouts.master')

@section('title','首頁-')

@section('banner')
<section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
      <img src="{{ asset('images/community.png') }}" class="img-fluid animated">
      <h2>歡迎光臨 <span>CCSWC</span></h2>
      <p>Welcome to visit community college's service web of Changhua.</p>
<!--
      <div class="d-flex">
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
      </div>
    </div>
-->
    <h1>最新公告</h1>
    <table class="table table-striped">
      <thead class="table-light">
      <tr>
          <th nowrap>
              發佈日期
          </th>
          <th nowrap>
              發佈人
          </th>
          <th nowrap>
              主旨
          </th>
          <th nowrap>
              點閱
          </th>      
      </tr>
      </thead>
      <tbody>
      @foreach($posts as $post)
        <tr>
          <td>
            {{ substr($post->updated_at,0,10) }}
          </td>
          <td>
            {{ $post->user->name }}
          </td>
          <td style="text-align: left;">
            <a href="{{ route('show',$post->id) }}" class="venobox" data-vbtype="iframe">
              {{ $post->title }}
            </a>
          </td>
          <td>
            {{ $post->views }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    {{ $posts->links() }}
  </section>
@endsection

@section('content')

@endsection