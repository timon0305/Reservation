@extends('backend.master')
@section('title',"Edit Room Type")
@section('content')

        <div class="card">
            <div class="card-header bg-white">
                <h2>Edit Room Type
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.room_type')}}"><i class="fa fa-list"></i> Room List</a>
                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('backend.admin.room_type.update',$roomType->id)}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label><strong>Title</strong> <small class="text-danger">*</small></label>
                            <input type="text" class="form-control form-control-lg" name="title" placeholder="Title" value="{{$roomType->title}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong>Short Code</strong> <small class="text-danger">*</small></label>
                            <input type="text" class="form-control  form-control-lg" name="short_code" placeholder="Short Code" value="{{$roomType->short_code}}" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <label><strong>Description</strong><small> (optional)</small> </label>
                            <textarea id="description"  class="form-control form-control-lg" rows="4" name="description" placeholder="Description">{{ $roomType->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label><strong>Higher Capacity</strong> <small class="text-danger">*</small></label>
                            <input type="number" class="form-control form-control-lg" name="higher_capacity" placeholder="Higher Capacity" value="{{$roomType->higher_capacity}}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label><strong>Kids Capacity</strong></label>
                            <input type="number" class="form-control form-control-lg" name="kids_capacity" placeholder="Kids Capacity" value="{{$roomType->kids_capacity}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label><strong>Base Price</strong></label>
                            <input type="number" class="form-control form-control-lg" name="base_price" placeholder="Base Price" value="{{$roomType->base_price}}">
                        </div>
                    </div>

                        <div class="form-row justify-content-center">
                            @if($amenities->count())
                            <div class="form-group col-md-6">
                                <label><strong>Amenities</strong></label>
                                <br/>
                                @foreach($amenities as $amenity)
                                    <div class="custom-control custom-checkbox checkbox-inline">
                                        <input type="checkbox" {{in_array($amenity->id,$roomType->amenity->pluck('id')->toArray())?'checked':''}} class="custom-control-input" id="amenities_{{$amenity->id}}" name="amenities[]" value="{{$amenity->id}}">
                                        <label class="custom-control-label pr-4" for="amenities_{{$amenity->id}}">{{$amenity->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="form-group col-md-6">
                                <label for="inputAddress2" class=" mr-5">Status</label>
                                <input id="status" {{$roomType->status?'checked':''}} data-width="100%" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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
            }).panelInstance('description');
        });
    </script>
@endsection