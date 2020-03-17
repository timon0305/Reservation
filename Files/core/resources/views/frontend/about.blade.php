@extends('frontend.master')
@section('title','About')
@section('content')
    <!-- agent details begin-->
    @include('frontend.partials.breadcrumb',['title'=>'About','item'=>['About'=>null]])

    <!--About Area-->
    <section class="about-area section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-content-area">
                        <div class="about-img wow fadeInLeft" data-wow-delay="0.3s" style="background: url({{asset('assets/frontend/img/home/about_section/about_image.jpg')}}) no-repeat"></div>
                        <div class="about-content cl-white wow fadeInRight" data-wow-delay="0.3s">
                            <h2 class="mb-20">{{web_setting()->home_about_section_title}}</h2>
                            <p class="cl-white mb-20">{{web_setting()->home_about_section_long_details}}</p>
                            <img src="{{asset('assets/frontend/img/home/about_section/sign_image.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/About Area-->

    <!--Team Area-->
    <section class="team-area section-padding pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h2 class="cl-black">{{web_setting()->home_team_section_title_1}}</h2>
                        <p>{{web_setting()->home_team_section_title_2}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($our_teams as $our_team)
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="{{asset('assets/frontend/img/home/team_section/'.$our_team->image)}}" alt="">
                        </div>
                        <div class="team-content">
                            <h3>{{$our_team->name}}</h3>
                            <p>{{$our_team->title}}</p>
                            <div class="team-social">
                                <a href="{{$our_team->fb}}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="{{$our_team->tw}}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                                <a href="{{$our_team->gp}}" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                <a href="{{$our_team->lin}}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
        </div>
    </section><!--/Team Area-->

    <!--Blog Area-->
    <section class="blog-area section-padding">
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-black mb-40">Our Latest Update</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 blog-slider">
                    @foreach($section['our_latest_blog'] as $our_latest_blog)
                        <div class="single-blog wow fadeInUp" data-wow-delay="0.3s">
                            <img src="{{asset('assets/backend/image/blog/post/'.$our_latest_blog->thumb)}}" alt="">
                            <div class="single-blog-content">
                                <div class="single-blog-content-meta">
                                    <a href=""><i class="fa fa-folder-open"></i> {{$our_latest_blog->category->name}}</a><a href=""><i class="fa fa-eye"></i> {{$our_latest_blog->hit}}</a>
                                </div>
                                <h3><a href="{{route('blog-details',[$our_latest_blog->id,str_slug($our_latest_blog->title)])}}">{{$our_latest_blog->title}}</a></h3>
                                <p>{{ str_limit($our_latest_blog->details,100) }}</p>
                                <a class="read-more" href="{{route('blog-details',[$our_latest_blog->id,str_slug($our_latest_blog->title)])}}">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section><!--/Blog Area-->


@endsection