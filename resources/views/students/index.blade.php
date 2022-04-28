@extends('layouts.master')

@section('title','學員統計資料-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    學員統計資料
</h1>
<br>
<br>
@auth
    @if(auth()->user()->code <> "079999")
    <div class="col-3">
        <a href="{{ route('students.create') }}" class="btn btn-success btn-sm">新增</a>
    </div>
    @endif
@endauth
<br>
@foreach($students as $student)
<table class="table table-bordered table-striped">
    <tr>
      <td rowspan="2" colspan="2">
        <h3>{{ $student->year }} {{ $communities[$student->code] }}</h3>
        <br>學員統計資料<br>
        @auth
            @if(auth()->user()->code <> "079999")
              @if(auth()->user()->code == $student->code)
              <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="{{ route('students.edit',$student->id) }}" class="btn btn-outline-primary btn-sm">編</a>
                <a href="{{ route('students.delete',$student->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('確定刪除？')">刪</a>
              </div>
              @endif
            @endif
        @endauth
      </td>
      <td colspan="2">
        春季班
      </td>
      <td colspan="2">
        秋季班
      </td>
      <td rowspan="2">
        合計
      </td>
    </tr>
    <tr>
      <td>
        男性
      </td>
      <td>
        女性
      </td>
      <td>
        男性
      </td>
      <td>
        女性
      </td>
    </tr>
    <tr>
      <td rowspan="4">
        依身分別
      </td>
      <td>
        一般身分
      </td>
      <td>
        {{ $student->t1_sb }}
      </td>
      <td>
        {{ $student->t1_sg }}
      </td>
      <td>
        {{ $student->t1_fb }}
      </td>
      <td>
        {{ $student->t1_fg }}
      </td>
      <td>
        {{ $student->t1_sb+$student->t1_sg+$student->t1_fb+$student->t1_fg }}
      </td>
    </tr>
    <tr>
      <td>
        新住民
      </td>
      <td>
        {{ $student->t2_sb }}
      </td>
      <td>
        {{ $student->t2_sg }}
      </td>
      <td>
        {{ $student->t2_fb }}
      </td>
      <td>
        {{ $student->t2_fg }}
      </td>
      <td>
        {{ $student->t2_sb+$student->t2_sg+$student->t2_fb+$student->t2_fg }}
      </td>
    </tr>
    <tr>
      <td>
        原住民
      </td>
      <td>
        {{ $student->t3_sb }}
      </td>
      <td>
        {{ $student->t3_sg }}
      </td>
      <td>
        {{ $student->t3_fb }}
      </td>
      <td>
        {{ $student->t3_fg }}
      </td>
      <td>
        {{ $student->t3_sb+$student->t3_sg+$student->t3_fb+$student->t3_fg }}
      </td>
    </tr>
    <tr>
      <td>
        身心障礙者
      </td>
      <td>
        {{ $student->t4_sb }}
      </td>
      <td>
        {{ $student->t4_sg }}
      </td>
      <td>
        {{ $student->t4_fb }}
      </td>
      <td>
        {{ $student->t4_fg }}
      </td>
      <td>
        {{ $student->t4_sb+$student->t4_sg+$student->t4_fb+$student->t4_fg }}
      </td>
    </tr>
    <tr>
      <td rowspan="4">
        依年齡層
      </td>
      <td>
        18歲以下
      </td>
      <td>
        {{ $student->a1_sb }}
      </td>
      <td>
        {{ $student->a1_sg }}
      </td>
      <td>
        {{ $student->a1_fb }}
      </td>
      <td>
        {{ $student->a1_fg }}
      </td>
      <td>
        {{ $student->a1_sb+$student->a1_sg+$student->a1_fb+$student->a1_fg }}
      </td>
    </tr>
    <tr>
      <td>
        18-55歲
      </td>
      <td>
        {{ $student->a2_sb }}
      </td>
      <td>
        {{ $student->a2_sg }}
      </td>
      <td>
        {{ $student->a2_fb }}
      </td>
      <td>
        {{ $student->a2_fg }}
      </td>
      <td>
        {{ $student->a2_sb+$student->a2_sg+$student->a2_fb+$student->a2_fg }}
      </td>
    </tr>
    <tr>
      <td>
        55-65歲
      </td>
      <td>
        {{ $student->a3_sb }}
      </td>
      <td>
        {{ $student->a3_sg }}
      </td>
      <td>
        {{ $student->a3_fb }}
      </td>
      <td>
        {{ $student->a3_fg }}
      </td>
      <td>
        {{ $student->a3_sb+$student->a3_sg+$student->a3_fb+$student->a3_fg }}
      </td>
    </tr>
    <tr>
      <td>
        65歲以上
      </td>
      <td>
        {{ $student->a4_sb }}
      </td>
      <td>
        {{ $student->a4_sg }}
      </td>
      <td>
        {{ $student->a4_fb }}
      </td>
      <td>
        {{ $student->a4_fg }}
      </td>
      <td>
        {{ $student->a4_sb+$student->a4_sg+$student->a4_fb+$student->a4_fg }}
      </td>
    </tr>
  </table>
@endforeach
{{ $students->links() }}

<br>
@endsection