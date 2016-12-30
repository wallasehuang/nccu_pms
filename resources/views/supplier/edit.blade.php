@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
   <form class="form-horizontal" method="post" id="form" action="{{URL::to('supplier/edit')}}">
    <div class="modal-content row">
      <div class="modal-header col-lg-12">
        <h4 class="modal-title">供應商管理 > 編輯</h4>
      </div>

      <div class="modal-body col-lg-12">
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*供應商名稱</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm" name="name" placeholder="請輸入供應商名稱" value="{{$supplier->name}}">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*聯絡電話</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="phone" placeholder="聯絡電話" value="{{$supplier->phone}}">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*聯絡地址</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="address" placeholder="聯絡地址" value="{{$supplier->address}}">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*訂貨單位成本</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="cost" placeholder="訂貨單位成本" value="{{$supplier->cost}}">
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('supplier/list')}}'">取消</button>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" id="id" name="id" value="{{$supplier->id}}"/>
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
      max: 10,
      step: 1,
      decimals: 0,
      boostat: 10,
      maxboostedstep: 100,
      forcestepdivisibility:'none',
      prefix: '<i class="zmdi zmdi-money" aria-hidden="true"></i>',
      postfix: '單位成本'
    });

    var validator = $("#form").validate({
      rules: {
        name:"required",
        phone:"required",
        address:"required",
        cost:"required",
      },
      messages: {
        name: {
          required :"供應商名稱為必填",
        },
        phone: {
          required :"聯絡電話為必填",
        },
        address: {
          required :"聯絡地址為必填",
        },
        cost:{
          required:"訂貨單位成本為必填"
        }
       }
      });

    $('#form').removeAttr('novalidate');
    $('#form').validate();
  });


</script>
@endSection
