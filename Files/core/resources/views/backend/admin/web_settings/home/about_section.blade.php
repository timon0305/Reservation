
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
                    <form action="{{route('admin.web_setting.section.store',['home','about-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{web_setting()->home_about_section_title}}">
                        </div>
                        <div class="form-group">
                            <label for="short_details">Short Details</label>
                            <textarea  class="form-control form-control-lg" id="short_details" name="short_details" >{{web_setting()->home_about_section_short_details}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="long_details">Long Details</label>
                            <textarea  class="form-control form-control-lg" rows="8" id="long_details" name="long_details" >{{web_setting()->home_about_section_long_details}}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="about_image">Image <small class="text-info">(.jpg)</small></label>
                                    <div class="img-responsive">
                                        <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/about_image.jpg')}}" style="height: 100px">
                                    </div>
                                    <label for="about_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(jpg)</small></label>
                                    <input type="file"  id="about_image" name="about_image[jpg]" class="d-none">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sign_image">Sign image <small class="text-info">(.png)</small></label>
                                    <div class="img-responsive">
                                        <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/sign_image.png')}}" style="height: 100px">
                                    </div>
                                    <label for="sign_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                                    <input type="file"  id="sign_image" name="sign_image[png]" class="d-none">
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
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5>{{strtoupper(str_replace('-',' ',$section))}} ITEM
            </h5>
        </div>
        <div class="card-header bg-white">
            <form action="{{route('admin.web_setting.section.store',['home','team-section'])}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="title_1">Title 1</label>
                        <input type="text" class="form-control" id="title_1" name="title_1" value="{{web_setting()->home_team_section_title_1}}">
                    </div>
                    <div class="form-group col-md">
                        <label for="title_2">Title 2</label>
                        <input type="text" class="form-control" id="title_2" name="title_2" value="{{web_setting()->home_team_section_title_2}}">
                    </div>
                    <div class="form-group col-md">
                        <br/>
                        <button type="submit" class="btn btn-tsk btn-block mt-1"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <a href="#" class="btn btn-sm btn-tsk btn-square float-right mb-2" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add New Team</a>

                  <div class="table-responsive">
                      <table class="table table-sm table-striped mb-0">
                          <thead>
                          <tr>
                              <th width="30px">SL</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Title</th>
                              <th class="text-right">ACTION</th>
                          </tr>
                          </thead>
                          <tbody>
                          @forelse(\App\Model\WebSetting\WebOurTeam::all() as $key=>$value)
                              <div class="modal fade" id="update_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small> Edit</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <div class="row justify-content-center">
                                                  <div class="col-md-12">
                                                      <form action="{{route('admin.web_setting.home.team.update',$value->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                          <div class="form-group">
                                                              <label for="name">Name </label>
                                                              <input type="text" class="form-control" id="name" name="name" value="{{$value->name}}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="title">Title </label>
                                                              <input type="text" class="form-control" id="title" name="title" value="{{$value->title}}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="image">Image <small class="text-info">( .jpg,.png )</small></label>
                                                              <input type="file" class="form-control" id="image" name="image" >
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Social Link</label>
                                                              <div class="input-group mt-2">
                                                                  <div class="input-group-prepend pr-2" style="width: 100px">
                                                                      Facebook
                                                                  </div>
                                                                  <input type="text" class="form-control form-control-sm" id="fb" name="fb" value="{{$value->fb}}">
                                                              </div>
                                                              <div class="input-group mt-2">
                                                                  <div class="input-group-prepend pr-2"  style="width: 100px">
                                                                      Twitter
                                                                  </div>
                                                                  <input type="text" class="form-control form-control-sm" id="tw" name="tw" value="{{$value->tw}}">
                                                              </div>
                                                              <div class="input-group mt-2">
                                                                  <div class="input-group-prepend pr-2"  style="width: 100px">
                                                                      Linkedin
                                                                  </div>
                                                                  <input type="text" class="form-control form-control-sm" id="lin" name="lin" value="{{$value->lin}}">
                                                              </div>
                                                              <div class="input-group mt-2">
                                                                  <div class="input-group-prepend pr-2"  style="width: 100px">
                                                                      Google +
                                                                  </div>
                                                                  <input type="text" class="form-control form-control-sm" id="gp" name="gp" value="{{$value->gp}}">
                                                              </div>
                                                          </div>
                                                          <div class="form-group">
                                                              <hr/>
                                                              <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                                              <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Update</button>
                                                          </div>

                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <tr>
                                  <td >{{$key+1}}</td>
                                  <td ><img src="{{asset('assets/frontend/img/home/team_section/'.$value->image)}}" style="height: 80px"></td>
                                  <td >{{$value->name}}</td>
                                  <td >{{$value->title}}</td>

                                  <td class="text-right">
                                      <div class="">
                                          <a class="btn btn-sm btn-icon btn-tsk" data-toggle="modal" data-target="#update_{{$value->id}}"><i class="fa fa-edit"></i> edit</a>
                                          <a href="#" class="btn btn-sm btn-danger" onclick="confirm('Are you sure delete this data')?$('#delete_form_{{$value->id}}').submit():false"><i class="fa fa-trash"></i> Delete</a>
                                      </div>
                                      <form action="{{route('admin.web_setting.home.team.delete',$value->id)}}" id="delete_form_{{$value->id}}" method="post">@csrf</form>

                                  </td>
                              </tr>
                          @empty
                              <tr>
                                  <td class="text-danger text-center" colspan="6">No result </td>
                              </tr>
                          @endforelse
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small> Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form action="{{route('admin.web_setting.home.team.store')}}" method="post" enctype="multipart/form-data">@csrf

                                <div class="form-group">
                                    <label for="name">Name </label>
                                    <input type="text" class="form-control" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="title">Title </label>
                                    <input type="text" class="form-control" id="title" name="title" >
                                </div>
                                <div class="form-group">
                                    <label for="image">Image <small class="text-info">( .jpg,.png )</small></label>
                                    <input type="file" class="form-control" id="image" name="image" >
                                </div>
                                <div class="form-group">
                                    <label>Social Link</label>
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend pr-2" style="width: 100px">
                                            Facebook
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="fb" name="fb">
                                    </div>
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend pr-2"  style="width: 100px">
                                            Twitter
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="tw" name="tw" >
                                    </div>
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend pr-2"  style="width: 100px">
                                            Linkedin
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="lin" name="lin">
                                    </div>
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend pr-2"  style="width: 100px">
                                            Google +
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="gp" name="gp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <hr/>
                                    <button type="submit" class="btn btn-tsk btn-block mt-4"><i class="fa fa-save"></i> Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection