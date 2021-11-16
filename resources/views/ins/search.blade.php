@extends('templates/ins/master')

@section('content')
	<div class="row">
		<div class="col-xs-12 page-title-section">
			<h1 class="pull-left">Search</h1>
		</div>
		<div class="col-xs-12">
			<strong class="color-primary">
				{{ count($platforms) + count($servers) + count($tasks) }}
			</strong>Results for: "<strong class="color-primary"><i>{{ $q }}</i></strong>"</h4><br><br>
		</div>
	</div>

	<div class="row">

		<div class="col-xs-12">
			{{-- platforms --}}
			<div class="panel panel-default panel-list">
			  <div class="panel-heading">Platforms ({{count($platforms)}})</div>
			  <div class="panel-body">
			  	@if (count($platforms) > 0)
				  	@foreach ($platforms as $platform)
				  		<a href="{{ route('platforms', ['id' => $platform->id]) }}">
				  			{{ $platform->name }}
				  		</a>
				  	@endforeach			  			  	
				@else
				    <section class="info">
						<p class="dimmed">Sorry I couldn't find nothing....</p>	
				    </section>
			  	@endif
			  </div>
			</div>			

			{{-- servers --}}
			<div class="panel panel-default panel-list">
			  <div class="panel-heading">Servers ({{count($servers)}})</div>
			  <div class="panel-body">
			  	@if (count($servers) > 0)
				  	@foreach ($servers as $server)
				  		<a href="{{ route('servers.show', ['id' => $server->id]) }}">
				  			{{ $server->name }}
				  			<span class="weight pull-right">w.{{ $server->totalWeight()}}</span>
				  		</a>
				  	@endforeach			  			  	
				@else
				    <section class="info">
						<p class="dimmed">Sorry I couldn't find nothing....</p>	
				    </section>
			  	@endif
			  </div>
			</div>

			{{-- tasks --}}
			<div class="panel panel-default panel-list">
			  <div class="panel-heading">Tasks ({{count($tasks)}})</div>
			  <div class="panel-body">
			  	@if (count($tasks) > 0)
				  	@foreach ($tasks as $task)
				  		<a href="{{ route('servers.show', ['id' => $task->server_id]) }}">
				  			{{ $task->name }}
				  			<span class="weight pull-right">w.{{ $task->weight}}</span>
				  		</a>
				  	@endforeach			  			  	
				@else
					  <section class="info">
						  <p class="dimmed">Sorry I couldn't find nothing....</p>
					  </section>
			  	@endif
			  </div>
			</div>			
	
		</div>
	</div>

@stop()