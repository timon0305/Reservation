@extends('frontend.master')
@section('title','Error')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'404','item'=>['404'=>null]])
    <!--404 Area-->
    <section class="notfound-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="notfound-content text-center">
                        <h2 class="section-title mb-30 cl-black text-center">Sorry Page not Found</h2>
                        <div class="notfound-img text-center">
                            <img src="{{asset('assets/frontend/images/404.png')}}" alt="" />
                        </div>

                        <a class="bttn btn-fill" href="{{route('home')}}">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/404 Area-->


@endsection

