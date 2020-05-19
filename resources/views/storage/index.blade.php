
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
        <th class="text-center">商品ID</th>
        <th class="text-center">商品名</th>
        <th class="text-center">在庫数量</th>
        <th class="text-center">平均仕入単価</th>
        <th class="text-center">平均売却単価</th>
        <th class="text-center">平均利益額</th>
        <th class="text-center">売却単価</th>
        <th class="text-center">出庫数</th>
      </tr>
      @foreach($dataList as $data)
      <tr>
        <td class="text-right">{{ $data->product_no }}</td>
        <td class="text-left">{{ $data->product_name }}</td>
        <td class="text-right">{{ $data->stock_cnt }}</td>
        <td class="text-right">{{ $data->cost }}</td>        
        <td class="text-right">{{ $data->selling }}</td>  
        <td class="text-right">{{ $data->profit }}</td>
        <form action="/storage/leaving/{{ $data->product_no}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <td>
            <input type="text" class="form-control" name="selling" value="">
          </td>        
          <td>
            <input type="text" class="form-control" name="cnt" value="">
          </td>   
          <td>
            <button type="submit" class="btn btn-primary" aria-label="Left Align">出庫</button>          
          </td>
        </form>
      </tr>
      @endforeach
    </table>
    <div>
    <a href="/storage/create" class="btn btn-primary">入庫入力画面</a>
    <a href="/storage/storing" class="btn btn-danger">入庫確定画面</a>
  </div>
</div>
@endsection