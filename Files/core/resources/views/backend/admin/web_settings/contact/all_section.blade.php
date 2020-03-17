
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
                    <form action="{{route('admin.web_setting.section.store',['contact','all-section'])}}" method="post">@csrf
                        <div class="form-group">
                            <label for="title_1">Title 1</label>
                            <input type="text" class="form-control form-control-lg" id="title_1" name="title_1" value="{{web_setting()->contact_all_section_title_1}}">
                        </div>
                        <div class="form-group">
                            <label for="title_2">Title 2</label>
                            <input type="text" class="form-control form-control-lg" id="title_2" name="title_2" value="{{web_setting()->contact_all_section_title_2}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone <small>(+01000000000,+01000000000)</small></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{web_setting()->contact_all_section_phone}}">
                        </div>
                        <div class="form-group">
                            <label for="email_web">Email And Web <small>(support@or&or.com,yourewebsite.com)</small></label>
                            <input type="text" class="form-control" id="email_web" name="email_web" value="{{web_setting()->contact_all_section_email_web}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea type="text" class="form-control" id="address" name="address" >{{web_setting()->contact_all_section_address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="map">Map Script</label>
                            <input class="form-control form-control-lg" id="map" name="map" value="{{web_setting()->contact_all_section_map}}">
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