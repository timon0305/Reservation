@extends('frontend.master')
@section('title','Home')
@section('content')

    <!--Hero Area-->
    <section class="hero-area dark-overlay" style="background: url({{asset('assets/frontend/img/home/banner_section/banner_image.jpg')}}) no-repeat">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="hero-content cl-white centered">
                        <h3 class="wow fadeInUp" data-wow-delay="0.3s">{{web_setting()->home_banner_section_title_1}}</h3>
                        <h1 class="wow fadeInUp" data-wow-delay="0.4s">{{web_setting()->home_banner_section_title_2}}</h1>
                        <h5 class="mb-40 wow fadeInUp" data-wow-delay="0.5s">{{web_setting()->home_banner_section_title_3}}</h5>
                    </div>
                </div>
            </div>

            <div class="row hero-search">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hero-filter-search wow fadeInUp" data-wow-delay="0.6s">
                        @include('frontend.partials.search')
                    </div>
                </div>
            </div>

        </div>
    </section><!--/Hero Area-->

   <!--About Area-->
    <section class="about-area section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-content-area">
                        <div class="about-img wow fadeInLeft" data-wow-delay="0.3s" style="background: url({{asset('assets/frontend/img/home/about_section/about_image.jpg')}}) no-repeat"></div>
                        <div class="about-content cl-white wow fadeInRight" data-wow-delay="0.3s">
                            <h2 class="mb-20">{{web_setting()->home_about_section_title}}</h2>
                            <p class="cl-white mb-40">{{web_setting()->home_about_section_short_details}}</p>
                            <a href="{{route('about')}}" class="bttn btn-fill">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/About Area-->

    <!--Rooms and Suites Area-->
    <section class="rooms-suites-area pb-5 section-padding mb-m30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered wow fadeInUp" data-wow-delay="0.3s">
                        <div class="section-title">
                            <h2 class="cl-black">{{web_setting()->home_room_section_title}}

                            </h2>
                            <p class=" offset-md-2 col-md-8">{{web_setting()->home_room_section_title_sub}}

                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($room_types as $room_type)
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single-room-block">
                        <img src="{{asset('assets/backend/image/room_type_image_th/'.optional($room_type->featuredImage())->image)}}" alt="">
                        <h3 class="mb-4"><a href="{{route('room_details',$room_type->id)}}">{{$room_type->title}}</a></h3>

                        <div class="rooms-book-price">
                            <a class="small-btn" href="{{route('room_details',$room_type->id)}}">Book Now <i class="ti-arrow-right"></i></a>
                            <span>{{general_setting()->cur_sym}}{{$room_type->base_price}} <i>/Night</i></span>
                        </div>
                    </div>
                </div>

                @empty
                    <div class="col-lg-12 wow fadeInUp border p-md-5" data-wow-delay="0.4s">
                        <h1 class="text-warning text-center">No Room!</h1>
                    </div>
                    @endforelse
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <a class="small-btn float-md-right" href="{{route('room-list')}}">View All Rooms <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Rooms and Suites Area-->

    <section class="service-area  dark-overlay section-padding">
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-white mb-40">{{web_setting()->home_service_section_title}}</h2>
                        <p class="cl-white offset-md-2 col-md-8">{{web_setting()->home_service_section_sub_title}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($services as $service)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="single-service-block">
                            <i class="fa fa-{{$service->icon}}"></i>
                            <p >{{$service->title}}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 wow fadeInUp border p-md-5" data-wow-delay="0.4s">
                        <h1 class="text-warning text-center">No Services!</h1>
                    </div>
                @endforelse
            </div>
        </div>
    </section><!--/Testimonial Area-->
    <section class="facility-area section-padding">
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class=" mb-40">{{web_setting()->home_facility_section_title_1}}</h2>
                        <p class="offset-md-2 col-md-8">{{web_setting()->home_facility_section_title_2}}</p>
                    </div>
                </div>
            </div>
            <div class="row  portfolio-gallery column-3 gutter wow fadeInUp">
                <div class="col-lg-12 blog-slider">
                        @foreach(\App\Model\WebSetting\WebFacility::get() as $facility)
                            <div class="portfolio-item cat{{$facility->id}}">
                                <a href="{{asset('assets/frontend/img/home/facility_section/'.$facility->image)}}" class="thumb popup-gallery" title="">

                                    <img src="{{asset('assets/frontend/img/home/facility_section/'.$facility->image)}}" alt="">

                                    <div class="portfolio-hover">
                                        <div class="portfolio-description">
                                            <i class="ti-zoom-in"></i>
                                        </div>
                                    </div>

                                </a>
                                <h3 class="facility-title" style="">{{$facility->name}}</h3>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </section><!--/Blog Area-->
    <!--Counter Area-->
    <section class="counter-area section-padding">
        <div class="container">
            <div class="row">
                @foreach(\App\Model\WebSetting\WebCounterSection::all() as $counter)
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="single-counter">
                        <h3 class="count">{{$counter->number}}</h3>
                        <p>{{$counter->name}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section><!--/Counter Area-->


    <!--Portfolio Section -->
    <section class="portfolio-area section-padding">

        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-black mb-40">{{web_setting()->gallery_gallery_section_title_1}}</h2>
                        <p class=" offset-md-2 col-md-8">{{web_setting()->gallery_gallery_section_title_2}}</p>
                    </div>
                </div>
            </div>

            <div class="text-center mb-20 wow fadeInUp" data-wow-delay="0.4s">
                <ul class="portfolio-filter">
                    <li class="active"><a href="#" data-filter="*"> All</a></li>
                    @foreach(\App\Model\WebSetting\WebGalleryCategory::all() as $cat)
                    <li><a href="#" data-filter=".cat{{$cat->id}}">{{$cat->name}}</a></li>
                  @endforeach
                </ul>
            </div>

            <div class="row portfolio portfolio-gallery column-3 gutter wow fadeInUp" data-wow-delay="0.5s">
                @foreach(\App\Model\WebSetting\WebGallery::get() as $gallery)
                <div class="portfolio-item cat{{$gallery->category_id}}">
                    <?php
                    $thumb_class = '';
                    $icon = 'ti-link';
                    if($gallery->type === 'image'){
                        $thumb_class = 'popup-gallery';
                        $icon = 'ti-search';
                    }elseif ($gallery->type === 'video'){
                        $thumb_class = 'video-popup';
                        $icon = 'ti-control-play';
                    }
                    ?>
                    <a href="{{$gallery->type === 'image'?asset('assets/frontend/img/gallery/gallery_section/'.$gallery->image):$gallery->link}}" class="thumb {{$thumb_class}}" title="">
                        <img src="{{asset('assets/frontend/img/gallery/gallery_section/'.$gallery->image)}}" alt="">
                        <div class="portfolio-hover">
                            <div class="portfolio-description">
                                <i class="{{$icon}}"></i>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section><!--/Portfolio Section-->

    <!--Testimonial Area-->
    <section class="testimonial-area blue-overlay section-padding" >
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-white mb-40">{{web_setting()->home_testimonial_section_title_1}}</h2>
                        <p class="cl-white">{{web_setting()->home_testimonial_section_title_2}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12 mx-auto wow fadeInUp" data-wow-delay="0.4s">
                    <div class="testimonials centered cl-white">
                        @forelse(\App\Model\WebSetting\WebOurClientFeedback::all() as $testimonial)
                        <div class="single-testimonial text-center">
                            <p>{{$testimonial->feed}}</p>
                            <h4>{{$testimonial->name}}</h4>
                            <h5>{{$testimonial->title}}</h5>
                            <p class="testimonials-img " ><img class="" src="{{asset('assets/frontend/img/testimonial/testimonial_section/'.$testimonial->image)}}"></p>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Testimonial Area-->
    <!--Blog Area-->
    <section class="blog-area section-padding">
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-black mb-40">{{web_setting()->blog_blog_section_title_1}}</h2>
                        <p class="cl-black">
                            {{web_setting()->blog_blog_section_title_2}}
                        </p>
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
    <!--Testimonial Area-->
    <section class="video-area dark-overlay section-padding">
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-white mb-40">{{web_setting()->home_video_section_title}}</h2>
                        <p class="cl-white">{{web_setting()->home_video_section_sub_title}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12 mx-auto wow fadeInUp" data-wow-delay="0.4s">
                    <div class=" centered">
                        <iframe width="90%" height="600" src="{{web_setting()->home_video_section_video_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Testimonial Area-->



@endsection
@section('script')
    <script>
        // Date Picker
        $( function() {
            /* global setting */
            var datepickersOpt = {
                dateFormat: 'yy/mm/dd',
                minDate   : 0
            };

            $("#arrival").datepicker($.extend({
                onSelect: function() {
                    var minDate = $(this).datepicker('getDate');
                    minDate.setDate(minDate.getDate()+1); //add two days
                    $("#departure").datepicker( "option", "minDate", minDate);
                }
            },datepickersOpt));

            $("#departure").datepicker($.extend({
                onSelect: function() {
                    var maxDate = $(this).datepicker('getDate');
                    maxDate.setDate(maxDate.getDate()-1);
                    $("#arrival").datepicker( "option", "maxDate", maxDate);
                }
            },datepickersOpt));

        });
    </script>
    @endsection

