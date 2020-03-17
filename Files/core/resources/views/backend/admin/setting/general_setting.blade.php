@extends('backend.master')
@section('title',"General Setting")
@section('content')


    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h2>General Setting</h2>
        </div>
        <div class="card-body">
            <form role="form" method="post" action="{{route('backend.admin.general_setting.update')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mb-5">
                    <div class="col-md">
                        <label class=""><strong>TITLE</strong></label>
                        <input type="text" class="form-control form-control-lg " value="{{general_setting()->title}}"  name="title">

                    </div>
                    <div class="col-md">
                        <label class=""><strong>ADDRESS</strong></label>
                        <input type="text" class="form-control form-control-lg " value="{{general_setting()->address}}"  name="address">

                    </div>
                    <div class="col-md">
                        <label class=""><strong>EMAIL</strong></label>
                        <input type="email" class="form-control form-control-lg " value="{{general_setting()->email}}"  name="email">

                    </div>
                    <div class="col-md">
                        <label class=""><strong>PHONE</strong></label>
                        <input type="text" class="form-control form-control-lg " value="{{general_setting()->phone}}"  name="phone">

                    </div>
                </div>

                <div class="form-group row mb-5 mt-5">
                    <div class="col-md">
                        <label class=""><strong>SITE BASE COLOR CODE</strong></label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-tsk text-white">#</div>
                            </div>
                            <input type="text" class="form-control  "  value="{{general_setting()->color}}"  name="color">

                        </div>

                    </div>
                    <div class="col-md">
                        <label class=""><strong>CURRENCY</strong></label>
                        <input type="text" class="form-control form-control-lg  "  value="{{general_setting()->cur}}"  name="cur">

                    </div>
                    <div class="col-md">
                        <label class=""><strong>CURRENCY SYMBOL</strong></label>
                        <input type="text" class="form-control form-control-lg  "  value="{{general_setting()->cur_sym}}"  name="cur_sym">

                    </div>


                </div>
                <div class="form-group row mt-5 mb-5">

                    <div class="col-md-3">
                        <label class=""><strong>EMAIL NOTIFICATION</strong></label>
                        <input data-toggle="toggle" {{!general_setting()->en?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="en">

                    </div>
                    <div class="col-md-3">
                        <label class=""><strong>SMS NOTIFICATION</strong></label>
                        <input data-toggle="toggle" {{!general_setting()->mn?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="mn">

                    </div>
                    <div class="col-md-3">
                        <label class=""><strong>CHECK IN TIME</strong></label>
                        <input class="form-control form-control-lg " value="{{general_setting()->check_in_time}}" id="check_in_time"  name="check_in_time">

                    </div>
                    <div class="col-md-3">
                        <label class=""><strong>CHECK OUT TIME</strong></label>
                        <input  class="form-control form-control-lg " value="{{general_setting()->check_out_time}}" id="check_out_time"  name="check_out_time">

                    </div>
                </div>
                <hr/>
                <div class="row mt-5">
                    <div class="col-md-12 ">
                        <button class="btn btn-tsk btn-lg btn-block" >Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#check_in_time').mdtimepicker({format: 'hh:mm'});
        $('#check_out_time').mdtimepicker({format: 'hh:mm'});
    </script>
    @endsection