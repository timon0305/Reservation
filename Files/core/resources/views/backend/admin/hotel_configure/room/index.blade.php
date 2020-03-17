@extends('backend.master')
@section('title',"Room")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Create Room
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.room.create')}}"><i class="fa fa-plus"></i> Add Room</a>

                </h2>
            </div>
            <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th width="150px">Room Number</th>
                        <th>Room Type</th>
                        <th>Floor Number</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $key=>$room)
                        <tr>
                            <td class="text-center">{{$room->number}}</td>
                           <td>{{$room->type->title}}</td>
                            <td>{{$room->floor->number}}</td>
                            <td><span class="badge {{$room->status?'badge-success':'badge-danger'}}">{{$room->status?'Active':'Inactive'}}</span></td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('backend.admin.room.edit',$room->id)}}" class="btn btn-tsk"><i class="fa fa-pencil"></i> edit</a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            </div>
            <div class="pagination-center">
                {{ $rooms->links() }}
            </div>
        </div>

@endsection