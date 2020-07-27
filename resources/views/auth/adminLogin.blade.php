<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Loding font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/admin/css/styleLogin.css') }}">

    <title>Admin Login</title>
    <style>
        body{
            background-image: url("{{ asset("asset/images/bg.jpg") }}");
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>

<div class="container" id="login">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="login">
                <h1>Đăng Nhập</h1>
                <!-- Loging form -->
                <form action="{{ route('admin.login.submit')}}" autocomplete="off" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="user_name" placeholder="Tài khoản">

                        @error('user_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Mật khẩu">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-check">
                        <label class="switch">
                            <input type="checkbox" name="remember">
                            <span class="slider round"></span>
                        </label>
                        <label class="form-check-label" for="exampleCheck1">Ghi nhớ</label>

                        <label class="forgot-password"><a href="#">Quên mật khẩu?</a></label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">Đăng nhập</button>
                </form>
                <!-- End Loging form -->
            </div>
        </div>
    </div>
</div>

</body>
</html>
