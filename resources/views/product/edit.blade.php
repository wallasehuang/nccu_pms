@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
   <form class="form-horizontal" method="post" id="form" action="{{URL::to('product/edit')}}">
    <div class="modal-content row">
      <div class="modal-header col-lg-12">
        <h4 class="modal-title">商品管理 > 編輯</h4>
      </div>

      <div class="modal-body col-lg-12">
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*商品名稱</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm" name="name" placeholder="請輸入商品名稱" value="{{$product->name}}">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*商品成本</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="cost" placeholder="商品成本" value="{{$product->cost}}">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*商品售價</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="price" placeholder="商品售價" value="{{$product->price}}">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*前置天數</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="period" placeholder="前置天數" value="{{$product->period}}">
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('product/list')}}'">取消</button>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" id="id" name="id" value="{{$product->id}}"/>
    </div>
  </form>
</div>
</div>

@endSection
@section('script')
<script src="{{URL::asset('js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script>
  $(document).ready(function(){

    $("input[name='cost']").TouchSpin({
      min: 0,
      max: 999999,
      step: 100,
      decimals: 0,
      boostat: 10,
      maxboostedstep: 100,
      forcestepdivisibility:'none',
      prefix: '<i class="zmdi zmdi-money" aria-hidden="true"></i>',
      postfix: '新台幣'
    });
    $("input[name='price']").TouchSpin({
      min: 0,
      max: 999999,
      step: 100,
      decimals: 0,
      boostat: 10,
      maxboostedstep: 100,
      forcestepdivisibility:'none',
      prefix: '<i class="zmdi zmdi-money" aria-hidden="true"></i>',
      postfix: '新台幣'
    });

    $("input[name='period']").TouchSpin({
      min: 0,
      max: 10,
      step: 1,
      decimals: 0,
      boostat: 1,
      maxboostedstep: 1,
      forcestepdivisibility:'none',
      prefix:'<i class="zmdi zmdi-truck" aria-hidden="true"></i>',
      postfix: '天'
    });

    var validator = $("#form").validate({
      rules: {
        name:"required",
        cost:{
          required:true,
          digits:true,
          min:0,
        },
        price:{
          required:true,
          digits:true,
          min:function(){return parsenInt$('[name=cost]').val},
        },
        period:{
          required:true,
          digits:true,
          min:0,
        }
      },
      messages: {
        name: {
          required :"商品名稱為必填",
        },
        cost:{
          required:"商品成本為必填",
          digits:"請輸入數字",
          min:"數字請大於0"
        },
        price:{
          required:"商品價格為必填",
          digits:"請輸入數字",
          min:"價格請大於成本"
        },
        price:{
          required:"前置天數為必填",
          digits:"請輸入數字",
          min:"天數請大於0"
        }
      }
    });


    $('#form').removeAttr('novalidate');
    $('#form').validate();
  });


</script>
@endSection
