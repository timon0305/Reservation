<div class="modal fade" id="add_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-money"></i> Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="" action="{{route('backend.admin.reservation.payment',$data->id)}}" method="post" enctype="multipart/form-data">@csrf
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Reservation Number</strong></label>
                                    <input class="form-control" readonly value="{{$data->uid}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Date</strong></label>
                                    <input class="form-control" name="date" readonly value="{{date('Y/m/d')}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Payment Method</strong></label>
                                   <select class="form-control" name="payment_method">
                                       @foreach($gateways as $gateway)
                                       <option value="{{$gateway->id}}">{{$gateway->name}}</option>
                                           @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <label><strong>Amount</strong></label>
                                    <input class="form-control" name="amount" value="" placeholder="0.00" required>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12">
                                    <hr/>
                                    <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                    <button type="submit" class="btn btn-tsk"><i class="fa fa-money"></i> Payment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>