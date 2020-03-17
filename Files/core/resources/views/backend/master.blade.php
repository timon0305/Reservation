
<!doctype html>
<html lang="en">
@include('backend.partials.head')
<body class="bg-light">
@include('backend.partials.nav')
<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark d-print-none">
        <div class="user-div text-center p-3 bg-tsk-o-1 " style="height: 50px">
           <h5 ><a class="text-white" href="#">{{strtoupper(auth_user()->username)}}</a></h5>
        </div>
        @include('backend.admin.sidebar')
    </div>

    <div class="content p-4" id="app">
        @yield('content')

    </div>
</div>

<div class="modal" id="change_password_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.user_profile.change_password.store')}}" method="post" >@csrf
                    <div class="form-row justify-content-center">
                        <div class="form-group col-lg-12">
                            <label for="old_password">Old Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="old_password" name="old_password"
                                   placeholder="Old Password" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-lg-12">
                            <label for="new_password">New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                   placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-lg-12">
                            <label for="new_password_confirmation">Confirmed Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                                   placeholder="Confirmed Password" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-lg-12">
                            <hr/>
                            <button type="submit" class="btn btn-tsk "><i class="fa fa-save"></i> Change</button>
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
@include('backend.partials.script')
@include('backend.partials.msg')

</body>
</html>