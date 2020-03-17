@extends('frontend.master')
@section('title','Payment gateway')
@section('content')
    <!--Custom Hero Area-->
    @include('frontend.partials.breadcrumb',['title'=>'select payment gateways','item'=>['payment gateways'=>null]])
    <!--Account Area-->
    <section class="account-area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($gateway as $gat)
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <div class="card mb-4">
                            <div class="card-body p-1 color-base text-center font-weight-bold">
                                {{$gat->name}}
                            </div>
                            <div class="card-body p-1">
                                <img src="{{asset('assets/backend/image/gateway/'.$gat->id.'.jpg')}}">
                            </div>
                            <div class="card-body p-1">
                                <a href="{{route('insert_reservation',$gat->id)}}" class="bttn btn-fill btn-block">Select</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--/Account Area-->


@endsection