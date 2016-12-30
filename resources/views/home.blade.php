@extends('layout.default')
@section('title','後台管理系統')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-3">
			<div class="mini-charts-item bgm-amber brd-2 p-15">
				<div class="c-white m-b-5">日期</div>
				<h2 class="m-0 c-white f-300 text-right">{{DATE('Y-m-d')}}</h2>
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="mini-charts-item bgm-blue brd-2 p-15">
				<div class="c-white m-b-5">月銷售額</div>
				<h2 class="m-0 c-white f-300 text-right" >${{number_format($data['month_sale'])}}</h2>
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="mini-charts-item bgm-green brd-2 p-15">
				<div class="c-white m-b-5">銷貨訂單數</div>
				<h2 class="m-0 c-white f-300 text-right">{{$data['corder_count']}}</h2>
			</div>
		</div>

		<div class="col-sm-6 col-md-3">
			<div class="mini-charts-item bgm-red brd-2 p-15">
				<div class="c-white m-b-5">進貨訂單數</div>
				<h2 class="m-0 c-white f-300 text-right">{{$data['sorder_count']}}</h2>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2>月銷售分佈<small>每個月份總銷售分佈狀況</small></h2>
				</div>
				<div class="card-body card-padding-sm">

					<div id="curved-line-chart" class="flot-chart" style="padding: 0px; position: relative;"></div>
				</div>
			</div>
		</div>

	</div>




</div>
@endsection
@section('script')
<script src="{{URL::asset('vendors/bower_components/flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('vendors/bower_components/flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('vendors/bower_components/flot/jquery.flot.stack.js')}}"></script>
<script src="{{URL::asset('vendors/bower_components/flot-orderBars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{URL::asset('vendors/bower_components/flot/jquery.flot.pie.js')}}"></script>
<script src="{{url('js/home-flot/month_line_chart.js')}}"></script>
<script>
</script>

@endsection
