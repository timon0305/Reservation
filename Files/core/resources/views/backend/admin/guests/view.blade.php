@extends('backend.master')
@section('title',"Guest")
@section('style')
    <style>
        .vip {
            position: absolute;
            top:0;
            right: 0;
            background: green;
            font-weight: bold;
            padding: 5px 10px 5px 30px;
            color: white;
            border-radius:0 0 0 30px;
        }
    </style>
    @endsection
@section('content')

    <div class="card">
        <div class="card-header bg-white">
            <h2>Guest
                <a class="btn btn-tsk float-right" href="{{route('backend.admin.guests')}}"><i class="fa fa-list"></i> Guest List</a>

            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold text-tsk" href="#details" role="tab" data-toggle="tab">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold text-tsk" href="#orders" role="tab" data-toggle="tab">Reservation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold text-tsk" href="#payment" role="tab" data-toggle="tab">Payment</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="details">
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <div class="tile">
                                        <div class="card">
                                            @if($guest->vip)
                                                <div class="vip">VIP</div>
                                            @endif

                                            <div class="card-body text-center bg-tsk-o-1">
                                                <div class="img">
                                                    <img src="{{$guest->picture_path()}}" id="preview_img" data-oldimg="" class="img-thumbnail" style="max-height: 200px;border-radius: 50%" >
                                                </div>
                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">User Name : </dt>
                                                    <dd class="col-md-6 text-md-left">{{$guest->username}}</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">Name : </dt>
                                                    <dd class="col-md-6 text-md-left">{{$guest->full_name}}</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">Email : </dt>
                                                    <dd class="col-md-6 text-md-left">{{$guest->email}}</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">Phone : </dt>
                                                    <dd class="col-md-6 text-md-left">{{$guest->phone}}</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">Sex : </dt>
                                                    <dd class="col-md-6 text-md-left">{{$guest->sex()}}</dd>
                                                </dl>

                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">Status : </dt>
                                                    <dd class="col-md-6 text-md-left"><span class="badge {{$guest->status?'badge-success':'badge-danger'}}">{{$guest->status?'ACTIVE':'INACTIVE'}}</span></dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-md-6 text-md-right">Date Of Birth : </dt>
                                                    <dd class="col-md-6 text-md-left">{{$guest->dob}}</dd>
                                                </dl>
                                                <p><strong>AGE :</strong><span class="text-muted"> {{\Carbon\Carbon::parse($guest->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile mt-2">
                                        <div class="card">
                                            <h4 class="text-center text-tsk">ID CARD</h4>
                                            <div class="card-body text-center bg-tsk-o-1">
                                                <div class="img">
                                                    <img src="{{$guest->id_card_path()}}" class="img-thumbnail" style="max-height: 200px" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9 ">

                                    <div class="tile">
                                        <div class="tile-body">

                                            <form action="{{route('backend.admin.guests.update',$guest->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                <div class="form-row justify-content-center">

                                                    <div class="form-group col-md-4">
                                                        <label><strong>First Name</strong> </label>
                                                        <input type="text" class="form-control form-control-lg" name="first_name" placeholder="First Name" value="{{$guest->first_name}}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label><strong>Last Name</strong> </label>
                                                        <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Last Name" value="{{$guest->last_name}}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label><strong>Email</strong> <small class="text-danger">*</small></label>
                                                        <input type="email" class="form-control form-control-lg" name="email" placeholder="email" value="{{$guest->email}}">
                                                    </div>

                                                </div>
                                                <div class="form-row justify-content-center">
                                                    <div class="form-group col-md-4">
                                                        <label><strong>Phone</strong> <small class="text-danger">*</small></label>
                                                        <input type="text" class="form-control form-control-lg" name="phone" placeholder="Phone" value="{{$guest->phone}}">
                                                        <label><strong>Sex</strong> <small class="text-danger">*</small></label>
                                                        <select  class="form-control form-control-lg" name="sex" >
                                                            <option value="M" {{$guest->sex==='M'?'selected':''}}>Male</option>
                                                            <option value="F" {{$guest->sex==='F'?'selected':''}}>Female</option>
                                                            <option value="O" {{$guest->sex==='O'?'selected':''}}>Other</option>
                                                        </select>
                                                        <label><strong>Image</strong></label>
                                                        <input type="file" class="form-control form-control-lg" name="picture">
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label><strong>Address</strong></label>
                                                        <textarea  class="form-control form-control-lg" rows="8" name="address">{{$guest->address}}</textarea>
                                                    </div>

                                                </div>
                                                <div class="form-row justify-content-center">
                                                    <div class="form-group col-md-4">
                                                        <label><strong>Type Of ID</strong></label>
                                                        <input type="text" class="form-control form-control-lg" name="id_type" placeholder="ID Type" value="{{$guest->id_type}}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label><strong>ID NO</strong> </label>
                                                        <input type="text" class="form-control form-control-lg" name="id_number" placeholder="ID Number" value="{{$guest->id_number}}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label><strong>Upload ID Card</strong> </label>
                                                        <input type="file" class="form-control form-control-lg" name="id_card_image" >
                                                    </div>

                                                </div>
                                                <div class="form-row justify-content-center">
                                                    <div class="form-group col-md-4">
                                                        <label><strong>Date Of Birth</strong> <small class="text-danger">*</small></label>
                                                        <input type="text" class="form-control form-control-lg" name="dob" id="dob" value="{{date('Y/m/d',strtotime($guest->dob))}}">
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label><strong>Remarks</strong></label>
                                                        <textarea  class="form-control form-control-lg" name="remarks">{{$guest->remarks}}</textarea>
                                                    </div>

                                                </div>

                                                <div class="form-row justify-content-center">

                                                    <div class="form-group col-sm-4">
                                                        <label for="vip" class=" mr-5">VIP</label>
                                                        <input id="vip" {{$guest->vip?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="vip">
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="status" class=" mr-5">Status</label>
                                                        <input id="status" {{$guest->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
                                                    </div>
                                                </div>
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
                        <div role="tabpanel" class="tab-pane fade" id="orders">
                            <div class="table-responsive">
                                <table class="table table-sm table-condensed mb-0">
                                    <thead class="bg-tsk-o-1">
                                    <tr>

                                        <th>Reservation Number</th>
                                        <th>Reservation Date</th>
                                        <th>Room Type</th>
                                        <th>Check in</th>
                                        <th>Check out</th>
                                        <th class="text-center">Payment Status</th>
                                        <th class="text-center">Reservation Status</th>
                                        <th class="text-right" style="width: 50px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($reservations = $guest->reservations()->latest()->paginate(20))
                                    @foreach($reservations as $key=>$reservation)
                                        <tr>

                                            <td><a class="" href="{{route('backend.admin.reservation.view',$reservation->id)}}">{{$reservation->uid}}</a></td>
                                            <td>{{$reservation->date}}</td>
                                            <td>{{$reservation->roomType->title}}</td>
                                            <td>{{$reservation->check_in}}</td>
                                            <td>{{$reservation->check_out}}</td>
                                            <td class="text-center"><span class="badge badge-{{$reservation->paymentStatus()['color']}}">{{$reservation->paymentStatus()['status']}}</span></td>
                                            <td class="text-center"><span class="badge badge-{{$reservation->statusClass()}}">{{$reservation->status}}</span></td>
                                            <td class="text-right">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{route('backend.admin.reservation.view',$reservation->id)}}" class="btn btn-tsk"><i class="fa fa-eye"></i> View</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $reservations->links() }}
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="payment">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Method</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($payments = $guest->payment()->latest()->paginate(20))
                                    @forelse($payments as $key=>$payment)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$payment->created_at}}</td>
                                            <td>{{$payment->trx}}</td>
                                            <td>{{$payment->gateway->name}}</td>
                                            <td class="text-right">{{general_setting()->cur_sym}} {{number_format($payment->amount)}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-danger">No Payment!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $payments->links() }}
                            </div>

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
            $('#dob').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy/mm/dd',
                footer: true, modal: true
            });
        });
    </script>
@endsection