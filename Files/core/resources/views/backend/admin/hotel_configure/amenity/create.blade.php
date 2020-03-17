@extends('backend.master')
@section('title',"Create Amenities")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Create Amenities
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.amenities')}}"><i class="fa fa-list"></i> Amenities List</a>

                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('backend.admin.amenities.store')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="name" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Description</strong><small> (optional)</small> </label>
                        <textarea  class="form-control form-control-lg" rows="4" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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