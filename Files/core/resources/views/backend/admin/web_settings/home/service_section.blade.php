
@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h2> {{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>

        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['home','service-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{web_setting()->home_service_section_title}}">
                        </div>
                        <div class="form-group">
                            <label for="sub_title">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="sub_title" name="sub_title" value="{{web_setting()->home_service_section_sub_title}}">
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bg_image">Bg Image <small class="text-info">(.jpg)</small></label>
                                    <div class="img-responsive">
                                        <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/bg_image.jpg')}}" style="height: 100px">
                                    </div>
                                    <label for="bg_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(jpg)</small></label>
                                    <input type="file"  id="bg_image" name="bg_image[jpg]" class="d-none">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <hr/>
                            <button type="submit" class="btn btn-tsk btn-block"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection