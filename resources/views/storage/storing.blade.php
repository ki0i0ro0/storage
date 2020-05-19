
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
          <form action="/storing/delete" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger" aria-label="Left Align">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    <form action="storing/commit" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">入庫確定実行</button>
    </form>        
    <div><a href="/storage" class="btn btn-danger">戻る</a></div>
</div>
</div>
@endsection