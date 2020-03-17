<div class="modal fade" id="regular_price_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Regular Price For <strong>{{$data->title}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="" action="{{route('backend.admin.regular_price_update',$data->id)}}" method="post" enctype="multipart/form-data">@csrf
                            @foreach(days_arr() as $key=>$day)
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label><strong>{{ucfirst($day)}}</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="day[{{$key}}][amount]" value="{{$data->getDayByRegularPrice($key)['amount']}}">
                                        <div class="input-group-append">
                                            <select class="form-control"  name="day[{{$key}}][type]" style="width: 100px">
                                                <option class="text-success" value="ADD" {{$data->getDayByRegularPrice($key)['amount_type']==='ADD'?'selected':''}}>Add</option>
                                                <option class="text-danger" value="LESS" {{$data->getDayByRegularPrice($key)['amount_type']==='LESS'?'selected':''}}>Less</option>
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
                                    <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>