@extends('layouts.master')

@section('title','課程表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    課程表
</h1>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-3">
            <select class="form-control" id="select_school" onchange="jump();">
                <option value=''>--全部顯示--</option>
                @foreach($communities as $k=>$v)
                    <?php $selected = ($code == $k)?"selected":null; ?>
                    <option value="{{ $k }}" {{ $selected }}>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        @auth
            @if(auth()->user()->code <> "079999")
            <div class="col-3">
                <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm">新增</a>
            </div>
            @endif
        @endauth
    </div>
</div>
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            社區大學<br>
            班別
        </th>
        <th nowrap>
            課程類型<br>
            課程名稱
        </th>
        <th nowrap>
            上課地點<br>
            授課教師
        </th>        
        <th nowrap>
            上課時間<br>
            學分
        </th>
        <th nowrap>
            學員總數<br>
            開課狀態
        </th>
        @auth
        @if(auth()->user()->social_education > 0)
            <th nowrap>
                動作
            </th>
        @endif
        @endauth
    </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr>
                <td>
                    {{ $communities[$course->code] }}<br>
                    {{ $course->course_season->year }} {{ $seasons[$course->course_season->season] }}
                </td>
                <td>
                    {{ $course->type }}<br>
                    {{ $course->name }}
                </td>
                <td>
                    {{ $course->place }}<br>
                    {{ $course->teacher }}
                </td>
                <td>
                    {{ $course->time }}<br>
                    {{ $course->hour }}
                </td>
                <td>
                    {{ $course->students }}<br>
                    {{ $class_situations[$course->situation] }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $courses->links() }}
<script>
    function jump(){
        location.href = '{{ env('APP_URL') }}'+'/courses/index/'+$('#select_school').val();
    }
</script>
<br>
@endsection