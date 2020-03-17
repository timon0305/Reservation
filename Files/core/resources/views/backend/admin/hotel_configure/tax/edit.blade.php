@extends('backend.master')
@section('title',"Edit Tax")
@section('content')

    <div class="card">
        <div class="card-header bg-white">
            <h2>Edit Tax
                <a class="btn btn-tsk float-right" href="{{route('backend.admin.tax')}}"><i class="fa fa-list"></i> Tax List</a>

            </h2>
        </div>
        <div class="card-body">
            <form action="{{route('backend.admin.tax.update',$tax->id)}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{$tax->name}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Code</strong> <small class="text-danger">*</small></label> 
                        <input type="text" class="form-control form-control-lg" name="code" placeholder="Code" value="{{$tax->code}}" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Type</strong> <small class="text-danger">*</small></label>
                        <select type="text" class="form-control form-control-lg" name="type" required>
                            <option value="PERCENTAGE" {{$tax->type === 'PERCENTAGE'?'selected':''}}>Percentage</option>
                            <option value="FIXED" {{$tax->type === 'PERCENTAGE'?'selected':''}}>Fixed</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Rate</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="rate" placeholder="0.00" value="{{$tax->rate}}" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" {{$tax->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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