
@extends('storage/layout')
@section('content')
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">入庫確定画面</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-11 col-md-offset-1">   
    <table class="table text-center">
      <tr>
        <th class="text-center">商品コード</th>
        <th class="text-center">商品名</th>
        <th class="text-center">仮入庫数</th>
        <th class="text-center">削除</th>
      </tr>
      @foreach($dataList as $data)
      <tr>
        <td>{{ $data->product_no }}</td>
        <td>{{ $data->product_name }}</td>
        <td>{{ $data->cnt }}</td>
        <td>
          <form action="/storing" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    <form action="/storing" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-default">登録</button>
    </form>        
    <div><a href="/home" class="btn btn-default">もどる</a></div>

</div>
</div>
@endsection