<nav class="navbar navbar-expand navbar-dark bg-tsk d-print-none">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="{{route('backend.admin.dashboard')}}"><img src="{{general_setting()->logo}}" ></a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{auth_user()->username}}</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="#" data-toggle="modal" data-target="#change_password_modal" class="dropdown-item text-tsk"><i class="fa fa-key"></i> Change Password</a>
                    <form action="{{route('admin.logout')}}" method="post" id="logout-form">
                        <input type="hidden" name="role" value="{{auth_user()->guard}}">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item text-tsk" onclick="$('#logout-form').submit()"><i class="fa fa-key"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>