@extends('frontend.master')
@section('title','Room List')
@section('content')
    <!-- agent details begin-->

    @include('frontend.partials.breadcrumb',['title'=>'Room List','item'=>['Room List'=>null]])


    <!--Rooms and Suites Area-->
    <section class="rooms-suites-area mt-4">
        <div class="container">
            <div class="row hero-search-breadcrumb mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hero-filter-search wow fadeInUp" data-wow-delay="0.6s">
                      @include('frontend.partials.search')
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="rooms-suites-area pt-4">
        <div class="container">
            <div class="row">
                @forelse($room_types as $room_type)
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="single-room-block">

                        <img src="{{asset('assets/backend/image/room_type_image_th/'.optional($room_type->featuredImage())->image)}}" alt="">
                        <h3><a href="{{route('room_details',$room_type->id)}}">{{$room_type->title}}</a></h3>
                        <p>{{ str_limit($room_type->description,100) }}</p>
                        <div class="rooms-book-price">
                            <a class="small-btn" href="{{route('room_details',$room_type->id).'?arrival='.$search['arrival'].'&departure='.$search['departure'].'&adults='.$search['adults'].'&children='.$search['children']}}">Book Now <i class="ti-arrow-right"></i></a>
                            <span>{{general_setting()->cur_sym}}{{$room_type->base_price}} <i>/Night</i></span>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-lg-12 wow fadeInUp border p-md-5" data-wow-delay="0.4s">
                        <h1 class="text-warning text-center">No Room!</h1>
                    </div>
                @endforelse
                    @if ($room_types->lastPage() > 1)
                <div class="col-md-12 wow fadeInUp" data-wow-delay="1.5s">
                    <ul class="styled-pagination mt-30 centered">
                        <li class="next {{ ($room_types->currentPage() == 1) ? ' disabled' : '' }}" ><a href="{{($room_types->currentPage() == 1) ? '#' : $room_types->url(1)   }}"><span class="fa fa-angle-left"></span></a></li>
                        @for ($i = 1; $i <= $room_types->lastPage(); $i++)
                            <li>
                                <a class="{{ ($room_types->currentPage() == $i) ? ' active' : '' }}" href="{{ $room_types->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="prev {{ ($room_types->currentPage() == $room_types->lastPage()) ? ' disabled' : '' }}"><a href="{{($room_types->currentPage() == $room_types->lastPage())? '#' : $room_types->url($room_types->currentPage()+1)   }}"><span class="fa fa-angle-right"></span></a></li>
                    </ul>
                </div>
                    @endif

            </div>
        </div>
    </section><!--/Rooms and Suites Area-->

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
                    minDate.setDate(minDate.getDate()+1);
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