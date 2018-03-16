<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator | STOP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/AdminLTE.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style type="text/css">
        body {
            background-color: #d2d6de;
        }
    </style>
</head>
<body>
    <section class="content" style="margin-top: 10%">
        <div class="error-content text-center" style="margin: 0">
            <h3><i class="fa fa-warning text-yellow"></i> STOP! Anda tidak disarankan masuk ke halaman tersebut.</h3>
            <p>
                Sebaiknya gunakan hak akses Customer untuk dapat mengakses halaman Profile.
            </p>
            <p>
                Silahkan <a href="{{ url('/login') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><strong>Login</strong></a> sebagai customer, atau <a href="{{ url('/admin') }}"><strong>kembali ke halaman Dashboard</strong>.</a>
            </p>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </section>
</body>
</html>