
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
                    <form action="{{route('admin.web_setting.section.store',['home','banner-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title_1">Title 1</label>
                            <input type="text" class="form-control form-control-lg" id="title_1" name="title_1" value="{{web_setting()->home_banner_section_title_1}}">
                        </div>
                        <div class="form-group">
                            <label for="title_2">Title 2</label>
                            <input type="text" class="form-control form-control-lg" id="title_2" name="title_2" value="{{web_setting()->home_banner_section_title_2}}">
                        </div>
                        <div class="form-group">
                            <label for="title_3">Title 3</label>
                            <input type="text" class="form-control form-control-lg" id="title_3" name="title_3" value="{{web_setting()->home_banner_section_title_3}}">
                        </div>

                        <div class="form-group">
                            <label for="sub_title">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/banner_image.jpg')}}" style="height: 100px">
                            </div>
                            <label for="banner_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(jpg)</small></label>
                            <input type="file"  id="banner_image" name="banner_image[jpg]" class="d-none">
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