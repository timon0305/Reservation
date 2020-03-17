
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
                    <form action="{{route('admin.web_setting.section.store',['home','room-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{web_setting()->home_room_section_title}}">
                        </div>
                        <div class="form-group">
                            <label for="short_details">Sub Title</label>
                            <input  class="form-control form-control-lg" id="title_sub" name="title_sub" value="{{web_setting()->home_room_section_title_sub}}">
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