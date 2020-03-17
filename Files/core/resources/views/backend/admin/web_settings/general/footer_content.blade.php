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
                            <label for="footer_content">Footer Content</label>
                            <textarea  class="form-control" rows="4" id="footer_content" name="footer_content" >{{web_setting()->general_general_section_footer_content}}</textarea>
                        </div>

                        <div class="form-group">
                            <hr/>
                            <button type="submit" class="btn btn-tsk btn-block btn-lg mt-4"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection