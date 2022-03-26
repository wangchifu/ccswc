@extends('layouts.master')

@section('title','修改學員統計資料-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    {{ $communities[auth()->user()->code] }} 修改學員統計資料
</h1>
<br>
<br>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('students.index') }}">學員統計資料</a></li>
      <li class="breadcrumb-item active" aria-current="page">修改學員統計資料</li>
    </ol>
  </nav>
<form action="{{ route('students.update',$student->id) }}" method="post" id="this_form">
    @csrf
    @method('patch')
    <div class="mb-3 w-25">
      <label for="year" class="form-label"><span class="text-danger">*</span>年度</label>
      <input type="number" class="form-control rq" id="year" name="year" required onclick="change_button2()" value="{{ $student->year }}" maxlength="4">
    </div> 
    <table class="table table-bordered table-striped">
      <tr>
        <td rowspan="2" colspan="2">
          學員統計資料
        </td>
        <td colspan="2">
          春季班(3/31截止填報)
        </td>
        <td colspan="2">
          秋季班(10/31截止填報)
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
          <input type="number" class="form-control" name="t1_sb" value="{{ $student->t1_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t1_sg" value="{{ $student->t1_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t1_fb" value="{{ $student->t1_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t1_fg" value="{{ $student->t1_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
      <tr>
        <td>
          新住民
        </td>
        <td>
          <input type="number" class="form-control" name="t2_sb" value="{{ $student->t2_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t2_sg" value="{{ $student->t2_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t2_fb" value="{{ $student->t2_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t2_fg" value="{{ $student->t2_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
      <tr>
        <td>
          原住民
        </td>
        <td>
          <input type="number" class="form-control" name="t3_sb" value="{{ $student->t3_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t3_sg" value="{{ $student->t3_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t3_fb" value="{{ $student->t3_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t3_fg" value="{{ $student->t3_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
      <tr>
        <td>
          身心障礙者
        </td>
        <td>
          <input type="number" class="form-control" name="t4_sb" value="{{ $student->t4_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t4_sg" value="{{ $student->t4_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t4_fb" value="{{ $student->t4_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="t4_fg" value="{{ $student->t4_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
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
          <input type="number" class="form-control" name="a1_sb" value="{{ $student->a1_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a1_sg" value="{{ $student->a1_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a1_fb" value="{{ $student->a1_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a1_fg" value="{{ $student->a1_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
      <tr>
        <td>
          18-55歲
        </td>
        <td>
          <input type="number" class="form-control" name="a2_sb" value="{{ $student->a2_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a2_sg" value="{{ $student->a2_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a2_fb" value="{{ $student->a2_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a2_fg" value="{{ $student->a2_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
      <tr>
        <td>
          55-65歲
        </td>
        <td>
          <input type="number" class="form-control" name="a3_sb" value="{{ $student->a3_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a3_sg" value="{{ $student->a3_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a3_fb" value="{{ $student->a3_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a3_fg" value="{{ $student->a3_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
      <tr>
        <td>
          65歲以上
        </td>
        <td>
          <input type="number" class="form-control" name="a4_sb" value="{{ $student->a4_sb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a4_sg" value="{{ $student->a4_sg }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a4_fb" value="{{ $student->a4_fb }}">
        </td>
        <td>
          <input type="number" class="form-control" name="a4_fg" value="{{ $student->a4_fg }}">
        </td>
        <td>
          <input type="number" class="form-control" readonly>
        </td>
      </tr>
    </table>

    <div class="mb-3">
        <a href="#" class="btn btn-secondary" onclick="history.back()">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>    
    @include('layouts.change_button')
    
  </form>
<br>
@endsection