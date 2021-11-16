<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('assets/img/logo5.png') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('assets/img/logo5.png') }}" type="image/x-icon">
	<!-- <link href="{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fonts.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
	<script src="https://kit.fontawesome.com/14f0e283a2.js" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.12/vue.js"></script>
	<script src="{{ asset('assets/js/ui.js') }}"></script>
	
	<link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


{!! Charts::styles() !!}
@if(Route::is('events.index') )

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 
 

<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
 

{!! $calendar_details->script() !!}
{!! $calendar_details_tasks->script() !!}
   
@endif








</head>
<body>
@include('analyticstracking')
<script>
	window.baseurl = '{{ route('home') }}'
</script>

<div id="sheet" class="animated"></div>
<div id="pop-up-prompt" class="animated">
	<header><h3 class="color-badge"></h3></header>
	<div>
		<p></p>
        <section>
            <span id="cancel-btn" class="btn"></span>
            <span id="confirm-btn" class="btn"></span>
        </section>
	</div>
</div>

