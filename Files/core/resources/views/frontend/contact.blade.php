@extends('frontend.master')
@section('title','Contact')

@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Contact','item'=>['Contact'=>null]])
    <!--Contact Area-->
    <section class="contact-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="page-sidebar">
                        <div class="border bg-light price-tag mb-4">
                            <div class="contact-info-single text-center">
                                <i class="fa fa-map-marker"></i>
                                <p>{{web_setting()->contact_all_section_address}}</p>
                            </div>
                        </div>

                        <div class="border bg-light price-tag mb-4">
                            <div class="contact-info-single text-center">
                                <i class="fa fa-envelope"></i>
                                <p>{{web_setting()->contact_all_section_email_web}}</p>
                            </div>
                        </div>
                        <div class="border bg-light price-tag mb-4">
                            <div class="contact-info-single text-center">
                                <i class="fa fa-phone"></i>
                                <p>{{web_setting()->contact_all_section_phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row ">
                        <div class="col-md-12 centered wow fadeInUp" data-wow-delay="0.3s">
                            <div class="section-title">
                                <h2 class="cl-black">{{web_setting()->contact_all_section_title_1}}</h2>
                                <p>{{web_setting()->contact_all_section_title_2}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="contact-form">
                                <form action="{{route('contact.submit')}}" method="post">@csrf

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <input type="text"  name="name" placeholder="Your name" required >

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <input type="email"  name="email" placeholder="Your email address" required >
                                        </div>
                                    </div>
                                    <input type="text" name="subject" placeholder="Enter Your Subject" required >
                                    <textarea name="message" rows="6" placeholder="Message" required></textarea>

                                    <button class="bttn btn-fill mt-4" type="submit">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!--/Contact Area-->

    <!--Contact Map-->
    <section class="contact-area section-padding">
        <div id="map" class="map-area">
            <iframe src="{{web_setting()->contact_all_section_map}}" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
         </div>
    </section><!--/Contact Map-->

@endsection

@section('script')
@endsection
