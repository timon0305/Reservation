
@extends('frontend.master')
@section('title',$pt)
@section('content')
	<!-- error begin-->
	@include('frontend.partials.breadcrumb',['title'=>$pt,'item'=>[$pt=>null]])
	<div class="error-area mt-4">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-8 col-lg-8">
					<div class="single-sidebar-block text-center p-4">
						<h6 style="color: #003399;"> PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> ETH</h6>
						<h5 style="color: #003399;">TO <span style="color: green"> {{ $wallet}}</span></h5>
						<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$qrurl}}&choe=UTF-8" title='' style='width:300px;' />
						<h4 style="font-weight:bold;">SCAN TO SEND</h4>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection