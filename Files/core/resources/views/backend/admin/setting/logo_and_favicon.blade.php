@extends('backend.master')
@section('title',"Logo And Favicon Setting")
@section('content')

    <div class="card mb-4">
        <div class="card-header bg-white">
            <h2>Logo And Favicon</h2>
        </div>
        <div class="card-body">
            <form role="form" method="post" action="{{route('backend.admin.logo_and_fav_setting.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class=""><strong>SITE LOGO</strong></label>
                        <div class="form-control input-lg">
                            <input type="file"  name="logo">
                            <img src="{{general_setting()->logo}}"  style="width: 50px">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label class=""><strong>SITE FAVICON</strong></label>
                        <div class="form-control input-lg">
                            <input type="file" name="favicon">
                            <img src="{{general_setting()->favicon}}" style="width: 30px" >
                        </div>

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 ">
                        <button class="btn btn-tsk btn-block" >Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
