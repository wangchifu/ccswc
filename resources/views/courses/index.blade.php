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
                <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm">批次新增</a>
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
            @if(in_array(auth()->user()->code,$codes))
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
                    <?php 
                        $badge = ($course->course_season->season==1)?"primary":"warning text-dark";
                    ?>
                    <span class="badge rounded-pill bg-{{ $badge }}">
                        {{ $course->course_season->year }} {{ $seasons[$course->course_season->season] }}
                    </span>  
                    <small>
                        {{ $course->course_season->start_date }}   
                    </small>   
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
                <?php
                    $start_date = $course->course_season->start_date;
                    $y = substr($start_date,0,4);
                    $m = substr($start_date,5,2);
                    $d = substr($start_date,8,2);
                    $open_date = Illuminate\Support\Carbon::create($y, $m, $d,0)->addMonth();
                    $now_date = Illuminate\Support\Carbon::now();
                    $open =($now_date->gt($open_date))?true:false;
                ?>
                <td>
                    @auth
                        {{ $course->students }}<br>
                        @if(isset($class_situations[$course->situation]))
                        {{ $class_situations[$course->situation] }}
                        @endif
                    @endauth
                    @guest
                        @if($open)
                            {{ $course->students }}<br>
                            @if(isset($class_situations[$course->situation]))
                            {{ $class_situations[$course->situation] }}
                            @endif
                        @else
                            報名中
                        @endif
                    @endguest
                </td>                
                @auth                
                    @if(in_array(auth()->user()->code,$codes))
                    <td>
                        @if(auth()->user()->code == $course->code)
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('courses.create_one',$course->course_season_id) }}" class="btn btn-outline-success btn-sm">增</a>
                            <a href="{{ route('courses.edit_one',$course->id) }}" class="btn btn-outline-primary btn-sm">編</a>
                            <a href="{{ route('courses.delete_one',$course->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('確定刪除？')">刪</a>
                        </div>
                        @endif
                    </td>
                    @endif                
                @endauth                
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