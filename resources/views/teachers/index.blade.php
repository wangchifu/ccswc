@extends('layouts.master')

@section('title','教師名冊-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    教師名冊
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
                <a href="{{ route('teachers.create') }}" class="btn btn-success btn-sm">批次新增</a>
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
            姓名
        </th>        
        <th nowrap>
            性別
        </th>
        <th nowrap>
            授課課程名稱
        </th>
        <th nowrap>
            備註
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
        @foreach($teachers as $teacher)
            <tr>
                <td>
                    {{ $communities[$teacher->code] }}<br>
                    <?php 
                        $badge = ($teacher->teacher_season->season==1)?"primary":"warning text-dark";
                    ?>
                    <span class="badge rounded-pill bg-{{ $badge }}">
                        {{ $teacher->teacher_season->year }} {{ $seasons[$teacher->teacher_season->season] }}
                    </span>  
                    <small>
                        {{ $teacher->teacher_season->start_date }}   
                    </small>   
                </td>
                <td>
                    {{ $teacher->name }}
                </td>
                <td>
                    {{ $teacher->sex }}
                </td>
                <td>
                    {{ $teacher->course_name }}
                </td>
                <td>
                    {{ $teacher->ps }}
                </td>                
                @auth
                <td>
                    @if(in_array(auth()->user()->code,$codes))
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('teachers.create_one',$teacher->teacher_season_id) }}" class="btn btn-outline-success btn-sm">增</a>
                            <a href="{{ route('teachers.edit_one',$teacher->id) }}" class="btn btn-outline-primary btn-sm">編</a>
                            <a href="{{ route('teachers.delete_one',$teacher->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('確定刪除？')">刪</a>
                        </div>
                    @endif
                </td>
                @endauth                
            </tr>
        @endforeach
    </tbody>
</table>
{{ $teachers->links() }}
<script>
    function jump(){
        location.href = '{{ env('APP_URL') }}'+'/teachers/index/'+$('#select_school').val();
    }
</script>
<br>
@endsection