<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <link rel="shortcut icon" href="{{ asset('assets/pictures/logo.png') }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/Ionicons/css/ionicons.min.css') }}">

    {{-- Aditional Style --}}
    @yield('style')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('dashboard.layouts.header')

        @include('dashboard.layouts.aside')

        @yield('content')

        @include('dashboard.layouts.footer')
    </div>

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/dashboard/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('assets/dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/dashboard/bower_components/fastclick/lib/fastclick.js') }}"></script>

    {{-- Additional Script --}}
    @yield('scripts')

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dashboard/dist/js/adminlte.min.js') }}"></script>

    <script type="text/javascript">
        $("a[href='"+document.location+"']").parents('li').addClass('active')
    </script>
</body>
</html>
