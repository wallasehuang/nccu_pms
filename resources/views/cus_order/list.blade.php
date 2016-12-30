@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>銷貨管理<small>請輸入關鍵字進行查詢</small></h2>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="customer">顧客名稱</th>
          <th data-column-id="product">商品名稱</th>
          <th data-column-id="quantity">購買數量</th>
          <th data-column-id="date">購買日期</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($cus_order as $order)
        <tr>
         <td>{{ $i}}</td>
         <td>{{ $order->customer->name }}</td>
         <td>{{ $order->product->name }}</td>
         <td>{{ $order->quantity }}</td>
         <td>{{ $order->created_at }}</td>
         <?php $i++;?>
         @endforeach
       </tbody>
     </table>
   </div>
 </div>
 <span class="errorMsg">
  @foreach ($errors as $message)
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
        // "commands": function(column, row) {
        //   var view="<button type=\"button\" onclick=\"location.href='{{url('order/detail')}}?id=" + row.id +"'\" class=\"btn btn-icon bgm-cyan waves-effect command-delete waves-circle\">  <span class=\"zmdi zmdi-view-module\"></span></button> ";
        //   return edit;
        }

    });
  });

  function edit(obj){
    var id = $(obj).data('row-id');
    window.location.replace("{{{URL::to('supplier/edit')}}}"+"/"+id);
  }

</script>
@endSection
