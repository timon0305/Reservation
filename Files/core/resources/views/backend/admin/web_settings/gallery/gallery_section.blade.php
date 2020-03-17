
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
                    <form action="{{route('admin.web_setting.section.store',['gallery','gallery-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title_1">Title 1</label>
                            <input type="text" class="form-control form-control-lg" id="title_1" name="title_1" value="{{web_setting()->gallery_gallery_section_title_1}}">
                        </div>
                        <div class="form-group">
                            <label for="title_2">Title 2</label>
                            <input type="text" class="form-control form-control-lg" id="title_2" name="title_2" value="{{web_setting()->gallery_gallery_section_title_2}}">
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
            <h5>{{ucfirst(str_replace('-',' ',$page))}} Item <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small>
                <a href="#" class="btn btn-sm btn-tsk btn-square float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add New</a>
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-sm table-striped mb-0">
                        <thead class="bg-tsk text-white">
                        <tr>
                            <th width="30px">SL</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Link</th>
                            <th class="text-right">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(\App\Model\WebSetting\WebGallery::all() as $key=>$value)
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
                                                    <form action="{{route('admin.web_setting.gallery.gallery-section.update',$value->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                        <div class="form-group">
                                                            <label for="image">Image </label>
                                                            <input type="file" class="form-control" id="image" name="image">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Category </label>
                                                            <select class="form-control" name="category_id" >
                                                                <option value="">Select</option>
                                                                @foreach(\App\Model\WebSetting\WebGalleryCategory::get() as $cat)
                                                                    <option value="{{$cat->id}}" {{$cat->id === $value->category_id?'selected':''}}>{{$cat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type">type </label>
                                                            <select class="form-control" name="type" >
                                                                <option value="image" {{'image' === $value->type?'selected':''}}>Image</option>
                                                                <option value="url" {{'url' === $value->type?'selected':''}}>Url</option>
                                                                <option value="video" {{'video' === $value->type?'selected':''}}>Video</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link">Link </label>
                                                            <input type="text" class="form-control" id="link" name="link" value="{{$value->link}}">
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
                                <td ><img src="{{asset('assets/frontend/img/gallery/gallery_section/'.$value->image)}}" style="height: 50px"></td>
                                <td>{{$value->category->name}}</td>
                                <td>{{$value->type}}</td>
                                <td>{{$value->link}}</td>
                                <td class="text-right">
                                    <div class="">
                                        <a href="#" class="btn btn-sm btn-square btn-tsk" data-toggle="modal" data-target="#update_{{$value->id}}"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-square btn-danger" onclick="confirm('Are you sure delete this data')?$('#delete_form_{{$value->id}}').submit():false"><i class="fa fa-trash"></i> Delete</a>
                                    </div>
                                    <form action="{{route('admin.web_setting.gallery.gallery-section.delete',$value->id)}}" id="delete_form_{{$value->id}}" method="post">@csrf</form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="4">No result </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
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
                            <form action="{{route('admin.web_setting.gallery.gallery-section.store')}}" method="post" enctype="multipart/form-data">@csrf

                                <div class="form-group">
                                    <label for="image">Image </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group">
                                    <label for="image">Category </label>
                                    <select class="form-control" name="category_id" >
                                        <option value="">Select</option>
                                        @foreach(\App\Model\WebSetting\WebGalleryCategory::get() as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type">type </label>
                                    <select class="form-control" name="type" >
                                        <option value="image">Image</option>
                                        <option value="url">Url</option>
                                        <option value="video">Video</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link </label>
                                    <input type="text" class="form-control" id="link" name="link">
                                </div>
                                <div class="form-group">
                                    <hr/>
                                    <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                    <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection