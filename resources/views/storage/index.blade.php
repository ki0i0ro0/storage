
@extends('storage/layout')
@section('content')
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">在庫一覧</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <tr>
        <th class="text-center">商品コード</th>
        <th class="text-center">商品名</th>
        <th class="text-center">在庫数量</th>
        <th class="text-center">平均仕入値</th>
        <th class="text-center">平均売値</th>
        <th class="text-center">平均利益額</th>
        <th class="text-center">出庫</th>
      </tr>
      @foreach($dataList as $data)
      <tr>
        <td>
          <a href="/storage/{{ $data->product_no}}/edit">{{ $data->product_no }}</a>
        </td>
        <td>{{ $data->product_name }}</td>
        <td>{{ $data->stock_cnt }}</td>
        <td>{{ $data->cost }}</td>
        <td>{{ $data->selling }}</td>        
        <td>{{ $data->profit }}</td>

        <td>{{ $data->stock_cnt }}</td>
        <td>
          <form action="/storage/{{ $data->product_no }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    <div><a href="/storage/create" class="btn btn-default">入庫</a></div>
    <div><a href="/storing" class="btn btn-default">入庫確定</a></div>
    <div><a href="/home" class="btn btn-default">もどる</a></div>
  </div>
</div>
@endsection