@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>供應商管理<small>請輸入關鍵字進行查詢</small></h2>
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg" onClick="location.href='{{URL::to('supplier/add')}}'">新增供應商</button></li>
      </ul>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="name">供應商名稱</th>
          <th data-column-id="phone">聯絡電話</th>
          <th data-column-id="address">聯絡地址</th>
          <th data-column-id="cost" data-align="center" data-header-align="center">訂貨單位成本</th>
          <th data-column-id="id" data-visible="false">id</th>
          <th data-column-id="commands" data-formatter="commands" data-sortable="false">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($suppliers as $supplier)
        <tr>
         <td>{{ $i}}</td>
         <td>{{ $supplier->name }}</td>
         <td>{{ $supplier->phone }}</td>
         <td>{{ $supplier->address }}</td>
         <td>{{ $supplier->cost }}</td>
         <td>{{ $supplier->id }}</td>
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
        "commands": function(column, row) {
          var edit="<button type=\"button\" onclick=\"edit(this);\" class=\"btn btn-icon bgm-teal waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button>";
          return edit;
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
