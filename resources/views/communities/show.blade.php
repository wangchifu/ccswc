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
      <li class="breadcrumb-item active" aria-current="page">{{ $communities[$code] }}</li>
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
        <img src="{{ asset('images/schools/'.$code.'.jpg') }}" class="card-img-top" alt="...">
    </div>
    <div class="card-body">
        @if(!empty($community))
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th class="col-2">
                        學校全名(簡稱)
                    </th>
                    <td class="col-10">
                        {{ $community->school_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        校長姓名
                    </th>
                    <td>
                        {{ $community->principal_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        主要地址
                    </th>
                    <td>
                        {{ $community->address }}
                    </td>
                </tr>
                <tr>
                    <th>
                        主要電話
                    </th>
                    <td>
                        {{ $community->telephone_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        傳真電話
                    </th>
                    <td>
                        {{ $community->fax_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        電子信箱
                    </th>
                    <td>
                        {{ $community->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        分部資料
                    </th>
                    <td>
                        {{ $community->branch }}
                    </td>
                </tr>
                <tr>
                    <th>
                        上課地點
                    </th>
                    <td>
                        {!! $community->class_location !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        學校網站
                    </th>
                    <td>
                        {{ $community->website }}
                    </td>
                </tr>
                <tr>
                    <th>
                        辦理單位
                    </th>
                    <td>
                        {{ $community->unit }}
                    </td>
                </tr>
                <tr>
                    <th>
                        學校簡介
                    </th>
                    <td>
                        {!! $community->introduction !!}
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</div>
<br>
@endsection