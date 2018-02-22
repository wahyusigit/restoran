<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.2 -->
    
    <link href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    {{-- Font Awesome --}}
    {{-- <link href="{{ asset("/bower_components/components-font-awesome/css/fontawesome-all.min.css")}}" rel="stylesheet" type="text/css" /> --}}
    <!-- Ionicons -->
    {{-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css")}}" rel="stylesheet" type="text/css" /> --}}
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .table > tbody > tr > td {
            vertical-align: middle;
        }
        .fa {
            padding: 0px 4px;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    {{-- Vue Animate --}}
    <link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.1" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/select2@4.0.3/dist/css/select2.min.css" />
    <link href="{{ asset('css/v-autocomplete.css') }}" rel="stylesheet" type="text/css"/>
    
</head>
<body class="skin-blue">
	<div id="app">
		<div class="wrapper">
		    @include('partials.header')
		    @include('partials.sidebar')
		    <div class="content-wrapper">
		        <section class="content">
		            @yield('content')
		        </section>
		    </div>
		    @include('partials.footer')
		</div>
	</div>
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->


<script src="{{ asset ("/bower_components/jquery/dist/jquery.min.js") }}"></script>
    {{-- <script type="text/javascript" src="https://unpkg.com/jquery@3.1.1/dist/jquery.js"></script> --}}
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/adminlte.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/app.js") }}" type="text/javascript"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>
</html>