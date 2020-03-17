<!--Footer Area-->
<footer class="footer-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.3s">
                <div class="single-footer">
                    <img src="{{asset('assets/logo.png/')}}" alt="">
                    <p>{{web_setting()->general_general_section_footer_content}}
                    </p>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                <div class="row">
                    <div class="col-md-5">
                        <div class="single-footer">
                            <h3>Company</h3>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{route('about')}}">About</a></li>
                                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="single-footer">
                            <h3>Further Information</h3>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{route('gallery')}}">Gallery</a></li>
                                    <li><a href="{{route('blog')}}">Blog</a></li>
                                    <li><a href="{{route('room-list')}}">Rooms</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="single-footer">
                    <h3>Follow Us</h3>
                    <div class="footer-social">
                        @foreach(\App\Model\WebSetting\WebSocial::where('status',1)->get() as $social)
                        <a class="{{$social->name}}" style="background: #{{$social->color?$social->color:'4267B2'}}" href="{{$social->link}}" target="_blank"><i class="fa fa-{{$social->icon}}"></i></a>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!--/Footer Area-->

<!--Copyright-->
<div class="copyright-text">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col centered wow fadeInUp" data-wow-delay="0.3s">
                <p>&copy; {{date('Y')}} All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div><!--/Copyright-->
