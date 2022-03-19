@extends('layouts.master')

@section('title','公告訊息-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>公告訊息</h1>
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
@endsection