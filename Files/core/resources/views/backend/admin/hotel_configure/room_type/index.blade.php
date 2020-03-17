@extends('backend.master')
@section('title',"Room Type")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Room Type
                    <div class=" float-right">

                        <a class="btn btn-tsk" data-toggle="modal" data-target="#add_image"><i class="fa fa-image"></i> Image Upload</a>
                        <a class="btn btn-tsk" href="{{route('backend.admin.room_type.create')}}"><i class="fa fa-plus"></i> Add Room Type</a>
                    </div>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk text-white">
                    <tr>
                        <th>Sl No</th>
                        <th>Title</th>
                        <th>Short Code</th>
                        <th>Price</th>
                        <th class="text-center">Total Room</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roomTypes as $key=>$roomType)
                        @include('backend.admin.hotel_configure.room_type.regular_price',['data'=>$roomType])
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$roomType->title}}</td>
                        <td>{{$roomType->short_code}}</td>
                        <td>{{general_setting()->cur_sym}}{{$roomType->base_price}}</td>
                        <td class="text-center">{{$roomType->room->count()}}</td>
                        <td><span class="badge {{$roomType->status?'badge-success':'badge-danger'}}">{{$roomType->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <div class="btn-group  btn-group-sm" role="group">
                                    <a id="btnGroupDrop1" class="btn btn-outline-tsk dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cog"></i>  Manage Price
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#regular_price_{{$roomType->id}}" href="#">Regular Price</a>
                                        <a class="dropdown-item spaicel-btn"
                                           data-url="{{route('backend.admin.special_price_update',$roomType->id)}}"
                                           data-toggle="modal" data-target="#special_price" href="#">Special Price</a>
                                    </div>
                                </div>

                                <a href="{{route('backend.admin.room_type.view',$roomType->id)}}" class="btn btn-outline-tsk"><i class="fa fa-eye"></i> </a>
                                <a href="{{route('backend.admin.room_type.edit',$roomType->id)}}" class="btn btn-outline-tsk"><i class="fa fa-pencil"></i> </a>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    <div class="modal fade" id="add_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">IMAGE UPLOAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="" action="{{route('backend.admin.room_type_upload_image')}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Select Room type</strong> <small class="text-danger">*</small></label>
                                        <select  class="form-control" name="room_type" >
                                            <option value="">Select</option>
                                            @foreach($roomTypes as $roomType)
                                                <option value="{{$roomType->id}}">{{$roomType->title}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <label for="featured" class=" mr-5"> Featured Images</label>
                                        <input id="featured" checked type="checkbox" data-onstyle="success" data-height="35px" data-width="80px" data-offstyle="danger" data-toggle="toggle" name="featured">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Image</strong> <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control" name="image" placeholder="Image" >
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <hr/>
                                        <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="special_price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Special Price <strong></strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="" action="" method="post" id="spaicel_form">@csrf
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-12">
                                            <label><strong>Title</strong></label>
                                            <input class="form-control" name="title" value="" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6">
                                            <label><strong>Start Date</strong></label>
                                            <input type="text" class="form-control " id="start_time"  name="start_time" value="{{date('Y/m/d H:i')}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><strong>End Date</strong></label>
                                            <input type="text" class="form-control " id="end_time"  name="end_time" value="{{date('Y/m/d H:i')}}">
                                        </div>
                                    </div>
                                    <hr/>
                                    @foreach(days_arr() as $key=>$day)

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-md-12">
                                                <label><strong>{{ucfirst($day)}}</strong></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="day[{{$key}}][amount]" value="0">
                                                    <div class="input-group-append">
                                                        <select class="form-control"  name="day[{{$key}}][type]" style="width: 100px">
                                                            <option class="text-success" value="ADD" >Add</option>
                                                            <option class="text-danger" value="LESS" >Less</option>
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-sm-12">
                                            <hr/>
                                            <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                            <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click','.spaicel-btn',function () {
               $('#spaicel_form').attr('action',$(this).data('url'));
                $('#start_time').datetimepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy/mm/dd HH:MM',
                    // footer: true, modal: true
                });
                $('#end_time').datetimepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy/mm/dd HH:MM',
                    // footer: true, modal: true
                });
            });
        });
    </script>
@endsection