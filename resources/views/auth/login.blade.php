@extends('layouts.master')

@section('title','G登入-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <h4 class="card-header">GSuite 登入</h5>
            <div class="card-body">
                <div class="input-group mb-3">
                    <img src="{{ asset('images/gsuite_logo.png') }}">
                </div>
                <form action="{{ route('auth') }}" method="post" id="this_form">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text">帳號</span>
                        <input type="text" class="form-control rq" name="username" autofocus required onclick="change_button2()">
                        <span class="input-group-text">@chc.edu.tw</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">密碼</span>
                        <input type="password" class="form-control rq" name="password" required onclick="change_button2()">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">驗證碼</span>
                        <input type="text" class="form-control rq" name="chaptcha" required onclick="change_button2()">
                    </div>
                    <div class="input-group mb-3">
                        <img src="{{ route('pic') }}" class="img-fluid" id="captcha_img" onclick="change_img()">
                    </div>
                    @include('layouts.errors')
                    <div class="input-group mb-3 text-right">
                        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
                    </div>
                    <input type="hidden" name="login_type" value="gsuite">
                </form>
                <div style="text-align:right">
                    <a href="{{ route('mlogin') }}"><i class="fas fa-cog text-secondary"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.change_pic')
@include('layouts.change_button')
<br>
@endsection