@extends('backend.master')
@section('title', 'Gateway Settings')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-fileinput/bootstrap-fileinput.css')}}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center bg-white"><h3>PAYMENT GATEWAY</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.gateway')}}"  class="btn btn-outline-primary {{active_menu([route('admin.gateway')],'active')}}">All</a>
                    <a href="{{route('admin.gateway','online')}}"  class="btn btn-outline-primary {{active_menu([route('admin.gateway','online')],'active')}}">Online</a>
                    <a href="{{route('admin.gateway','offline')}}" class="btn btn-outline-primary {{active_menu([route('admin.gateway','offline')],'active')}}">Offline</a>
                    <a href="#0" class="btn btn-primary float-right" data-target="#createNew" data-toggle="modal"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="row">
                @foreach($items as $gateway)
                    <div class="col-md-3" style="margin-top:10px;">
                        <div class="card text-white {{$gateway->status==1?'bg-dark':'bg-secondary'}}">
                            <div class="card-header ">
                                {{$gateway->main_name}}
                                <a href="{{route('admin.payment_log',$gateway->id)}}" class="float-right  text-info"><i class="fa fa-file"></i> Log</a>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{route('gateway.list.update', $gateway)}}" enctype="multipart/form-data">
                                    @csrf()
                                    <div class="form-group text-center">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                @if( file_exists('assets/backend/image/gateway/'.$gateway->id.'.jpg'))
                                                <img src="{{ asset('assets/backend/image/gateway') }}/{{$gateway->id}}.jpg" alt="*" />
                                                    @else
                                                    <img src="{{ asset('assets/backend/image/gateway/default.png') }}" alt="*" />
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;">
                                            </div>
                                            <div>
                                                    <span class="btn btn-success btn-file">
                                                        <span class="fileinput-new"> Change Logo </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="gateimg">
                                                    </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label  class="form-group col-md"> <input type="checkbox" name="is_online" {{ $gateway->is_online ? 'checked' : '' }} value="1"> Online</label>
                                        <label  class="form-group col-md"> <input type="checkbox" name="is_offline" {{ $gateway->is_offline? 'checked' : '' }} value="1"> Offline</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" {{ $gateway->status == "1" ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $gateway->status == "0" ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-info btn-block btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample{{$gateway->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fa fa-eye"></i> DETAILS
                                    </button>
                                    <div class="collapse" id="collapseExample{{$gateway->id}}">
                                        <hr/>
                                        <div class="form-group">
                                            <label>Name of Gateway</label>
                                            <input type="text" value="{{$gateway->name}}" class="form-control" id="name" name="name" >
                                        </div>
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            1 USD =
                                                        </span>
                                                </div>
                                                <input type="text" value="{{$gateway->rate}}" class="form-control" id="rate" name="rate" >
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            {{ general_setting()->cur_sym }}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="card text-center text-dark">
                                            <div class="card-header">
                                                Deposit Limit
                                            </div>
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label for="minamo">Minimum Amount</label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{$gateway->minamo}}" class="form-control" id="minamo" name="minamo" >
                                                        <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    {{  general_setting()->cur_sym }}
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="maxamo">Maximum Amount</label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{$gateway->maxamo}}" class="form-control" id="maxamo" name="maxamo" >
                                                        <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    {{  general_setting()->cur_sym }}
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr/>
                                        <div class="card text-center text-dark">
                                            <div class="card-header">
                                                Deposit Charge
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="chargefx">Fixed Charge</label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{$gateway->fixed_charge}}" class="form-control" id="chargefx" name="fixed_charge" >
                                                        <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    {{  general_setting()->cur_sym }}
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="chargepc">Charge in Percentage</label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{$gateway->percent_charge}}" class="form-control" id="chargepc" name="percent_charge" >
                                                        <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    {{  general_setting()->cur_sym }}
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        @if($gateway->id==101)
                                            <div class="form-group">
                                                <label for="val1">PAYPAL BUSINESS EMAIL</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                        @elseif($gateway->id==102)
                                            <div class="form-group">
                                                <label for="val1">PM USD ACCOUNT</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">ALTERNATE PASSPHRASE</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>

                                        @elseif($gateway->id==103)
                                            <div class="form-group">
                                                <label for="val1">SECRET KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">PUBLISHABLE KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==104)
                                            <div class="form-group">
                                                <label for="val1">Marchant Email</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Secret KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==105)
                                            <div class="form-group">
                                                <label for="val1">Merchant ID</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Merchant Key</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val3">Website</label>
                                                <input type="text" value="{{$gateway->val3}}" class="form-control" id="val3" name="val3" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val4">Industry Type</label>
                                                <input type="text" value="{{$gateway->val4}}" class="form-control" id="val4" name="val4" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val5">Channel ID</label>
                                                <input type="text" value="{{$gateway->val5}}" class="form-control" id="val5" name="val5" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val6">Transaction URL</label>
                                                <input type="text" value="{{$gateway->val6}}" class="form-control" id="val6" name="val6" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val7">Transaction Status URL</label>
                                                <input type="text" value="{{$gateway->val7}}" class="form-control" id="val7" name="val7" >
                                            </div>
                                        @elseif($gateway->id==106)
                                            <div class="form-group">
                                                <label for="val1">MERCHANT ID</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Secret key</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==107)
                                            <div class="form-group">
                                                <label for="val1">Public KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Secret key</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                            <div class="form-group">
                                                <label>NGN Rate</label>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        1 NGN =
                                                    </span>
                                                    <input type="text" value="{{$gateway->val7}}" class="form-control" name="val7" >
                                                    <span class="input-group-text">
                                                        USD
                                                    </span>
                                                </div>
                                            </div>
                                        @elseif($gateway->id==108)
                                            <div class="form-group">
                                                <label for="val1">MERCHANT ID</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                        @elseif($gateway->id==501)
                                            <div class="form-group">
                                                <label for="val1">API KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">XPUB CODE</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==502)
                                            <div class="form-group">
                                                <label for="val1">API KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">API PIN</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==503)
                                            <div class="form-group">
                                                <label for="val1">API KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">API PIN</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==504)
                                            <div class="form-group">
                                                <label for="val1">API KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">API PIN</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==505)
                                            <div class="form-group">
                                                <label for="val1">Public  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Private KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==506)
                                            <div class="form-group">
                                                <label for="val1">Public  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Private KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==507)
                                            <div class="form-group">
                                                <label for="val1">Public  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Private KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==508)
                                            <div class="form-group">
                                                <label for="val1">Public  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Private KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==509)
                                            <div class="form-group">
                                                <label for="val1">Public  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Private KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==510)
                                            <div class="form-group">
                                                <label for="val1">Public  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                            <div class="form-group">
                                                <label for="val2">Private KEY</label>
                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                            </div>
                                        @elseif($gateway->id==512)
                                            <div class="form-group">
                                                <label for="val1">API  KEY</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                        @elseif($gateway->id==513)
                                            <div class="form-group">
                                                <label for="val1">Merchant ID</label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="val1"><strong>Payment Details</strong></label>
                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                            </div>
                                        @endif

                                        @if($gateway->id < 100 || $gateway->id==101)
                                            <div class="form-group" style="height:65px;">
                                            </div>
                                        @endif
                                    </div>

                                    <hr/>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new Gateway</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('gateway.list.store')}}" method="post" enctype="multipart/form-data" id="create_form">@csrf
                        <div class="form-row">
                            <div class="form-group col-md text-center">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                        <img src="{{ asset('assets/backend/image/gateway/default.png') }}" alt="*" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                    <div>
                                                    <span class="btn btn-success btn-file">
                                                        <span class="fileinput-new"> Change Logo </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="gateimg">
                                                    </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label>Online</label>
                                <input data-toggle="toggle"  data-onstyle="success" data-offstyle="danger" data-width="100%"  data-height="40px"  type="checkbox" name="is_online" value="1">
                            </div>
                            <div class="form-group col-md">
                                <label>Offline</label>
                                <input data-toggle="toggle" checked  data-onstyle="success" data-offstyle="danger" data-width="100%"  data-height="40px"  type="checkbox" name="is_offline" value="1">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" >Active</option>
                                    <option value="0" >Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label>Name of Gateway</label>
                                <input type="text" class="form-control" id="name" name="name" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label>Rate</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            1 USD =
                                                        </span>
                                    </div>
                                    <input type="text"  class="form-control" id="rate" name="rate" >
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            {{ general_setting()->cur_sym }}
                                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="card text-center text-dark">
                                <div class="card-header">
                                    Deposit Charge
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="chargefx">Fixed Charge</label>
                                        <div class="input-group">
                                            <input type="text"  class="form-control" id="chargefx" name="fixed_charge" >
                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    {{  general_setting()->cur_sym }}
                                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="chargepc">Charge in Percentage</label>
                                        <div class="input-group">
                                            <input type="text"  class="form-control" id="chargepc" name="percent_charge" >
                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    {{  general_setting()->cur_sym }}
                                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#create_form').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/plugin/bootstrap-fileinput/bootstrap-fileinput.js')}}"></script>
@endsection
