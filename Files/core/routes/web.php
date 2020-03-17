<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'/ipn','namespace'=>'Frontend'],function () {
    //Payment IPN
    Route::get('/ipnbtc', 'HomeController@ipnBchain')->name('ipn.bchain');
    Route::get('/ipnblockbtc', 'HomeController@blockIpnBtc')->name('ipn.block.btc');
    Route::get('/ipnblocklite', 'HomeController@blockIpnLite')->name('ipn.block.lite');
    Route::get('/ipnblockdog', 'HomeController@blockIpnDog')->name('ipn.block.dog');
    Route::post('/ipnpaypal', 'HomeController@ipnpaypal')->name('ipn.paypal');
    Route::post('/ipnperfect', 'HomeController@ipnperfect')->name('ipn.perfect');
    Route::post('/ipnstripe', 'HomeController@ipnstripe')->name('ipn.stripe');
    Route::post('/ipnskrill', 'HomeController@skrillIPN')->name('ipn.skrill');
    Route::post('/ipncoinpaybtc', 'HomeController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
    Route::post('/ipncoinpayeth', 'HomeController@ipnCoinPayEth')->name('ipn.coinPay.eth');
    Route::post('/ipncoinpaybch', 'HomeController@ipnCoinPayBch')->name('ipn.coinPay.bch');
    Route::post('/ipncoinpaydash', 'HomeController@ipnCoinPayDash')->name('ipn.coinPay.dash');
    Route::post('/ipncoinpaydoge', 'HomeController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
    Route::post('/ipncoinpayltc', 'HomeController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
    Route::post('/ipncoin', 'HomeController@ipnCoin')->name('ipn.coinpay');
    Route::post('/ipncoingate', 'HomeController@ipnCoinGate')->name('ipn.coingate');

    Route::post('/ipnpaytm', 'HomeController@ipnPayTm')->name('ipn.paytm');
    Route::post('/ipnpayeer', 'HomeController@ipnPayEer')->name('ipn.payeer');
    Route::post('/ipnpaystack', 'HomeController@ipnPayStack')->name('ipn.paystack');
    Route::post('/ipnvoguepay', 'HomeController@ipnVoguePay')->name('ipn.voguepay');
});

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/room-list', 'Frontend\HomeController@roomList')->name('room-list');
Route::get('/room-details/{id}', 'Frontend\HomeController@roomDetails')->name('room_details');
Route::get('/room-details/{id}/check-available', 'Frontend\HomeController@checkAvailableRoom')->name('check_available_room');
Route::post('/booking/{id}', 'Frontend\HomeController@booking')->name('booking');
Route::get('/checkout', 'Frontend\HomeController@checkout')->name('checkout');
Route::get('/confirm-checkout', 'Frontend\HomeController@confirmCheckout')->name('confirm-checkout');
Route::post('/apply-coupon', 'Frontend\HomeController@applyCoupon')->name('apply-coupon');
Route::get('/select-gateway', 'Frontend\HomeController@selectGateway')->name('select_gateway');
Route::get('/insert-reservation/{gateway_id}', 'Frontend\HomeController@insertReservation')->name('insert_reservation');
Route::get('/payment-preview', 'Frontend\HomeController@paymentPreview')->name('payment.preview');

//payment
Route::post('payment/confirm', 'Frontend\HomeController@paymentConfirm')->name('payment.confirm');
Route::get('reservation/success', 'Frontend\HomeController@reservationSuccess')->name('reservation.success');




Route::get('/blog/{cat_id?}', 'Frontend\HomeController@blog')->name('blog');
Route::get('/blog/{id}/{slug}', 'Frontend\HomeController@blogDetails')->name('blog-details');
Route::get('/about', 'Frontend\HomeController@about')->name('about');
Route::get('/gallery', 'Frontend\HomeController@gallery')->name('gallery');
Route::get('/faq', 'Frontend\HomeController@faq')->name('faq');
Route::get('/contact', 'Frontend\HomeController@contact')->name('contact');
Route::post('/contact','Frontend\HomeController@contactSubmit')->name('contact.submit');

Route::group(['middleware'=>'guest'],function(){

    //backend

    Route::get('admin','Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login','Backend\Auth\LoginController@login')->name('admin.login.post');
    Route::post('admin/logout', 'Backend\Auth\LoginController@logout')->name('admin.logout');

});



    Route::group(['prefix'=>'/admin','middleware' => 'auth:admin'],function () {
        Route::post('user-profile/change-password','ProfileController@changePasswordStore')->name('admin.user_profile.change_password.store');
        Route::get('/dashboard', 'Backend\Admin\DashboardController@index')->name('backend.admin.dashboard');

        Route::group(['middleware' => 'permission:admin'],function () {
            ////////////////////Hotel Configure////////////////////////////////
            ///             Amenities

            Route::get('amenities', 'Backend\Admin\HotelConfigure\AmenitiesController@index')->name('backend.admin.amenities');
            Route::get('amenities/create', 'Backend\Admin\HotelConfigure\AmenitiesController@create')->name('backend.admin.amenities.create');
            Route::post('amenities/store', 'Backend\Admin\HotelConfigure\AmenitiesController@store')->name('backend.admin.amenities.store');
            Route::get('amenities/{id}/edit', 'Backend\Admin\HotelConfigure\AmenitiesController@edit')->name('backend.admin.amenities.edit');
            Route::post('amenities/{id}/update', 'Backend\Admin\HotelConfigure\AmenitiesController@update')->name('backend.admin.amenities.update');
            Route::post('amenities/{id}/delete', 'Backend\Admin\HotelConfigure\AmenitiesController@delete')->name('backend.admin.amenities.delete');
            ///             Floor

            Route::get('floor', 'Backend\Admin\HotelConfigure\FloorController@index')->name('backend.admin.floor');
            Route::get('floor/create', 'Backend\Admin\HotelConfigure\FloorController@create')->name('backend.admin.floor.create');
            Route::post('floor/store', 'Backend\Admin\HotelConfigure\FloorController@store')->name('backend.admin.floor.store');
            Route::get('floor/{id}/edit', 'Backend\Admin\HotelConfigure\FloorController@edit')->name('backend.admin.floor.edit');
            Route::post('floor/{id}/update', 'Backend\Admin\HotelConfigure\FloorController@update')->name('backend.admin.floor.update');
            Route::post('floor/{id}/delete', 'Backend\Admin\HotelConfigure\FloorController@delete')->name('backend.admin.floor.delete');
            ///             Tax

            Route::get('tax', 'Backend\Admin\HotelConfigure\TaxController@index')->name('backend.admin.tax');
            Route::get('tax/create', 'Backend\Admin\HotelConfigure\TaxController@create')->name('backend.admin.tax.create');
            Route::post('tax/store', 'Backend\Admin\HotelConfigure\TaxController@store')->name('backend.admin.tax.store');
            Route::get('tax/{id}/edit', 'Backend\Admin\HotelConfigure\TaxController@edit')->name('backend.admin.tax.edit');
            Route::post('tax/{id}/update', 'Backend\Admin\HotelConfigure\TaxController@update')->name('backend.admin.tax.update');
            Route::post('tax/{id}/delete', 'Backend\Admin\HotelConfigure\TaxController@delete')->name('backend.admin.tax.delete');
            ///             Paid service

            Route::get('paid-service', 'Backend\Admin\HotelConfigure\PaidServiceController@index')->name('backend.admin.paid_service');
            Route::get('paid-service/create', 'Backend\Admin\HotelConfigure\PaidServiceController@create')->name('backend.admin.paid_service.create');
            Route::post('paid-service/store', 'Backend\Admin\HotelConfigure\PaidServiceController@store')->name('backend.admin.paid_service.store');
            Route::get('paid-service/{id}/edit', 'Backend\Admin\HotelConfigure\PaidServiceController@edit')->name('backend.admin.paid_service.edit');
            Route::post('paid-service/{id}/update', 'Backend\Admin\HotelConfigure\PaidServiceController@update')->name('backend.admin.paid_service.update');
            Route::post('paid-service/{id}/delete', 'Backend\Admin\HotelConfigure\PaidServiceController@delete')->name('backend.admin.paid_service.delete');

            ///             Coupon Master

            Route::get('coupon', 'Backend\Admin\HotelConfigure\CouponMasterController@index')->name('backend.admin.coupon');
            Route::get('coupon/create', 'Backend\Admin\HotelConfigure\CouponMasterController@create')->name('backend.admin.coupon.create');
            Route::post('coupon/store', 'Backend\Admin\HotelConfigure\CouponMasterController@store')->name('backend.admin.coupon.store');
            Route::get('coupon/{id}/edit', 'Backend\Admin\HotelConfigure\CouponMasterController@edit')->name('backend.admin.coupon.edit');
            Route::post('coupon/{id}/update', 'Backend\Admin\HotelConfigure\CouponMasterController@update')->name('backend.admin.coupon.update');
            Route::post('coupon/{id}/delete', 'Backend\Admin\HotelConfigure\CouponMasterController@delete')->name('backend.admin.coupon.delete');
            ///             Room

            Route::get('room', 'Backend\Admin\HotelConfigure\RoomController@index')->name('backend.admin.room');
            Route::get('room/create', 'Backend\Admin\HotelConfigure\RoomController@create')->name('backend.admin.room.create');
            Route::post('room/store', 'Backend\Admin\HotelConfigure\RoomController@store')->name('backend.admin.room.store');
            Route::get('room/{id}/edit', 'Backend\Admin\HotelConfigure\RoomController@edit')->name('backend.admin.room.edit');
            Route::post('room/{id}/update', 'Backend\Admin\HotelConfigure\RoomController@update')->name('backend.admin.room.update');
            Route::post('room/{id}/delete', 'Backend\Admin\HotelConfigure\RoomController@delete')->name('backend.admin.room.delete');
            /**                Room type***/
            Route::get('room-type', 'Backend\Admin\HotelConfigure\RoomTypeController@index')->name('backend.admin.room_type');
            Route::get('room-type/create', 'Backend\Admin\HotelConfigure\RoomTypeController@create')->name('backend.admin.room_type.create');
            Route::post('room-type/store', 'Backend\Admin\HotelConfigure\RoomTypeController@store')->name('backend.admin.room_type.store');
            Route::get('room-type/{id}/view', 'Backend\Admin\HotelConfigure\RoomTypeController@view')->name('backend.admin.room_type.view');
            Route::get('room-type/{id}/edit', 'Backend\Admin\HotelConfigure\RoomTypeController@edit')->name('backend.admin.room_type.edit');
            Route::post('room-type/{id}/update', 'Backend\Admin\HotelConfigure\RoomTypeController@update')->name('backend.admin.room_type.update');
            /**                Room type   image* **/
            Route::post('room-type/upload-image', 'Backend\Admin\HotelConfigure\RoomTypeController@uploadImage')->name('backend.admin.room_type_upload_image');
            Route::post('room-type/delete-image', 'Backend\Admin\HotelConfigure\RoomTypeController@deleteImage')->name('backend.admin.room_type_delete_image');
            Route::get('room-type/{room_type_id}/{id}/set-as-featured', 'Backend\Admin\HotelConfigure\RoomTypeController@setAsFeatured')->name('backend.admin.room_type_set_as_featured');
            /**                Room type   update regular price* **/

            Route::post('room-type/regular-price/{id}/update', 'Backend\Admin\HotelConfigure\RoomTypeController@regularPriceUpdate')->name('backend.admin.regular_price_update');
            Route::post('room-type/special-price/{id}/update', 'Backend\Admin\HotelConfigure\RoomTypeController@specialPriceUpdate')->name('backend.admin.special_price_update');

            ///////////////////////////////// Manage Staff///////////////////////
            Route::get('staff', 'Backend\Admin\StaffController@index')->name('backend.admin.staff');
            Route::get('staff/create', 'Backend\Admin\StaffController@create')->name('backend.admin.staff.create');
            Route::post('staff/store', 'Backend\Admin\StaffController@store')->name('backend.admin.staff.store');
            Route::get('staff/{id}/view', 'Backend\Admin\StaffController@view')->name('backend.admin.staff.view');
            Route::post('staff/{id}/update', 'Backend\Admin\StaffController@update')->name('backend.admin.staff.update');
        });

        ///////////////////////////////// gusts///////////////////////
        Route::get('guests', 'Backend\Admin\GuestController@index')->name('backend.admin.guests');
        Route::get('guests/create', 'Backend\Admin\GuestController@create')->name('backend.admin.guests.create');
        Route::post('guests/store', 'Backend\Admin\GuestController@store')->name('backend.admin.guests.store');
        Route::get('guests/{id}/view', 'Backend\Admin\GuestController@view')->name('backend.admin.guests.view');
        Route::post('guests/{id}/update', 'Backend\Admin\GuestController@update')->name('backend.admin.guests.update');
        ///////////////////////////////// Reservation///////////////////////
        Route::get('reservations/{booking_type?}', 'Backend\Admin\ReservationController@index')->name('backend.admin.reservation');
        Route::get('reservation/create', 'Backend\Admin\ReservationController@create')->name('backend.admin.reservation.create');
        Route::post('reservation/store', 'Backend\Admin\ReservationController@store')->name('backend.admin.reservation.store');
        Route::get('reservation/{id}/view', 'Backend\Admin\ReservationController@view')->name('backend.admin.reservation.view');
        Route::get('reservation/{id}/confirm', 'Backend\Admin\ReservationController@confirm')->name('backend.admin.reservation.confirm');
        Route::post('reservation/{id}/confirm-post', 'Backend\Admin\ReservationController@confirmPost')->name('backend.admin.reservation.confirm_post');
        Route::get('reservation/{id}/change-status/{status}', 'Backend\Admin\ReservationController@changeStatus')->name('backend.admin.reservation.change_status');
        Route::post('reservation/{id}/payment', 'Backend\Admin\ReservationController@payment')->name('backend.admin.reservation.payment');
        Route::post('reservation/{id}/add_service', 'Backend\Admin\ReservationController@addService')->name('backend.admin.reservation.add_service');
        Route::post('reservation/{id}/remove_service', 'Backend\Admin\ReservationController@removeService')->name('backend.admin.reservation.remove_service');
        Route::post('reservation/{id}/cancel_room', 'Backend\Admin\ReservationController@cancelRoom')->name('backend.admin.reservation.cancel_room');
        Route::post('reservation/{id}/change_room', 'Backend\Admin\ReservationController@changeRoom')->name('backend.admin.reservation.change_room');

        Route::get('reservation/get-room-type-details','Backend\Admin\ReservationController@getRoomTypeDetails')->name('backend.admin.reservation.get_room_type_details');
        Route::get('reservation/get-night-calculation','Backend\Admin\ReservationController@getNightCalculation')->name('backend.admin.reservation.get_night_calculation');
        Route::get('reservation/get-checkout-available-date','Backend\Admin\ReservationController@getCheckOutAvailableDate')->name('backend.admin.reservation.get_checkout_available_date');
        Route::get('reservation/apply-coupon','Backend\Admin\ReservationController@applyCoupon')->name('backend.admin.reservation.apply_coupon');

        ////////////////////Payment////////////////////////////////


        Route::get('gateway/{type?}', 'Backend\Admin\GatewayController@index')->name('admin.gateway');

        Route::post('gatewayListUpdate/{id}', 'Backend\Admin\GatewayController@update')->name('gateway.list.update');
        Route::post('gateway-tore', 'Backend\Admin\GatewayController@store')->name('gateway.list.store');
        Route::get('payment-log/{id?}', 'Backend\Admin\GatewayController@paymentLog')->name('admin.payment_log');
        Route::group(['middleware' => 'permission:admin'],function () {
            ////////////////////Setting////////////////////////////////
            Route::get('general-settings', 'Backend\Admin\GeneralSettingController@generalSetting')->name('backend.admin.general_setting');
            Route::post('general-settings', 'Backend\Admin\GeneralSettingController@generalSettingUpdate')->name('backend.admin.general_setting.update');

            Route::get('email-setting', 'Backend\Admin\GeneralSettingController@emailSetting')->name('backend.admin.email_setting');
            Route::post('email-setting', 'Backend\Admin\GeneralSettingController@emailSettingUpdate')->name('backend.admin.email_setting.update');

            Route::get('sms-setting', 'Backend\Admin\GeneralSettingController@smsSetting')->name('backend.admin.sms_setting');
            Route::post('sms-setting', 'Backend\Admin\GeneralSettingController@smsSettingUpdate')->name('backend.admin.sms_setting.update');


            Route::get('logo-and-fav-setting', 'Backend\Admin\GeneralSettingController@logoAndFavicon')->name('backend.admin.logo_and_fav_setting');
            Route::post('logo-and-fav-setting', 'Backend\Admin\GeneralSettingController@logoAndFaviconUpdate')->name('backend.admin.logo_and_fav_setting.update');


            //blog
            Route::get('/post-category', 'Backend\Admin\PostController@category')->name('admin.cat');
            Route::post('/post-category', 'Backend\Admin\PostController@UpdateCategory')->name('update.cat');
            Route::get('blog', 'Backend\Admin\PostController@index')->name('admin.blog');
            Route::get('blog/create', 'Backend\Admin\PostController@create')->name('blog.create');
            Route::post('blog/create', 'Backend\Admin\PostController@store')->name('blog.store');
            Route::delete('blog/delete', 'Backend\Admin\PostController@destroy')->name('blog.delete');
            Route::get('blog/edit/{id}', 'Backend\Admin\PostController@edit')->name('blog.edit');
            Route::post('blog-update', 'Backend\Admin\PostController@updatePost')->name('blog.update');

            /////////////////////// Web Setting //////////////////////////////

            Route::get('/web-setting/{page}/{section}','Backend\Admin\WebSettingController@sectionEdit')->name('admin.web_setting.section');
            Route::post('/web-setting/{page}/{section}','Backend\Admin\WebSettingController@sectionUpdate')->name('admin.web_setting.section.store');
            /***************** Home ********************/
            ///////Team
            Route::post('/web-settings/home/team/store','Backend\Admin\WebSettingController@teamStore')->name('admin.web_setting.home.team.store');
            Route::post('/web-settings/home/team/{id}/update','Backend\Admin\WebSettingController@teamUpdate')->name('admin.web_setting.home.team.update');
            Route::post('/web-settings/home/team/{id}/delete','Backend\Admin\WebSettingController@teamDelete')->name('admin.web_setting.home.team.delete');
            ///////Category
            Route::post('/web-settings/gallery/category/store','Backend\Admin\WebSettingController@galleryCategoryStore')->name('admin.web_setting.gallery.category.store');
            Route::post('/web-settings/gallery/category/{id}/update','Backend\Admin\WebSettingController@galleryCategoryUpdate')->name('admin.web_setting.gallery.category.update');
            Route::post('/web-settings/gallery/category/{id}/delete','Backend\Admin\WebSettingController@galleryCategoryDelete')->name('admin.web_setting.gallery.category.delete');
            ///////gallery Section
            Route::post('/web-settings/gallery/gallery-section/store','Backend\Admin\WebSettingController@galleryStore')->name('admin.web_setting.gallery.gallery-section.store');
            Route::post('/web-settings/gallery/gallery-section/{id}/update','Backend\Admin\WebSettingController@galleryUpdate')->name('admin.web_setting.gallery.gallery-section.update');
            Route::post('/web-settings/gallery/gallery-section/{id}/delete','Backend\Admin\WebSettingController@galleryDelete')->name('admin.web_setting.gallery.gallery-section.delete');
            ///////Counter Section
            Route::post('/web-settings/home/counter-section/store','Backend\Admin\WebSettingController@counterStore')->name('admin.web_setting.home.counter-section.store');
            Route::post('/web-settings/home/counter-section/{id}/update','Backend\Admin\WebSettingController@counterUpdate')->name('admin.web_setting.home.counter-section.update');
            Route::post('/web-settings/home/counter-section/{id}/delete','Backend\Admin\WebSettingController@counterDelete')->name('admin.web_setting.home.counter-section.delete');
            ///////Testimonial Section
            Route::post('/web-settings/home/testimonial-section/store','Backend\Admin\WebSettingController@testimonialStore')->name('admin.web_setting.home.testimonial-section.store');
            Route::post('/web-settings/home/testimonial-section/{id}/update','Backend\Admin\WebSettingController@testimonialUpdate')->name('admin.web_setting.home.testimonial-section.update');
            Route::post('/web-settings/home/testimonial-section/{id}/delete','Backend\Admin\WebSettingController@testimonialDelete')->name('admin.web_setting.home.testimonial-section.delete');
            ///////Social Link
            Route::post('/web-settings/social/store','Backend\Admin\WebSettingController@socialStore')->name('admin.web_setting.social.store');
            Route::post('/web-settings/social/{id}/update','Backend\Admin\WebSettingController@socialUpdate')->name('admin.web_setting.social.update');
            Route::post('/web-settings/social/{id}/delete','Backend\Admin\WebSettingController@socialDelete')->name('admin.web_setting.social.delete');

            /***************** Facility ********************/
            Route::post('/web-settings/facility/store','Backend\Admin\WebSettingController@facilityStore')->name('admin.web_setting.facility.store');
            Route::post('/web-settings/facility/{id}/update','Backend\Admin\WebSettingController@facilityUpdate')->name('admin.web_setting.facility.update');
            Route::post('/web-settings/facility/{id}/delete','Backend\Admin\WebSettingController@facilityDelete')->name('admin.web_setting.facility.delete');
            /***************** Faq ********************/
            Route::post('/web-settings/faq/store','Backend\Admin\WebSettingController@faqStore')->name('admin.web_setting.faq.store');
            Route::post('/web-settings/faq/{id}/update','Backend\Admin\WebSettingController@faqUpdate')->name('admin.web_setting.faq.update');
            Route::post('/web-settings/faq/{id}/delete','Backend\Admin\WebSettingController@faqDelete')->name('admin.web_setting.faq.delete');
        });


    });




