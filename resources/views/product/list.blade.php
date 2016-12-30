@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>商品管理<small>請輸入關鍵字進行查詢</small></h2>
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg" onClick="location.href='{{URL::to('product/add')}}'">新增商品</button></li>
      </ul>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="name">商品名稱</th>
          <th data-column-id="img" data-formatter="img" data-sortable="false">商品圖片</th>
          <th data-column-id="cost">成本</th>
          <th data-column-id="price">售價</th>
          <th data-column-id="info" data-formatter="info" data-sortable="false">商品資訊</th>
          <th data-column-id="commands" data-formatter="commands" data-sortable="false">操作</th>
          <th data-column-id="id" data-visible="false">id</th>
          <th data-column-id="img_url" data-visible="false">img_url</th>
          <th data-column-id="color" data-visible="false">color</th>
          <th data-column-id="supplier" data-visible="false">supplier</th>
          <th data-column-id="period" data-visible="false">period</th>
          <th data-column-id="quantity" data-visible="false">quantity</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($products as $product)
        <tr>
         <td>{{ $i }}</td>
         <td>{{ $product->name }}</td>
         <td></td>
         <td>{{ number_format($product->cost)}}</td>
         <td>{{ number_format($product->price)}}</td>
         <td></td>
         <td></td>
         <td>{{$product->id}}</td>
         <td>{{$product->img_url}}</td>
         <td>{{$product->color}}</td>
         <td>{{$product->supplier->name}}</td>
         <td>{{$product->period}}</td>
         <td>{{$product->quantity}}</td>
         <?php $i++;?>
         @endforeach
       </tbody>
     </table>
   </div>
 </div>
 <span class="errorMsg">
  @foreach ($errors->create->all() as $message)
  {{{$message}}};
  @endforeach
</span>
@endSection
@section('script')
<!-- Data Table -->
<script src="{{asset('vendors/bootgrid/jquery.bootgrid.updated.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //Command Buttons
    var grid = $("#data-table-command").bootgrid({
      css: {
        icon: 'zmdi icon',
        iconColumns: 'zmdi-view-module',
        iconDown: 'zmdi-expand-more',
        iconRefresh: 'zmdi-refresh',
        iconUp: 'zmdi-expand-less'
      },
      formatters: {
        "commands": function(column, row) {
          var edit="<button type=\"button\" onclick=\"edit(this);\" class=\"btn btn-icon bgm-teal waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button>";
          return edit;
        },
        "img":function(column,row){
          var image ="<img src=\""+ row.img_url+ "\" style=\"width:150px; height:150px; float:center;\">";
          return image;
        },
        "info":function(column,row){
          var info ="<p><strong>顏色</strong>："+row.color+"</p><p><strong>供應商</strong>："+row.supplier+"</p><p><strong>前置天數</strong>："+row.period+" 天</p><p><strong>庫存數量</strong>："+row.quantity+"</p>";
          return info;
        }
      }
    });
  });

  function edit(obj){
    var id = $(obj).data('row-id');
    window.location.replace("{{{URL::to('product/edit')}}}"+"/"+id);
  }

</script>
@endSection
