<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Dashboard - Bootstrap Admin Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ url('/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
	rel="stylesheet">
	<link href="{{ url('/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ url('/css/style.css') }}" rel="stylesheet">
	<link href="{{ url('/css/pages/dashboard.css') }}" rel="stylesheet">
	  <link href="{{ url('css/select2.css') }}" rel="stylesheet" type="text/css">
	  	  <link href="{{ url('css/nfontawesome.min.css') }}" rel="stylesheet" type="text/css">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
	<style type="text/css">
/*		.footer{
  position:fixed;
 bottom:0;
 left:0;
}*/
	</style>
	@include('layouts.topnav')
	@include('layouts.subnav')
	<div class="main">
		<div class="main-inner">
			<div class="container">

				@yield('content')

			</div>
		</div>
	</div>

	@include('layouts.subfooter')
	@include('layouts.footer')
	@yield('scripts')
	
	
</body>
</html>