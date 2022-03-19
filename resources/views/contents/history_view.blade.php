@extends('layouts.master')

@section('title','社區大學沿革-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    社區大學沿革
</h1>
@auth
    @if(auth()->user()->admin == '1' or auth()->user()->school_admin == '1')
        <a href="{{ route('history.edit') }}" class="btn btn-primary btn-sm">編輯</a>
    @endif
@endauth
<br>
<br>
<div class="card">
    <div class="card-header">
        <img src="..." class="card-img-top" alt="...">
    </div>
    <div class="card-body">
        {!! $content !!}
    </div>
</div>
<br>
@endsection