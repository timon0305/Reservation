@extends('backend.master')
@section('title',"Edit Room")
@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <h2>Edit Room
                <a class="btn btn-tsk float-right" href="{{route('backend.admin.room')}}"><i class="fa fa-list"></i> Room List</a>

            </h2>
        </div>
        <div class="card-body">
            <form action="{{route('backend.admin.room.update',$room->id)}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">

                    <div class="form-group col-md">
                        <label><strong>Number</strong> <small class="text-danger">*</small></label>
                        <input type="number" class="form-control form-control-lg" name="number" placeholder="Number" value="{{$room->number}}" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Floor</strong> </label>
                        <span class="form-control form-control-lg">
                            {{$room->floor->name}}
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Room Type</strong> <small class="text-danger">*</small></label>
                        <select class="form-control form-control-lg" name="room_type" required>
                            <option value="">Select</option>
                            @foreach($room_types as $room_type)
                                <option value="{{$room_type->id}}" {{$room->room_type_id === $room_type->id?'selected':''}}>{{$room_type->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" {{$room->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <hr/>
                        <button type="submit" class="btn btn-lg mt-4 btn-tsk btn-block"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection