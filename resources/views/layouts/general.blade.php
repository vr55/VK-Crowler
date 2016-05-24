<!DOCTYPE html>
<html lang="ru" class="">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('title')</title>

	<script type="text/javascript" src="//yastatic.net/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="//yastatic.net/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="//yastatic.net/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">


	<link href="{{ asset('css/view.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

@include('layouts.nav')

<div class="container">

<div class="row">
	<div class="col-md-3">
		@yield('aside')
	</div>
	<div class="col-md-9">
	<div class="row">
	@yield('content')
	</div>
	</div>
</div>


</div>
<div class="footer navbar-fixed-bottom" style="height:25px">
	footer
</div>
</body>

</html>
