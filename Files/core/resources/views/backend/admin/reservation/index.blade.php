@extends('backend.master')
@section('title',"Reservation")
@section('content')
        <div class="card">
            <div class="card-header bg-white float-right">
                <h2>Reservation

                    <a class="btn btn-tsk float-md-right" href="{{route('backend.admin.reservation.create')}}"><i class="fa fa-plus"></i> Add Reservation</a>
                    <div class="btn-group float-md-right mr-2">
                        <a class="btn btn-outline-secondary {{active_menu([route('backend.admin.reservation')],'active')}}" href="{{route('backend.admin.reservation')}}">All</a>
                        <a class="btn btn-outline-secondary {{active_menu([route('backend.admin.reservation','online')],'active')}}" href="{{route('backend.admin.reservation','online')}}">Online</a>
                        <a class="btn btn-outline-secondary {{active_menu([route('backend.admin.reservation','offline')],'active')}}" href="{{route('backend.admin.reservation','offline')}}">Offline</a>
                    </div>
                </h2>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>

                        <th>Reservation Number</th>
                        <th>Reservation Date</th>
                        <th>Guest</th>
                        <th>Room Type</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Booking Type</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Reservation Status</th>
                        <th class="text-right" style="width: 50px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $key=>$reservation)
                    <tr>

                        <td>{{$reservation->uid}}</td>
                        <td>{{$reservation->date}}</td>
                        <td><a href="{{route('backend.admin.guests.view',$reservation->guest->id)}}">{{$reservation->guest->username}}</a></td>
                        <td>{{$reservation->roomType->title}}</td>
                        <td>{{$reservation->check_in}}</td>
                        <td>{{$reservation->check_out}}</td>
                        <td>{{$reservation->online?'Online':'Offline'}}</td>
                        <td class="text-center"><span class="badge badge-{{$reservation->paymentStatus()['color']}}">{{$reservation->paymentStatus()['status']}}</span></td>
                        <td class="text-center"><span class="badge badge-{{$reservation->statusClass()}}">{{$reservation->status === 'ONLINE_PENDING'?'PENDING':$reservation->status}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.reservation.view',$reservation->id)}}" class="btn btn-tsk"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </td>
                    </tr>
                        @empty

                        <tr>
                            <td colspan="10">No Reservation</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="text-center ml-2">
                    {{$reservations->links()}}
                </div>
            </div>
        </div>

@endsection