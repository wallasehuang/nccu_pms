@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>進貨管理<small>請輸入關鍵字進行查詢</small></h2>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="product">商品名稱</th>
          <th data-column-id="supplier">供應商名稱</th>
          <th data-column-id="quantity">訂購數量</th>
          <th data-column-id="state" data-formatter="state">狀態</th>
          <th data-column-id="date">訂購日期</th>
           <th data-column-id="state" data-visible="false">state</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($sup_order as $order)
        <tr>
         <td>{{ $i}}</td>
         <td>{{ $order->product->name }}</td>
         <td>{{ $order->product->supplier->name }}</td>
         <td>{{ $order->quantity }}</td>
         <td></td>
         <td>{{ $order->created_at }}</td>
         <td>{{ $order->state }}</td>
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
        iconUp: 'zmdi-expand-less',
      },
      formatters: {
        // "commands": function(column, row) {
        //   var edit="<button type=\"button\" onclick=\"edit(this);\" class=\"btn btn-icon bgm-teal waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button>";
        //   return edit;
        // }
        //
        "state":function(column,row){
          var state ="";
          if(row.state == 1){
            state ="<label class=\"label label-info\">已下訂，出貨中...</label>";
          }else if(row.state == 2){
            state ="<label class=\"label label-success\">已到貨</label>";
          }
          return state;
        }

      }
    });
  });

  function edit(obj){
    var id = $(obj).data('row-id');
    window.location.replace("{{{URL::to('supplier/edit')}}}"+"/"+id);
  }

</script>
@endSection
