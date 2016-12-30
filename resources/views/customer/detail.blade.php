@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container invoice">
  <div class="card">
    <div class="card-header ">
      <h2>顧客明細</h2>
    </div>

    <div class="row m-t-25 p-0 m-b-25">
      <div class="col-xs-3">
        <div class="bgm-amber brd-2 p-15">
          <div class="c-white m-b-5">註冊日期</div>
          <h2 class="m-0 c-white f-300 text-right">{{DATE('Y-m-d',strtotime($customer->created_at))}}</h2>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="bgm-blue brd-2 p-15">
          <div class="c-white m-b-5">姓名</div>
          <h2 class="m-0 c-white f-300 text-right" >{{{$customer->name}}}</h2>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="bgm-green brd-2 p-15">
          <div class="c-white m-b-5">聯絡電話</div>
          <h2 class="m-0 c-white f-300 text-right">{{{$customer->phone}}}</h2>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="bgm-red brd-2 p-15">
          <div class="c-white m-b-5">消費總金額</div>
          <h2 class="m-0 c-white f-300 text-right">${{number_format($consumption)}}</h2>
        </div>
      </div>
    </div>

    <table class="table i-table m-t-25 m-b-25">
      <thead class="text-uppercase">
        <th class="c-gray">＃</th>
        <th class="c-gray">商品</th>
        <th class="c-gray">數量</th>
        <th class="c-gray">金額</th>
        <th class="c-gray">購買日期</th>
      </thead>

      <tbody>
        <?php $i=1;?>
        @foreach($customer->order as $order)
        <tr>
          <td>{{$i}}</td>
          <td>{{$order->product->name}}</td>
          <td>{{$order->quantity}}</td>
          <td>{{{$order->quantity * $order->product->price }}}</td>
          <td>{{$order->created_at}}</td>
        </tr>
        <?php $i++;?>
        @endforeach
        <tr>
        <td colspan="4"></td>
          <td class="highlight text-right">總計：{{number_format($consumption)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <button class="btn btn-float bgm-red m-btn" onclick="location.href='{{URL::to('customer/list')}}'" ><i class="zmdi zmdi-arrow-left"></i></button>
</div>
@stop
