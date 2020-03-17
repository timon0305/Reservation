<section class="custom-hero blue-overlay d-print-none" style="background: url({{asset('assets/frontend/img/general/general_section/breadcrumb_image.jpg')}}) no-repeat">
    <div class="container">
        <div class="row justify-content-center cl-white">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 centered wow fadeInUp" data-wow-delay="0.3s">
                <div class="custom-hero-title">
                    <h2>{{ucfirst($title)}}</h2>
                </div>
                <div class="custom-hero-breadcrumb">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        @foreach($item as $key=>$value)
                            @if($value !== null)
                                <li><a href="{{$value}}">{{ucfirst($key)}}</a></li>
                                @else
                                <li> {{ucfirst($key)}} </li>
                                @endif
                            @endforeach
                    </ul>

                </div>
            </div>

        </div>

    </div>
</section><!--/Custom Hero Area-->
