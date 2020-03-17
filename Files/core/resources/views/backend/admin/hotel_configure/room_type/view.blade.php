@extends('backend.master')
@section('title',"Room Type")
@section('style')
    <style>
        .img{
            position: relative;
            max-height: 191px;
        }
        .img .non_featured{
            display: none;
        }
       .img .featured{
           display: block;
           position: absolute;
           top:12px;
           left: 12px;
           z-index: 999;
           background: green;
           padding: 5px;
           font-weight: bold;
           color: white;
       }

       .img .delete-img-btn{
           display: none;
           position: absolute;
           bottom:12px;
           right: 12px;
           z-index: 999;
           padding: 5px;
           font-weight: bold;
           color: white;
       }
        .img:hover > .delete-img-btn{
            display: block;
        }
    </style>
    @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-tsk  mb-2" href="{{route('backend.admin.room_type')}}"><i class="fa fa-list"></i> Room type List</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4><strong>Room Type Details</strong></h4><hr/>
                    <dl class="row">
                        <dt class="col-md-6">Title :</dt>
                        <dd class="col-md-6">{{$roomType->title}}</dd>
                        <dt class="col-md-6">Slug :</dt>
                        <dd class="col-md-6">{{$roomType->slug}}</dd>
                        <dt class="col-md-6">Short Code :</dt>
                        <dd class="col-md-6">{{$roomType->short_code}}</dd>
                        <dt class="col-md-6">Base Capacity :</dt>
                        <dd class="col-md-6">{{$roomType->base_capacity}}</dd>
                        <dt class="col-md-6">Higher  Capacity :</dt>
                        <dd class="col-md-6">{{$roomType->higher_capacity}}</dd>
                        <dt class="col-md-6">Extra Bed :</dt>
                        <dd class="col-md-6">{{$roomType->extra_bed?'YES':'NO'}}</dd>
                        <dt class="col-md-6">Kids  Capacity :</dt>
                        <dd class="col-md-6">{{$roomType->kids_capacity}}</dd>
                        <dt class="col-md-6">Amenities :</dt>
                        <dd class="col-md-6">
                            @foreach($roomType->amenity as $amenity)
                                <span class="badge bg-tsk text-white">{{$amenity->name}}</span>
                            @endforeach
                        </dd>
                        <dt class="col-md-6">Base Price :</dt>
                        <dd class="col-md-6">{{number_format($roomType->base_price,2)}} {{general_setting()->cur}}</dd>
                        <dt class="col-md-6">Additional Person Price :</dt>
                        <dd class="col-md-6">{{number_format($roomType->additional_person_price,2)}} {{general_setting()->cur}}</dd>
                        <dt class="col-md-6">Extra Bed Price :</dt>
                        <dd class="col-md-6">{{number_format($roomType->extra_bed_price,2)}} {{general_setting()->cur}}</dd>
                        <dt class="col-md-6">Status :</dt>
                        <dd class="col-md-6"><span class="badge {{$roomType->status?'badge-success':'badge-danger'}}">{{$roomType->status?'Active':'Inactive'}}</span></dd>
                    </dl>

                </div>
            </div>
            <div class="card  mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label><strong>Description</strong></label><hr/>
                            {{$roomType->description}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><strong>Regular Price</strong></h4><hr/>
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    @foreach(days_arr() as $key=>$value)
                                    <th class="text-center">{{ucfirst($value)}}</th>
                                        @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach(days_arr() as $key=>$value)
                                    <td class="text-center">
                                        @if($roomType->getDayByRegularPrice($key)['amount_type'] ==='ADD')
                                            {{number_format($roomType->getDayByRegularPrice($key)['amount'],2)}} {{general_setting()->cur}}
                                            @elseif($roomType->getDayByRegularPrice($key)['amount_type'] ==='LESS')
                                        <span class="text-danger">(   {{number_format($roomType->getDayByRegularPrice($key)['amount'],2)}} {{general_setting()->cur}} )</span>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><strong>Special Price</strong></h4><hr/>
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date Range</th>
                                    @foreach(days_arr() as $key=>$value)
                                    <th class="text-center">{{ucfirst($value)}}</th>
                                        @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roomType->specialPrice as $special_price)
                                <tr>
                                    <td>{{$special_price->title}}</td>
                                    <td>{{$special_price->start_time}} to {{$special_price->end_time}}</td>
                                    @foreach(days_arr() as $key=>$value)
                                    <td class="text-center">
                                        @if($special_price->getDayByRegularPrice($key)['amount_type'] ==='ADD')
                                            {{number_format($special_price->getDayByRegularPrice($key)['amount'],2)}} {{general_setting()->cur}}
                                            @elseif($special_price->getDayByRegularPrice($key)['amount_type'] ==='LESS')
                                        <span class="text-danger">(   {{number_format($special_price->getDayByRegularPrice($key)['amount'],2)}} {{general_setting()->cur}} )</span>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Image</strong> <form action="{{route('backend.admin.room_type_upload_image')}}" class="float-right" method="post" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="room_type" value="{{$roomType->id}}">
                            <input id="image" type="file" name="image" class="d-none">
                            <label for="image" class="btn btn-sm btn-outline-tsk"> <i class="fa fa-folder-open"></i> Add New Image</label>
                            <button type="submit" class="btn  btn-sm btn-tsk mb-2"><i class="fa fa-image"></i> Upload</button>
                        </form></h6><hr/>
                    <div class="row">
                        @foreach($roomType->roomTypeImage as $image)
                            <div class="col-md-6  p-2 ">
                                <div class="img img-thumbnail">
                                    <img src="{{asset('assets/backend/image/room_type_image_th/'.$image->image)}}" class="img-fluid img-responsive">
                                    <div class="featured" >
                                        @if($image->featured)
                                            FEATURED
                                        @else
                                            <a href="{{route('backend.admin.room_type_set_as_featured',[$roomType->id,$image->id])}}" class="btn btn-sm btn-danger">Set as featured</a>
                                        @endif
                                    </div>

                                    <div class="delete-img-btn">
                                        <form action="{{route('backend.admin.room_type_delete_image')}}" method="post" id="delete_img_form_{{$image->id}}">
                                            @csrf
                                            <input type="hidden" name="room_type" value="{{$roomType->id}}">
                                            <input type="hidden" name="id" value="{{$image->id}}">
                                        </form>
                                        <a href="#" onclick="$('#delete_img_form_{{$image->id}}').submit()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection