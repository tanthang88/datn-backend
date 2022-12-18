<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="SHORTCUT ICON" href="" type="image/x-icon" />
    <link rel="stylesheet"
        href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
</head>
<body class="login-page" style="min-height: 466px;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>LastFire </b>Admin</a>
            </div>
            <div class="card-body">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <span style="color: red;font-style: italic"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" name="password" placeholder="Mật khẩu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <span style="color: red;font-style: italic"> {{ $message }}</span>
                        @enderror
                        @if(Session::has('message'))
                        <span style="color: red;font-style: italic">{{ Session::get('message') }}</span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/adminlte.min.js?v=3.2.0')}}"></script>
    @if(Session::has('success'))
    <script>
        Swal.fire("{!! Session::get('success')!!}", '', 'success')
    </script>
    @elseif(Session::has('error'))
    <script>
        Swal.fire("{!! Session::get('error')!!}", '', 'error')
    </script>
    @endif
</body>

</html>
