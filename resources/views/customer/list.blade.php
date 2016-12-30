@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>會員管理<small>請輸入關鍵字進行查詢</small></h2>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="name">名稱</th>
          <th data-column-id="email">e-mail</th>
          <th data-column-id="phon">電話</th>
          <th data-column-id="address">地址</th>
          <th data-column-id="id" data-visible="false">id</th>
          <th data-column-id="commands" data-formatter="commands" data-sortable="false">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($customers as $customer)
        <tr>
         <td>{{$i}}</td>
         <td>{{$customer->name}}</td>
         <td>{{$customer->email}}</td>
         <td>{{$customer->phone}}</td>
         <td>{{$customer->address}}</td>
         <td>{{$customer->id}}</td>
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
          // var edit="<button type=\"button\" onclick=\"edit(this);\" class=\"btn btn-icon bgm-teal waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button>";
          // return edit;
          var view="<button type=\"button\" onclick=\"location.href='{{url('customer/list')}}/" + row.id +"'\" class=\"btn btn-icon bgm-cyan waves-effect command-delete waves-circle\">  <span class=\"zmdi zmdi-view-module\"></span></button> ";
          return view;
        }
      }
    });
  });

  function edit(obj){
    var id = $(obj).data('row-id');
    window.location.replace("{{{URL::to('product/edit')}}}"+"?id="+id);
  }

</script>
@endSection
