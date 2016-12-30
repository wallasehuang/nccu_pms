    @extends('layout.default')
    @section('title','後台管理系統')
    @section('content')
    <div class="container">
      <div class="card">
       <form enctype="multipart/form-data" class="form-horizontal" method="post" id="form" action="{{URL::to('product/add')}}">
        <div class="modal-content row">
          <div class="modal-header col-lg-12">
            <h4 class="modal-title">商品管理 > 新增</h4>
          </div>

          <div class="modal-body col-lg-12">
            <!-- name-->
            <div class="form-group" >
              <label class="col-lg-2 col-lg-offset-1 control-label">*商品名稱</label>
              <div class="col-lg-3">
                <div class="fg-line">
                  <input type="text" class="form-control input-sm" name="name" placeholder="請輸入商品名稱">
                </div>
              </div>
              <label class="col-lg-2 control-label">*商品圖片</label>
              <div class="col-lg-3">
               <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                <div>
                  <span class="btn btn-info btn-file waves-effect">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="image">
                  </span>
                  <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
            </div>
          </div>
          <!-- img -->
          <!-- cost -->
          <div class="form-group" >
            <label class="col-lg-2 col-lg-offset-1 control-label">*商品成本</label>
            <div class="col-lg-8">
              <div class="fg-line">
                <input type="text" class="form-control input-sm"  name="cost" placeholder="商品成本">
              </div>
            </div>
          </div>
          <!-- price -->
          <div class="form-group" >
            <label class="col-lg-2 col-lg-offset-1 control-label">*商品售價</label>
            <div class="col-lg-8">
              <div class="fg-line">
                <input type="text" class="form-control input-sm"  name="price" placeholder="商品售價">
              </div>
            </div>
          </div>
          <!-- supplier_id -->
          <div class="form-group" >
            <label class="col-lg-2 col-lg-offset-1 control-label">*供應商</label>
            <div class="col-lg-8">
              <div class="fg-line">
                <select class="chosen" data-placeholder="請選擇供應商..." name="supplier_id">
                  @foreach($suppliers as $supplier)
                  <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <!-- period -->
          <div class="form-group" >
            <label class="col-lg-2 col-lg-offset-1 control-label">*前置天數</label>
            <div class="col-lg-8">
              <div class="fg-line">
                <input type="text" class="form-control input-sm"  name="period" placeholder="前置天數">
              </div>
            </div>
          </div>
          <!-- color -->
          <div class="form-group">
           <label class="col-lg-2 col-lg-offset-1 control-label">*顏色</label>
           <div class="col-lg-8">
             <div class="fg-line">
              <label class="radio radio-inline m-r-20">
                <input type="radio" name="color" value="紅色">
                <i class="input-helper"></i>
                紅色
              </label>

              <label class="radio radio-inline m-r-20">
                <input type="radio" name="color" value="綠色">
                <i class="input-helper"></i>
                綠色
              </label>

              <label class="radio radio-inline m-r-20">
                <input type="radio" name="color" value="藍色">
                <i class="input-helper"></i>
                藍色
              </label>

              <label class="radio radio-inline m-r-20">
                <input type="radio" name="color" value="白色">
                <i class="input-helper"></i>
                白色
              </label>

              <label class="radio radio-inline m-r-20">
                <input type="radio" name="color" value="黑色">
                <i class="input-helper"></i>
                黑色
              </label>

              <label class="radio radio-inline m-r-20">
                <input type="radio" name="color" value="灰色">
                <i class="input-helper"></i>
                灰色
              </label>
            </div>
          </div>
        </div>

      </div>

      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('product/list')}}'">取消</button>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" id="id" name="id" value=""/>
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
          number:true,
          min:0,
        },
        price:{
          required:true,
          number:true,
          min:function(){return parseInt($('[name=cost]').val())},
        },
        supplier_id:"required",
        color:"required",
        period:{
          required:true,
          number:true,
          min:0,
        },
        image:"required",
      },
      messages: {
        name: {
          required :"商品名稱為必填",
        },
        cost:{
          required:"商品成本為必填",
          number:"請輸入數字",
          min:"數字請大於0"
        },
        price:{
          required:"商品價格為必填",
          number:"請輸入數字",
          min:"售價請大於成本"
        },
        suppleir_id:{
          required:"請選擇供應商"
        },
        color:{
          required:"請選擇顏色"
        },
        period:{
          required:"前置天數為必填",
          number:"請輸入數字",
          min:"天數請大於0"
        },
        image:{
          required:"請上傳圖片"
        }
      }
    });

    $('#form').removeAttr('novalidate');
    $('#form').validate();
  });


  </script>
  @endSection
