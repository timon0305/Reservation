@extends('backend.master')
@section('title',"Confirm")
@section('content')
        <div class="card">
            <div class="card-header bg-white float-right">
                <h2>Reservation Confirm
                </h2>
            </div>
            <div class="card-body table-responsive">
                <h4 class="mt-2 text-tsk">Assign Room</h4>
                <form action="{{route('backend.admin.reservation.confirm_post',$reservation->id)}}" method="post">@csrf
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th class="text-center">Room</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($night_data as $key=>$rooms)
                        <tr>
                            <td>{{$key}}</td>
                            <td class="text-center">
                            @foreach($rooms as $room)
                                <div class="d-inline" >
                                    <input data-toggle="toggle" data-on="{{$room->number}}" data-off="{{$room->number}}"  data-onstyle="success" data-offstyle="danger"  type="checkbox" value="{{$room->id}}" name="room[{{$key}}][]">
                                </div>
                                @endforeach
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-danger">No allocate room!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
               <button class="btn btn-tsk float-right" type="submit">Room Assign & Confirm Reservation</button>
                </form>
            </div>
        </div>

@endsection