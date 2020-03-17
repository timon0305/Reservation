<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{general_setting()->title}} | Login</title>
    <link rel="shortcut icon" href="{{general_setting()->favicon}}">
    <!-- fa pls -->
    <link href="https://daneden.github.io/animate.css/animate.min.css" rel="stylesheet">

    <!-- animate.css -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/login_page.css')}}">
</head>
<body>

    
<div class="login-wrap">
    <div class="login-html"  style="text-align: center;">

<div class="logo"  style="margin-bottom: 40px;">
<img src="{{asset('assets/logo.png')}}" alt="logo" style="max-width: 100%;">
</div>

        <input id="tab-1" type="radio" name="tab" class="sign-in"  checked><label for="tab-1" class="tab">Admin Login</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

        <div class="login-form" style="margin-top: 40px;">
            <div class="sign-in-htm">


                <form  action="{{route('admin.login.post')}}" method="post">@csrf
                    <div class="group">
                        <input type="text" class="input" id="username"  name="username"  placeholder="Username" >
                    </div>
                    <div class="group">
                        <input type="password" class="input" id="password" name="password" placeholder="Password">
                    </div>

                    <div class="group">
                        <input type="submit" class="button" value="Log In">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

