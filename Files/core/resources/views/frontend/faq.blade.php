@extends('frontend.master')
@section('title','FAQ')

@section('content')
    <!-- page title begin-->
    @include('frontend.partials.breadcrumb',['title'=>'Faq','item'=>['Faq'=>null]])
    <!-- page title end -->
    <!--Faq Area-->
    <section class="faq-area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h2 class="cl-black">{{web_setting()->faq_faq_section_title_1}}</h2>
                        <p>{{web_setting()->faq_faq_section_title_2}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($faqs->chunk(ceil($faqs->count()/2)) as $chunk)
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="faq-contents">
                        <ul class="accordion">
                            @foreach($chunk as $faq)
                            <li>
                                <a>{{$faq->question}}</a>
                                <p>{{$faq->answer}}</p>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section><!--/Faq Area-->
@endsection

@section('script')

@endsection
