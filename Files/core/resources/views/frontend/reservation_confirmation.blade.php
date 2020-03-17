@extends('frontend.master')
@section('title','Booking Complete')
@section('content')
    <!-- error begin-->
    @include('frontend.partials.breadcrumb',['title'=>'Booking Complete','item'=>['Booking Complete'=>null]])
    <!--Room Details Area-->
    <section class="room-details-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4 d-print-none">
                    <h1 class="text-success text-center">Congratulations your booking request complete.</h1>
                </div>
                <div class="col-lg-12 col-md-12 wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="page-sidebar">
                        <div class="single-sidebar-block booking-form">
                            <h3>Your Booking Details <div class="btn btn-fill float-right" onclick="Javascript:window.print()"><i class="fa fa-print"></i> </div> </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Booking No</th>
                                        <td class="text-right">{{$reservation->uid}}</td>
                                    </tr>
                                    <tr>
                                        <th>Room Type</th>
                                        <td class="text-right">{{$reservation->roomType->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Arrival Date</th>
                                        <td class="text-right">{{$reservation->check_in}}</td>
                                    </tr>
                                    <tr>
                                        <th>Departure Date</th>
                                        <td class="text-right">{{$reservation->check_out}}</td>
                                    </tr>
                                    <tr>
                                        <th>Nights</th>
                                        <td class="text-right">{{$reservation->night->count()}} Night</td>
                                    </tr>
                                    <tr>
                                        <th>Adults</th>
                                        <td class="text-right">{{$reservation->adults}} Person</td>
                                    </tr>
                                    <tr>
                                        <th>Kids</th>
                                        <td class="text-right">{{$reservation->kids}} Person</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status</th>
                                        <td class="text-right"><span class="badge badge-success">Success</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!--/Listing Details Area-->

@endsection

