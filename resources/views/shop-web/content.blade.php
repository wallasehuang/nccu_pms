@extends('shop-web.share')
@section('content')
<div class="col-md-12">

    @if(Auth::guard('customers')->check() && !$recommends->isEmpty())
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                為你推薦
            </h1>
        </div>
        @foreach($recommends as $recommend)
        <div class="col-sm-3 col-lg-3 col-md-3">
            <div class="thumbnail">
                <img src="{{$recommend['img_url']}}" alt="">
                <div class="caption">
                    <h4 class="pull-right">${{$recommend['price']}}</h4>
                    <h4><a href="#">{{$recommend['name']}}</a></h4>
                    <p><strong>顏色：</strong>{{$recommend['color']}}</p>
                    <p><strong>剩餘數量：</strong>{{$recommend['quantity']}}</p>
                    <p class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buy" data-id="{{$recommend['id']}}" data-name = "{{ $recommend['name'] }}" data-img ="{{ $recommend['img_url'] }}" data-price = "{{ $recommend['price'] }}" data-color ="{{ $recommend['color']}}" data-quantity="{{ $recommend['quantity'] }}"onClick="buy(this);">購買</button></p>
                </div>
                <div class="ratings">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                全部商品
            </h1>
        </div>
        @foreach($products as $product)
        <div class="col-sm-3 col-lg-3 col-md-3">
            <div class="thumbnail">
                <img src="{{$product->img_url}}" alt="">
                <div class="caption">
                    <h4 class="pull-right">${{$product->price}}</h4>
                    <h4><a href="#">{{$product->name}}</a></h4>
                    <p><strong>顏色：</strong>{{$product->color}}</p>
                    <p><strong>剩餘數量：</strong>{{$product->quantity}}</p>
                    <p class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buy" data-id = "{{ $product->id }}" data-name = "{{ $product->name }}" data-img ="{{ $product->img_url }}" data-price = "{{ $product->price }}" data-color ="{{ $product->color}}" data-quantity="{{ $product->quantity }}"onClick="buy(this);">購買</button>
                    </p>
                </div>
                <div class="ratings">
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="buy" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="form" class="form-horizontal" method="post" action="{{url('web/shop')}}">
                <div class="modal-content row">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">購買商品</h4>
                </div>
                <div class="modal-body row">

                    <div class="col-lg-3 col-lg-offset-1">
                      <img class="img-thumbnail" name="product_img" src="">
                  </div>
                  <div class="col-lg-8">
                      <div class="form-group">
                          <label class="col-sm-4 control-label">商品名稱</label>
                          <div class="col-sm-8">
                              <div class="fg-line">
                              <input type="text" class="form-control input-sm"  name="product_name" disabled></div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">剩餘數量</label>
                        <div class="col-sm-8">
                          <div class="fg-line"><input type="text" class="form-control input-sm"  name="product_quantity" disabled></div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-4 control-label">顏色</label>
                      <div class="col-sm-8">
                          <div class="fg-line"><input type="text" class="form-control input-sm"  name="product_color" disabled></div>
                    </div>
                </div>

                <div class="form-group" >
                    <label class="col-sm-4 control-label">數量</label>
                    <div class="col-sm-8">
                      <div class="fg-line"><input type="text" class="form-control input-sm"  name="quantity" placeholder="購買數量"></div>
                </div>
            </div>
        </div>
        <input type="hidden" name="product_id" value="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">購買</button>
    </div>
</div>

</div>
</form>
</div>
</div>



@endSection

@section('script')
<script src="{{URL::asset('js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function(){
        $("input[name='quantity']").TouchSpin({
          min: 1,
          max: 1000,
          step: 1,
          decimals: 0,
          boostat: 1,
          maxboostedstep: 1,
          forcestepdivisibility:'none',
      });

    var validator = $("#form").validate({
      rules: {
        quantity:{
            required:true,
            number:true,
            min:1,
            max:function(){return parseInt($('#buy [name=product_quantity]').val())}
        },
      },
      messages: {
        quantity:{
            required:"請輸入購買數量",
            number:"數量必須為數字",
            min:"數量要大於0",
            max:"存貨不足"
        },
      }
    });

    $('#form').removeAttr('novalidate');
    $('#form').validate();
    });
    function buy(obj){
        var productId = $(obj).data('id');
        var productImg = $(obj).data('img');
        var productName = $(obj).data('name');
        var productQuantity = $(obj).data('quantity');
        var productPrice = $(obj).data('price');
        var productColor = $(obj).data('color');

        $('#buy [name = product_id]').val(productId);
        $('#buy [name = product_img]').attr({src:productImg})
        $('#buy [name = product_name]').val(productName);
        $('#buy [name = product_quantity]').val(productQuantity);
        $('#buy [name = product_price]').val(productPrice);
        $('#buy [name = product_color]').val(productColor);
    }

    </script>
    @stop
