<div class="modal fade" id="add_service" tabindex="-1" role="dialog" aria-labelledby="add_service" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="" action="{{route('backend.admin.reservation.add_service',$data->id)}}" method="post" >@csrf
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Reservation Number</strong></label>
                                    <input class="form-control" readonly value="{{$data->uid}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Date</strong></label>
                                    <input class="form-control" name="date" readonly  value="{{date('Y/m/d')}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Service</strong></label>
                                   <select class="form-control" name="service">
                                       <option value="">Select Service</option>
                                       @foreach($paid_services as $service)
                                       <option value="{{$service->id}}">{{$service->title}} ( {{ number_format($service->price,2)}} {{general_setting()->cur}} )</option>
                                           @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Quantity</strong></label>
                                    <input class="form-control" name="qty" value="" placeholder="0" required>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <hr/>
                                    <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                    <button type="submit" class="btn btn-tsk"><i class="fa fa-money"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>