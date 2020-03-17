@extends('backend.master')
@section('title',"Blog")
@section('style')
    <link href="{{ asset('assets/plugin/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('content')

    <h2 class="mb-4">{{$page_title}}</h2>

    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            <a href="{{route('admin.blog')}}" class="btn btn-success btn-md float-right">
                <i class="fa fa-eye"></i> All Blog
            </a>
        </div>

        <form role="form" method="POST" action="{{route('blog.update')}}" name="editForm" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="card-body">
                <input type="hidden" name="id" value="{{$post->id}}">
                    <div class="form-group">
                        <h5> Title</h5>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" value="{{$post->title}}"
                                   name="title">
                            <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                            </div>
                        </div>
                        @if ($errors->has('title'))
                            <div class="error">{{ $errors->first('title') }}</div>
                        @endif

                    </div>


                    <div class="form-group">
                        <h5>Category</h5>
                        <select name="cat_id" id="cat_id" class="form-control form-control-lg">
                            <option value="">Select Category</option>
                            @foreach($category as $data)
                                <option value="{{$data->id}}"  @if($post->cat_id == $data->id) selected @endif>{{$data->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('cat_id'))
                            <div class="error">{{ $errors->first('cat_id') }}</div>
                        @endif
                    </div>


                    <div class="form-group">
                        <h5>Image</h5>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                 data-trigger="fileinput">
                                @if($post->image == null)
                                    <img style="width: 200px"
                                         src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image"
                                         alt="...">
                                @else
                                    <img style="width: 200px" src="{{ asset('assets/backend/image/blog/post') }}/{{ $post->image }}"
                                         alt="...">
                                @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                 style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                   data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                        @if ($errors->has('image'))
                            <div class="error">{{ $errors->first('image') }}</div>
                        @endif

                    </div>


                    <div class="form-group">
                        <h5>Details</h5>
                        <textarea name="details" id="area1" cols="30" rows="12" class="form-control form-control-lg">{{$post->details}}</textarea>
                        @if ($errors->has('details'))
                            <div class="error">{{ $errors->first('details') }}</div>
                        @endif
                    </div>


                    <div class="form-group">
                        <h5>Status</h5>
                        <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                               data-width="100%" type="checkbox"
                               name="status" {{$post->status == "1" ? 'checked' : '' }}>
                    </div>
            </div>
            <div class="card-footer bg-white">
                <button class="btn btn-primary btn-block btn-lg" type="submit">Update Blog</button>
            </div>

        </form>
    </div>


@endsection

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('assets/admin/js/nicEdit-latest.js') }} "></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('area1');
        });
    </script>
@stop