@extends('frontend.master')
@section('title','Checkout')
@section('content')
    <!-- error begin-->
    @include('frontend.partials.breadcrumb',['title'=>'checkout','item'=>['checkout'=>null]])
    <!--Room Details Area-->
    <section class="room-details-area section-padding pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="page-sidebar">
                        <div class="single-sidebar-block price-tag">
                            <h3>Guest Details</h3>
                            <div>
                                <strong>{{$reservation_data['name']}}</strong><br>
                                Phone: {{$reservation_data['phone']}}<br/>
                                Email: {{$reservation_data['email']}}
                            </div>
                        </div>
                        <div class="single-sidebar-block booking-form">
                            <h3>Booking Details</h3>
                            <dl class="row">
                                <dt class=" col-md">Room Type</dt>
                                <dd class="col-md">{{$room_type->title}}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Arrival Date</dt>
                                <dd class="col-md">{{$reservation_data['arrival']}}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Departure Date</dt>
                                <dd class="col-md">{{$reservation_data['departure']}}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Nights</dt>
                                <dd class="col-md">{{$reservation_data['night_list']['total_night']}} Night</dd>
                            </dl>

                            <dl class="row">
                                <dt class="col-md">Adults</dt>
                                <dd class="col-md">{{$reservation_data['adult']}} Person</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Kids</dt>
                                <dd class="col-md">{{$reservation_data['children']}} Person</dd>
                            </dl>

                        </div>
                        <div class="single-sidebar-block price-tag">
                            @if(null !== $reservation_data['coupon'])
                                <h3>Apply Coupon details</h3>
                                <p class="text-info">Your applied code <b>" {{$reservation_data['coupon']->code}} "</b></p>
                                @else
                                <h3>Apply Coupon</h3>
                                <form action="{{route('apply-coupon')}}" method="post">@csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="code" placeholder="Code" class="form-control">
                                            <div class="input-group-append">
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-fill" >Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif



                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="single-sidebar-block booking-form">
                        <h3>Payment Details</h3>
                        <div class="">
                            <p ><span class="badge bg-light">Night list</span></p>
                            <div class="table-responsive">
                                <table class="w-100">
                                    <thead class="bg-light">
                                    <tr >
                                        <th>#</th>
                                        <th>Date</th>
                                        <th class="text-center">Room</th>
                                        <th class="text-right"><b>Price</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reservation_data['night_list']['night_list'] as $key=>$night)
                                        <tr>
                                            <td>{{$key+1}}.</td>
                                            <td>{{$night['date']}}<br/>
                                                @if($room_type->base_price != $night['price'])
                                                    <small class="text-info"> <span class="base-price" >{{general_setting()->cur_sym}} {{number_format($room_type->base_price,2)}}</span> <span>
                                                        @if($night['price'] > $room_type->base_price)
                                                                +    {{general_setting()->cur_sym}}{{number_format($night['price'] - $room_type->base_price,2)}}
                                                            @else
                                                                -    {{general_setting()->cur_sym}}{{ number_format($room_type->base_price -$night['price'],2) }}
                                                            @endif


                                                    </span> </small>
                                                @else
                                                    <small class="text-info"> <span class="base-price" >{{general_setting()->cur_sym}} {{number_format($room_type->base_price,2)}}</span></small>
                                                @endif
                                            </td>
                                            <td class="text-center">{{$reservation_data['rooms_per_night']}}</td>
                                            <td align="right">{{general_setting()->cur_sym}}{{number_format($night['sub_total'],2)}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr class="border-top">
                                        <td colspan="3"><b>Total Night Price</b></td>
                                        <td align="right"> <b> {{general_setting()->cur_sym}}{{number_format($reservation_data['night_list']['total_price'],2)}}</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="w-100 table-sm">
                                    <tr>
                                        <td><b>Discount</b> <small class="text-info">
                                                @if(null !== $reservation_data['coupon'])
                                                    @if($reservation_data['coupon']->type === 'PERCENTAGE')
                                                        (  {{$reservation_data['coupon']->value}} % )
                                                        @else
                                                        {{general_setting()->cur_sym}}{{number_format($reservation_data['coupon']->value,2)}}
                                                        @endif

                                                    @else
                                                     (  0 % )
                                                    @endif

                                            </small></td>
                                        <td class="text-right"><b>

                                                -  {{general_setting()->cur_sym}}
                                                @if(null !== $reservation_data['coupon'])
                                                {{number_format($reservation_data['coupon']->cal_price,2)}}
                                            @else
                                                    {{number_format(0,2)}}
                                                @endif
                                            </b></td>
                                    </tr>
                                    <tr class="border-top">
                                        <td><b>Subtotal</b></td>
                                        <td class="text-right"><b>{{general_setting()->cur_sym}}{{number_format($reservation_data['sub_total'],2)}}</b></td>
                                    </tr>
                                </table>
                            </div>
                            @if(null !== $reservation_data['tax_list'])
                                <p ><span class="badge bg-light">Taxes</span></p>
                                <div class="table-responsive">
                                    <table class="w-100 table-sm">
                                        @foreach($reservation_data['tax_list'] as $key=>$tax)
                                            <tr>
                                                <td >{{$key+1}}.</td>
                                                <td>{{$tax->name}} <small class="text-info">({{$tax->rate}} {{$tax->type === 'PERCENTAGE'?'%':general_setting()->cur}})</small></td>
                                                <td class="text-right">{{general_setting()->cur_sym}}{{number_format($tax->cal_price,2)}}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="border-top">
                                            <td colspan="2" align=""><b>Total Tax</b></td>
                                            <td class="text-right"><b>{{general_setting()->cur_sym}}{{number_format($reservation_data['tax_list']->sum('cal_price'),2)}}</b></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="w-100 table-sm">
                                    <tr>
                                        <td><b>Payable Amount</b></td>
                                        <td class="text-right"><b>{{general_setting()->cur_sym}}{{number_format($reservation_data['payable_amount'],2)}}</b></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right ">
                                    <a class="bttn btn-fill mt-4" href="{{route('confirm-checkout')}}">Confirm Checkout  > > ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Listing Details Area-->

@endsection

