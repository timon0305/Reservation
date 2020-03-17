@extends('frontend.master')
@section('title','Room Details')
@section('content')
    <!-- agent details begin-->
    @include('frontend.partials.breadcrumb',['title'=>'Room Details','item'=>['Room Details'=>null]])
    <!--Room Details Area-->
    <section class="room-details-area section-padding pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="room-gallery wow fadeInUp" data-wow-delay="0.3s">
                        <div class="slider-wrapper">
                            <div class="slider-for">
                                @foreach($room_type->roomTypeImage as $roomTypeImage)
                                <div class="slider-for__item ex1" data-src="{{asset('assets/backend/image/room_type_image/'.$roomTypeImage->image)}}">
                                    <img src="{{asset('assets/backend/image/room_type_image/'.$roomTypeImage->image)}}" alt="" />
                                </div>
                                @endforeach
                            </div>

                            <div class="slider-nav">
                                @foreach($room_type->roomTypeImage as $roomTypeImage)
                                <div class="slider-nav__item">
                                    <img src="{{asset('assets/backend/image/room_type_image_th/'.$roomTypeImage->image)}}" alt=""/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="room-details-content wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="cl-black"><a href="" class="cl-black">{{$room_type->title}}</a></h2>
                       {{ $room_type->description }}
                        <div class="row mb-40">
                            @foreach($room_type->amenity->chunk(ceil($room_type->amenity->count()/3)) as $chunk_item)
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-40">
                                <ul>
                                    @foreach($chunk_item as $amenity)
                                    <li><i class="fa fa-check"></i>{{$amenity->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="room-reviews">
                                    <div class="blog-comments">
                                        <div class="fb-comments"  data-width="100%"
                                             data-href="{{url()->current()}}"
                                             data-numposts="5"></div>
                                        <div id="fb-root"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="page-sidebar">
                        <div class="bg-base price-tag pb-2 pt-3">
                           <h3>Price</h3>
                        </div>
                        <div class="border-base bg-light price-tag  mb-2">
                            <h4>{{general_setting()->cur_sym}}{{number_format($room_type->base_price,2)}}<span>/Night</span></h4>
                        </div>
                        <div class="bg-base price-tag pb-2 pt-3">
                            <h3 class="mb-2">Booking</h3>
                        </div>
                        <div class="border-base booking-form  bg-light">

                            <form action="{{route('booking',$room_type->id)}}" method="post" id="booking_form">@csrf
                                <input type="text" name="name" placeholder="Name*" value="{{old('name')}}" required >
                                <input type="email" name="email" placeholder="Email*" value="{{old('email')}}" required >
                                <input type="text" name="phone" placeholder="Phone number*" value="{{old('phone')}}" required >
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Adult* <span class="text-info">( {{$room_type->higher_capacity}}/room )</span></small> </label>
                                        <input type="number" class="" name="adult" id="adult" value="{{old('adult',request()->adults?request()->adults:1)}}" required placeholder="Adult">
                                    </div>
                                    <div class="col-6">
                                        <label><small>Children <span class="text-info"> ( {{$room_type->kids_capacity}}/room)</span></small> </label>
                                        <input type="number" class="" name="children" id="children" value="{{old('children',request()->children?request()->children:1)}}" required placeholder="Children">
                                    </div>
                                    <div class="col-6">
                                        <label><small>Arrival Date*</small></label>
                                        <input type="text" name="arrival" id="arrival" value="{{$search['arrival']}}" placeholder="Arrival Date*" autocomplete="off">
                                    </div>
                                    <div class="col-6">
                                        <label><small>Departure Date*</small></label>
                                        <input type="text" name="departure" id="departure" value="{{$search['departure']}}" placeholder="Departure Date*" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row mb-4">

                                    <div class="form-group col-md-6">
                                        <div class="row border-base ml-1 mr-1">
                                            <div class="col-md bg-base text-white  text-center ">Rooms</div>
                                            <div class="col-md bg-white text-center "><span id="room_text">1</span></div>
                                        </div>

                                        <input type="hidden" name="rooms" value="1" id="room_input">
                                        <input type="hidden" name="available" value="0" id="available">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="row border-base ml-1 mr-1">
                                            <div class="col-md bg-base text-white  text-center ">Night</div>
                                            <div class="col-md text-center"><span id="night_text">1</span></div>
                                        </div>
                                        <input type="hidden" name="night" value="1" id="night_input">
                                    </div>
                                </div>
                                <button class="bttn btn-fill btn-block mt-2" id="booking-btn" type="submit" >Booking</button>
                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section><!--/Listing Details Area-->

    <!--Similar Rooms-->
    <section class="similar-rooms">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="cl-black mb-30">More Rooms</h2>
                </div>
            </div>
            <div class="row">
                @foreach($reletade_rooms as $room_type_v)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 wow fadeInUp " data-wow-delay="0.4s">
                        <div class="single-room-block ">
                            <img src="{{asset('assets/backend/image/room_type_image_th/'.optional($room_type_v->featuredImage())->image)}}" alt="">
                            <h3><a href="{{route('room_details',$room_type_v->id)}}">{{$room_type_v->title}}</a></h3>
                            <p>{{ str_limit($room_type_v->description,100) }}</p>
                            <div class="rooms-book-price">
                                <a class="small-btn" href="{{route('room_details',$room_type_v->id)}}">Book Now <i class="ti-arrow-right"></i></a>
                                <span>{{general_setting()->cur_sym}}{{$room_type_v->base_price}} <i>/Night</i></span>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section><!--/Similar Rooms-->


@endsection
@section('script')
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId={{web_setting()->general_general_section_fb_comment_script}}&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        var number_of_room,total_night,available;
        // Date Picker
        $( function() {
             number_of_room = 1;
             total_night = 1;
             available = 0;
            function setData(){
                $('#room_text').text(number_of_room);
                $('#room_input').val(number_of_room);
                $('#night_text').text(total_night);
                $('#night_input').val(total_night);
                $('#available').val(available);
                if(available){
                    $('#booking-btn').removeClass('d-none');
                }else{
                    $('#booking-btn').addClass('d-none');
                }
            }

            /* global setting */
            var datepickersOpt = {
                dateFormat: 'yy/mm/dd',
                minDate   : 0
            };

            $("#arrival").datepicker($.extend({
                onSelect: function() {
                    var minDate = $(this).datepicker('getDate');
                    minDate.setDate(minDate.getDate()+1);
                    $("#departure").datepicker( "option", "minDate", minDate);
                    checkAvailable();
                }
            },datepickersOpt));

            $("#departure").datepicker($.extend({
                onSelect: function() {
                    var maxDate = $(this).datepicker('getDate');
                    maxDate.setDate(maxDate.getDate()-1);
                    $("#arrival").datepicker( "option", "maxDate", maxDate);
                    checkAvailable();
                }
            },datepickersOpt));
            $(document).on('keyup','#adult,#children',function () {
                checkAvailable();
                setData();
            });
           function checkAvailable() {
               var data ={
                   arrival:$("#arrival").datepicker('getDate'),
                   departure:$("#departure").datepicker('getDate'),
                   adult:$("#adult").val(),
                   children:$("#children").val()
               };
               $('#message_div').addClass('d-none');
               if(data.arrival !== null && data.departure !== null){
                   $.ajax({
                       url:'{{route('check_available_room',$room_type->id)}}',
                       method:'get',
                       global: false,
                       async:false,
                       data:{
                           arrival:moment(data.arrival,"YYYY-MM-DD").format("YYYY-MM-DD"),
                           departure:moment(data.departure,"YYYY-MM-DD").format("YYYY-MM-DD"),
                           adult:data.adult,
                           children:data.children
                       },
                       success:function (res) {
                            number_of_room = res.data.number_of_room;
                            total_night = res.data.total_night;
                            available = res.data.available;
                           setData();
                       }
                   })
               }

           }
        });
    </script>
@endsection
