@include('partials/head')


<div class="side-nav">
	@include('partials/nav')			
	@include('partials/footer')
</div>

<div class="content-area">
	@yield('content')
	<link href="/vendor/confer/css/confer.css" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
@include('confer::confer')


<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>


@include('confer::js')
</div>

