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
                            <label for="fb_comment_script">Facebook Comment Script id</label>
                            <input  class="form-control" rows="12" id="fb_comment_script" name="fb_comment_script" value="{{web_setting()->general_general_section_fb_comment_script}}">
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