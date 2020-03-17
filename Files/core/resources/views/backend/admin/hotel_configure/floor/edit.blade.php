@extends('backend.master')
@section('title',"Edit Floor")
@section('content')

    <div class="card">
        <div class="card-header bg-white">
            <h2>Edit Floor
                <a class="btn btn-tsk float-right" href="{{route('backend.admin.floor')}}"><i class="fa fa-list"></i> Floor List</a>

            </h2>
        </div>
        <div class="card-body">
            <form action="{{route('backend.admin.floor.update',$floor->id)}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{$floor->name}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Number</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="number" placeholder="Number" value="{{$floor->number}}" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Description</strong><small> (optional)</small> </label>
                        <textarea  class="form-control form-control-lg" rows="4" name="description" placeholder="Description">{{$floor->description}}</textarea>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" {{$floor->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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