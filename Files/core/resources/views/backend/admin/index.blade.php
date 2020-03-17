@extends('backend.master')
@section('title',"Dashboard")

@section('style')
    <link rel="stylesheet" href="{{asset('assets/plugin/morris/morris.css')}}">
    <style>
        .btn-room{
            width: 100px;
        }
    </style>
    @endsection
@section('content')
    <h2 class="mb-4">DASHBOARD <small>STATISTICS</small></h2>
    <div class="row mb-4">
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-info text-light p-4">
                    <a href="{{route('backend.admin.guests')}}" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-user"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100" style="height: 113px">
                    <a href="{{route('backend.admin.guests')}}" class="text-uppercase text-secondary mb-0 "><small>Guest</small></a>
                    <h3  class="font-weight-bold mb-0">
                        <a href="{{route('backend.admin.guests')}}" class="text-muted">{{\App\Model\User::count()}}</a>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-success text-light p-4">
                    <a href="{{route('backend.admin.reservation','online')}}" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-globe"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100" style="height: 113px">
                    <a href="{{route('backend.admin.reservation','online')}}"  class="text-uppercase text-secondary mb-0 "><small>Online Reservation</small></a>
                    <h3 class="font-weight-bold mb-0">
                        <a href="{{route('backend.admin.reservation','online')}}" class="text-muted">{{\App\Model\Reservation::where('online',1)->count()}}</a>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-warning text-light p-4">
                    <a href="{{route('backend.admin.reservation','offline')}}" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-bandcamp"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100" style="height: 113px">
                    <a href="{{route('backend.admin.reservation','offline')}}"  class="text-uppercase text-secondary mb-0 "> <small>Offline Reservation</small></a>
                    <h3 class="font-weight-bold mb-0">
                        <a href="{{route('backend.admin.reservation','offline')}}" class="text-muted">{{\App\Model\Reservation::where('online',0)->count()}}</a>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-primary text-light p-4">
                    <a href="{{auth()->guard('admin')->user()->can_access('admin')?route('backend.admin.room'):'#0'}}" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-home"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100" style="height: 113px">
                    <a href="{{auth()->guard('admin')->user()->can_access('admin')?route('backend.admin.room'):'#0'}}" class="text-uppercase text-secondary mb-0 ">Rooms</a>
                    <h3 class="font-weight-bold mb-0">
                        <a href="{{auth()->guard('admin')->user()->can_access('admin')?route('backend.admin.room'):'#0'}}" class="text-muted">{{\App\Model\Room::count()}}</a>
                    </h3>
                </div>
            </div>
        </div>

    </div>
   <div class="row">
       <div class="col-md">
           <div class="card">
               <div class="card-header bg-white">
               <h4> Room Status

                   <div class="float-md-right">
                       <a href="#" class="btn btn-sm btn-square btn-room btn-success mr-1">Available</a>
                       <a href="#" class="btn btn-sm btn-square btn-room btn-danger mr-1">Booked</a>
                   </div>


               </h4>
               </div>
               <div class="card-body  table-responsive">
                   <div class="form-row mb-2">

                       <div class="col-md">
                           <a class="btn btn-tsk " href="{{route('backend.admin.reservation.create')}}"><i class="fa fa-plus"></i> Add Reservation</a>

                       </div>
                       <div class="col-md">
                           <form class="form-inline float-right">
                               <div class="form-group">
                                   <div class="input-group">
                                       <input name="date" type="text" id="date" value="{{$data['date']}}" class="form-control">
                                   </div>
                               </div>
                               <div class="form-group pl-2">
                                   <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>

                               </div>
                           </form>
                       </div>
                   </div>
                   <hr/>
                   <ul class="nav nav-tabs d-print-none mb-2" role="tablist">
                       <li class="nav-item ">
                           <a class="nav-link  active " href="#floor_view" role="tab" data-toggle="tab" aria-selected="true">Floor view</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#room_type" role="tab" data-toggle="tab">Type View</a>
                       </li>
                   </ul>

                   <div class="tab-content">
                       <div role="tabpanel" class="tab-pane active" id="floor_view">
                           <table class="table table-bordered mb-0">
                               <thead class="bg-tsk text-white">
                               <tr>
                                   <th style="width: 150px">Floor</th>
                                   <th>Room</th>
                               </tr>
                               </thead>
                               <tbody>
                               @foreach($data['floor_plan'] as $floor)
                                   <tr>
                                       <td class="align-content-center font-weight-bold">{{$floor->name}}</td>
                                       <td>
                                           @foreach($floor->room->sortBy ('number') as $room)
                                               @if($ability = $room->available($data['date']))
                                                   <a href="{{route('backend.admin.reservation.view',$ability->reservation_id)}}" class="btn btn-lg btn-square btn-room btn-danger mr-1 mt-1">{{$room->number}}</a>
                                               @else
                                                   <a href="#" class="btn btn-lg btn-square btn-room btn-success mr-1 mt-1">{{$room->number}}</a>
                                               @endif
                                           @endforeach
                                       </td>
                                   </tr>
                               @endforeach
                               </tbody>
                           </table>
                       </div>
                       <div role="tabpanel" class="tab-pane" id="room_type">
                           <table class="table table-bordered mb-0">
                               <thead class="bg-tsk text-white">
                               <tr>
                                   <th >Room Type</th>
                                   <th>Room</th>
                               </tr>
                               </thead>
                               <tbody>
                               @foreach($data['room_type'] as $room_type)
                                   <tr>
                                       <td class="align-content-center font-weight-bold">{{$room_type->title}}</td>
                                       <td>
                                           @forelse($room_type->room->sortBy ('number') as $room)
                                               @if($ability = $room->available($data['date']))
                                                   <a href="{{route('backend.admin.reservation.view',$ability->reservation_id)}}" class="btn btn-lg btn-square btn-room btn-danger mr-1 mt-1">{{$room->number}}</a>
                                               @else
                                                   <a href="#" class="btn btn-lg btn-square btn-room btn-success mr-1 mt-1">{{$room->number}}</a>
                                               @endif
                                           @empty
                                               N/A
                                           @endforelse
                                       </td>
                                   </tr>
                               @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>

               </div>
           </div>
       </div>
   </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Current Reservation</h4>
                </div>
                <div class="card-body p-0" style="overflow: auto;max-height: 300px">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Reservation Id</th>
                                <th>Check in</th>
                                <th>Check out</th>
                                <th>Guest</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data['current_reservation'] as $key=>$current_reservation)
                                <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="{{route('backend.admin.reservation.view',$current_reservation->id)}}">{{$current_reservation->uid}}</a></td>
                                    <td>{{$current_reservation->check_in}}</td>
                                    <td>{{$current_reservation->check_out}}</td>
                                <td>{{$current_reservation->guest->username}}</td>
                                <td>{{$current_reservation->guest->email}}</td>
                                <td>{{$current_reservation->guest->phone}}</td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="7">No Reservation</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Upcoming Reservation</h4>
                </div>
                <div class="card-body p-0" style="overflow: auto;max-height: 300px">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Reservation Id</th>
                                <th>Check in</th>
                                <th>Check out</th>
                                <th>Guest</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data['upcoming_reservation'] as $key=>$upcoming_reservation)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><a href="{{route('backend.admin.reservation.view',$upcoming_reservation->id)}}">{{$upcoming_reservation->uid}}</a></td>
                                    <td>{{$upcoming_reservation->check_in}}</td>
                                    <td>{{$upcoming_reservation->check_out}}</td>
                                    <td>{{$upcoming_reservation->guest->username}}</td>
                                    <td>{{$upcoming_reservation->guest->email}}</td>
                                    <td>{{$upcoming_reservation->guest->phone}}</td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="7">No Reservation</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header font-weight-bold bg-white">
                    <i class="fa fa-line-chart"></i>
                    MONTHLY RESERVATION
                </div>
                <div class="card-body p-0" id="reservation" style="height: 350px;">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/plugin/morris/raphael-min.js')}}"></script>
    <script src="{{asset('assets/plugin/morris/morris.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy/mm/dd',

            });
            var months = @php echo json_encode(array_values(month_arr())) ; @endphp;

            new Morris.Line({
                element: 'reservation',
                data: @php echo $total_chart ; @endphp,
                xkey: 'month',
                ykeys: ['online','offline'],
                labels: ['ONLINE','OFFLINE'],
                xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
                    var month = months[x.getMonth()];
                    return month;
                },
                dateFormat: function(x) {
                    var month = months[new Date(x).getMonth()];
                    return month;
                },
            });
        });
    </script>
@endsection