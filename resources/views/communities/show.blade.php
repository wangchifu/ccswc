@extends('layouts.master')

@section('title','社區大學一覽表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    社區大學一覽表 - {{ $communities[$code] }}
</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('community.view') }}">社區大學一覽表</a></li>
      <li class="breadcrumb-item active" aria-current="page">二林社大</li>
    </ol>
</nav>
@auth
    @if(auth()->user()->admin == '1' or (auth()->user()->school_admin == '1' and auth()->user()->code == $code))
        <a href="{{ route('community.edit',$code) }}" class="btn btn-primary btn-sm">編輯</a>
    @endif
@endauth
<br>
<br>
<div class="card">
    <div class="card-header">
        <img src="..." class="card-img-top" alt="...">
    </div>
    <div class="card-body">
        
    </div>
</div>
<br>
@endsection