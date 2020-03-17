@extends('backend.master')
@section('title',"Amenities")
@section('content')
    <div class="page-title mb-4">
        <h2>Amenities</h2>
    </div>
      <div class="row">
          <div class="col-md-12">
              <a class="btn btn-outline-tsk btn-sm mb-2" href="{{route('backend.admin.amenities')}}"><i class="fa fa-list"></i> Amenities List</a>
          </div>
      </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('backend.admin.amenities.update',$amenity->id)}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="name" placeholder="name" value="{{$amenity->name}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Image</strong> <small>( Eg; png)</small></label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Description</strong><small> (optional)</small> </label>
                        <textarea  class="form-control" rows="4" name="description" placeholder="Description">{{$amenity->description}}</textarea>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-6">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" {{$amenity->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-6">
                        <hr/>
                        <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

@endsection