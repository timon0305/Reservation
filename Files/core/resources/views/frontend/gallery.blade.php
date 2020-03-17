@extends('frontend.master')
@section('title','Gallery')
@section('content')
    <!-- agent details begin-->
    @include('frontend.partials.breadcrumb',['title'=>'Gallery','item'=>['Gallery'=>null]])

    <section class="portfolio-area section-padding">

        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 centered">
                    <div class="section-title">
                        <h2 class="cl-black mb-40">{{web_setting()->gallery_gallery_section_title_1}}</h2>
                        <p>{{web_setting()->gallery_gallery_section_title_2}}</p>
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


@endsection