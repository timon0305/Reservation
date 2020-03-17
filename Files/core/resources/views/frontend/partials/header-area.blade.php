<!-- Header Area -->
<header class="main_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('assets/logo.png')}}" alt=""></a>
                    <div class="mobile_toggle">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item {{active_menu([route('home')],'active')}}"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                            <li class="nav-item {{active_menu([route('room-list')],'active')}}"><a class="nav-link" href="{{route('room-list')}}">Room</a></li>
                            <li class="nav-item {{active_menu([route('about')],'active')}}"><a class="nav-link" href="{{route('about')}}">About</a></li>
                            <li class="nav-item {{active_menu([route('gallery')],'active')}}"><a class="nav-link" href="{{route('gallery')}}">Gallery</a></li>
                            <li class="nav-item {{active_menu([route('blog')],'active')}}"><a class="nav-link" href="{{route('blog')}}">Announcement</a></li>
                            <li class="nav-item {{active_menu([route('faq')],'active')}}"><a class="nav-link" href="{{route('faq')}}">FAQ</a></li>
                            <li class="nav-item {{active_menu([route('contact')],'active')}}"><a class="nav-link" href="{{route('contact')}}">Contact Us</a></li>
                            <li class="nav-item  text-white "><a class="small-btn" href="{{route('room-list')}}">Book Now</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header><!-- Header Area -->