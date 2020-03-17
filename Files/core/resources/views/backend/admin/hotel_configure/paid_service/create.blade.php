@extends('backend.master')
@section('title',"Create Paid Service")
@section('content')

        <div class="card">
            <div class="card-header bg-white">
                <h2>Create Paid Service
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.paid_service')}}"><i class="fa fa-list"></i> Paid Service List</a>

                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('backend.admin.paid_service.store')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Title</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="title" placeholder="Title" value="{{old('title')}}" required>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label><strong>Price</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="price" placeholder="Price" value="{{old('price')}}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label><strong>Icon</strong> <small class="text-danger">*</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">fa fa-</div>
                            </div>
                            <input type="text" class="form-control form-control-lg" name="icon" placeholder="Icon" value="{{old('icon')}}" required>

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" checked type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
                    </div>
                </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12">
                            <hr/>
                            <button type="submit" class="btn btn-lg mt-4 btn-tsk btn-block"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
@section('script')
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({
                iconsPath : '{{asset('assets/plugin/niceditor/nicEditorIcons.gif')}}',
                fullPanel : true
            }).panelInstance('long_desc');
        });
    </script>
@endsection