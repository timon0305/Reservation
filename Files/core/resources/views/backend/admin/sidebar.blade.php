<ul class="list-unstyled">
    <li class="{{active_menu([route('backend.admin.dashboard')],'active')}}"><a href="{{route('backend.admin.dashboard')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
    <li class="{{active_menu([route('backend.admin.reservation'),route('backend.admin.reservation.create')],'active')}}"><a href="{{route('backend.admin.reservation')}}"><i class="fa fa-fw fa-battery-half"></i> Reservation </a></li>
    <li class="{{active_menu([route('backend.admin.guests'),route('backend.admin.guests.create')],'active',['backend.admin.guests.view'])}}"><a href="{{route('backend.admin.guests')}}"><i class="fa fa-fw fa-user-secret"></i> Guests </a></li>
    @if(auth()->guard('admin')->user()->can_access('admin'))
    <li>
        <a href="#Hotel_configure" data-toggle="collapse">
            <i class="fa fa-fw fa-cubes"></i> Hotel Configuration
        </a>
        <ul id="Hotel_configure" class="list-unstyled collapse {{active_menu([
            route('backend.admin.amenities'),
            route('backend.admin.amenities.create'),
            route('backend.admin.room'),
            route('backend.admin.room.create'),
            route('backend.admin.paid_service'),
            route('backend.admin.paid_service.create'),
            route('backend.admin.coupon'),
            route('backend.admin.coupon.create'),
            route('backend.admin.room_type'),
            route('backend.admin.room_type.create'),
            route('backend.admin.floor'),
            route('backend.admin.tax'),
            route('backend.admin.tax.create'),
            route('backend.admin.floor.create'),
            ],'show',[
            'backend.admin.room_type.edit',
            'backend.admin.room_type.view',
            'backend.admin.amenities.edit',
            'backend.admin.floor.edit',
            'backend.admin.tax.edit',
            'backend.admin.paid_service.edit',
            'backend.admin.coupon.edit',
            'backend.admin.room.edit',
            ])}}">
            <li class="{{active_menu([route('backend.admin.room_type'),route('backend.admin.room_type.create')],'active',['backend.admin.room_type.edit','backend.admin.room_type.view'])}}"> <a href="{{route('backend.admin.room_type')}}"> <i class="fa fa-circle-o"></i> Room Types</a></li>
            <li class="{{active_menu([route('backend.admin.room'),route('backend.admin.room.create')],'active',['backend.admin.room.edit'])}}"> <a href="{{route('backend.admin.room')}}"> <i class="fa fa-circle-o"></i> Room</a></li>
            <li class="{{active_menu([route('backend.admin.paid_service'),route('backend.admin.paid_service.create')],'active',['backend.admin.paid_service.edit'])}}"> <a href="{{route('backend.admin.paid_service')}}"> <i class="fa fa-circle-o"></i> Paid Service</a></li>
            <li class="{{active_menu([route('backend.admin.coupon'),route('backend.admin.coupon.create')],'active',['backend.admin.coupon.edit'])}}"> <a href="{{route('backend.admin.coupon')}}"> <i class="fa fa-circle-o"></i> Coupon Master</a></li>
            <li class="{{active_menu([route('backend.admin.floor'),route('backend.admin.floor.create')],'active',['backend.admin.floor.edit'])}}"> <a href="{{route('backend.admin.floor')}}"> <i class="fa fa-circle-o"></i> Floors</a></li>
            <li class="{{active_menu([route('backend.admin.amenities'),route('backend.admin.amenities.create')],'active',['backend.admin.amenities.edit'])}}"> <a href="{{route('backend.admin.amenities')}}"> <i class="fa fa-circle-o"></i> Amenities</a></li>
            <li class="{{active_menu([route('backend.admin.tax'),route('backend.admin.tax.create')],'active',['backend.admin.tax.edit'])}}"> <a href="{{route('backend.admin.tax')}}"> <i class="fa fa-circle-o"></i> Tax</a></li>
        </ul>
    </li>
    @endif
    <li>
        <a href="#payments" data-toggle="collapse">
            <i class="fa fa-fw fa-credit-card"></i> Payment
        </a>
        <ul id="payments" class="list-unstyled collapse {{active_menu([],'show',['admin.gateway','admin.payment_log'])}}">
            <li class="{{active_menu([route('admin.gateway')],'active')}}"> <a href="{{route('admin.gateway')}}"> <i class="fa fa-credit-card"></i> Getaway</a></li>
            <li class="{{active_menu([route('admin.payment_log')],'active')}}"> <a href="{{route('admin.payment_log')}}"> <i class="fa fa-file-text"></i> Payment Log</a></li>
        </ul>
    </li>
    @if(auth()->guard('admin')->user()->can_access('admin'))
        <li class="{{active_menu([route('backend.admin.staff'),route('backend.admin.staff.create')],'active',['backend.admin.staff.view'])}}"><a href="{{route('backend.admin.staff')}}"><i class="fa fa-fw fa-users"></i> Manage Staff </a></li>
        <li>
        <a href="#Setting" data-toggle="collapse">
            <i class="fa fa-fw fa-cogs"></i>General Setting
        </a>
        <ul id="Setting" class="list-unstyled collapse {{active_menu([
            route('backend.admin.general_setting'),
            route('backend.admin.logo_and_fav_setting'),
            route('backend.admin.email_setting'),
            route('backend.admin.sms_setting')
            ],'show')}}">
            <li class="{{active_menu([route('backend.admin.general_setting')],'active')}}"> <a href="{{route('backend.admin.general_setting')}}"> <i class="fa fa-wrench"></i> General Setting</a></li>
            <li class="{{active_menu([route('backend.admin.logo_and_fav_setting')],'active')}}"><a href="{{route('backend.admin.logo_and_fav_setting')}}"><i class="fa fa-adn"></i> Logo & Favicon</a></li>
            <li class="{{active_menu([route('backend.admin.email_setting')],'active')}}"><a href="{{route('backend.admin.email_setting')}}"><i class="fa fa-envelope"></i> Email Setting</a></li>
            <li class="{{active_menu([route('backend.admin.sms_setting')],'active')}}"><a href="{{route('backend.admin.sms_setting')}}"><i class="fa fa-mobile-phone"></i> SMS Setting</a></li>
        </ul>
    </li>
    <li>
        <a href="#Web_Setting" data-toggle="collapse">
            <i class="fa fa-fw fa-globe"></i>Web Setting
        </a>
        <ul id="Web_Setting" class="list-unstyled collapse {{active_menu([
                    route('admin.blog'),
                    route('admin.cat'),
                ],'show',['admin.web_setting.section'])}}">
            <li>
                <a href="#home" data-toggle="collapse">
                    <i class="fa fa-fw fa-angle-double-down"></i> Home
                </a>
                <ul id="home" class="list-unstyled collapse {{active_menu([
                route('admin.web_setting.section',['home','banner-section']),
                route('admin.web_setting.section',['home','room-section']),
                route('admin.web_setting.section',['home','about-section']),
                route('admin.web_setting.section',['home','service-section']),
                route('admin.web_setting.section',['home','counter-section']),
                route('admin.web_setting.section',['home','testimonial-section']),
                route('admin.web_setting.section',['home','video-section']),
                route('admin.web_setting.section',['home','facility-section']),

                ],'show')}}">
                    <li class="{{active_menu([route('admin.web_setting.section',['home','banner-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','banner-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Banner Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','about-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','about-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> About Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','room-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','room-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Our Room Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','service-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','service-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Service Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','counter-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','counter-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Counter Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','testimonial-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','testimonial-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Testimonial Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','video-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','video-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Video Area</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['home','facility-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','facility-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Our Facility Area</a></li>
                </ul>
            </li>
            <li>
                <a href="#gallery" data-toggle="collapse">
                    <i class="fa fa-fw fa-angle-double-right"></i> Gallery Manage
                </a>
                <ul id="gallery" class="list-unstyled collapse {{active_menu([
                route('admin.web_setting.section',['gallery','category']),
                route('admin.web_setting.section',['gallery','gallery-section']),
                ],'show')}}">
                    <li class="{{active_menu([route('admin.web_setting.section',['gallery','category'])],'active')}}"> <a href="{{route('admin.web_setting.section',['gallery','category'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Category</a></li>
                    <li class="{{active_menu([route('admin.web_setting.section',['gallery','gallery-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['gallery','gallery-section'])}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Gallery</a></li>
                </ul>
            </li>
            <li>
                <a href="#blog" data-toggle="collapse">
                    <i class="fa fa-fw fa-angle-double-right"></i> Blog
                </a>
                <ul id="blog" class="list-unstyled collapse {{active_menu([
                 route('admin.blog'),
                    route('admin.cat'),
                ],'show')}}">
                    <li class="{{active_menu([route('admin.blog')],'active')}}"> <a href="{{route('admin.blog')}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Post</a></li>
                    <li class="{{active_menu([route('admin.cat')],'active')}}"> <a href="{{route('admin.cat')}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Category</a></li>
                </ul>
            </li>
            <li class="{{active_menu([route('admin.web_setting.section',['faq','faq-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['faq','faq-section'])}}"> <i class="fa fa-angle-double-right"></i> FAQ</a></li>
            <li class="{{active_menu([route('admin.web_setting.section',['contact','all-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['contact','all-section'])}}"> <i class="fa fa-angle-double-right"></i> Contact</a></li>
            <li class="{{active_menu([route('admin.web_setting.section',['general','social'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','social'])}}"> <i class="fa fa-angle-double-right"></i> Social Link</a></li>
            <li class="{{active_menu([route('admin.web_setting.section',['general','footer-content'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','footer-content'])}}"> <i class="fa fa-angle-double-right"></i> Footer Content</a></li>
            <li class="{{active_menu([route('admin.web_setting.section',['general','fb-comment-script'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','fb-comment-script'])}}"> <i class="fa fa-angle-double-right"></i> FB Comment Script id</a></li>
            <li class="{{active_menu([route('admin.web_setting.section',['general','login-and-breadcrumb-img'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','login-and-breadcrumb-img'])}}"> <i class="fa fa-angle-double-right"></i> Login & Breadcrumb</a></li>
        </ul>
    </li>
        @endif

</ul>