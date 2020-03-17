@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card mb-4">
        <div class="card-header bg-white ">
            <h2>{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>

        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['general','general-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sub_title">Login Background Image <small>(.jpg)</small></label>
                                    <div class="img-responsive">

                                        <img src="{{asset('assets/frontend/img/general/general_section/login_bg_image.jpg')}}" style="height: 100px">
                                    </div>
                                    <label for="login_bg_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(jpg)</small></label>
                                    <input type="file"  id="login_bg_image" name="login_bg_image[jpg]" class="d-none">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sub_title">Breadcrumb Image</label>
                                    <div class="img-responsive">
                                        <img src="{{asset('assets/frontend/img/general/general_section/breadcrumb_image.jpg')}}" style="height: 100px">
                                    </div>
                                    <label for="breadcrumb_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(jpg)</small></label>
                                    <input type="file"  id="breadcrumb_image" name="breadcrumb_image[jpg]" class="d-none">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <hr/>
                            <button type="submit" class="btn btn-tsk btn-lg mt-4 btn-block"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection