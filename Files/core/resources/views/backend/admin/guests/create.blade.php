@extends('backend.master')
@section('title',"Create New Guest")
@section('content')

        <div class="card">
            <div class="card-header bg-white">
                <h2>Create New Guest
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.guests')}}"><i class="fa fa-list"></i> Guest List</a>

                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('backend.admin.guests.store')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">

                    <div class="form-group col-md-4">
                        <label><strong>First Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Last Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Username</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" value="{{old('username')}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">

                    <div class="form-group col-md-4">
                        <label><strong>Password</strong> <small class="text-danger">*</small></label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" value="{{old('password')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Email</strong> <small class="text-danger">*</small></label>
                        <input type="email" class="form-control form-control-lg" name="email" placeholder="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Phone</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="phone" placeholder="Phone" value="{{old('phone')}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label><strong>Sex</strong> <small class="text-danger">*</small></label>
                        <select  class="form-control form-control-lg" name="sex" >
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Other</option>
                        </select>
                        <label><strong>Image</strong></label>
                        <input type="file" class="form-control form-control-lg" name="picture">
                    </div>
                    <div class="form-group col-md-8">
                        <label><strong>Address</strong></label>
                        <textarea  class="form-control form-control-lg" rows="4" name="address">{{old('address')}}</textarea>
                    </div>

                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label><strong>Type Of ID</strong></label>
                        <input type="text" class="form-control form-control-lg" name="id_type" placeholder="ID Type" value="{{old('id_type')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>ID NO</strong> </label>
                        <input type="text" class="form-control form-control-lg" name="id_number" placeholder="ID Number" value="{{old('id_number')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Upload ID Card</strong> </label>
                        <input type="file" class="form-control form-control-lg" name="id_card_image" >
                    </div>

                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Remarks</strong></label>
                        <textarea  class="form-control form-control-lg" name="remarks">{{old('remarks')}}</textarea>
                    </div>

                </div>

                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label><strong>Date Of Birth</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="dob" id="dob" value="{{old('dob',date('Y/m/d'))}}">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="vip" class=" mr-5">VIP</label>
                        <input id="vip"  type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="vip">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="status" class=" mr-5">Status</label>
                        <input id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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