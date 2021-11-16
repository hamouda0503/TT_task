

<a href="{{ route('home') }}" class="logo-section " >
	<img src="{{\App\Helpers\Helpers::logoUrl()}}" alt="TT">
</a>
<hr>
<div class="user-section">
	<a href="{{ route('profile') }}"><img class="circle" src="{{ App\User::get_gravatar(Auth::user()->matricule) }}">
	<p>{{Auth::user()->full_name}}</p>
	</a>
</div>
<hr>

{!! Form::open(array('action' => 'HomeController@search','method' => 'get')) !!}
	<div class="form-group search" style="color: #f6c23e;">
		{!! Form::text( 'q', null, array('class' => 'form-control search-bar', "placeholder" => "Search")) !!}
	</div>	    			
{!! Form::close() !!}	
<hr>
<div class="menu" >
	<a class="<?php echo ( Request::is('hud') ) ? 'active' : 'false'; ?> <?php echo ( Request::is('/') ) ? 'active' : 'false'; ?>" href="{{ route('home') }}"><i class="icon ion-ios-home"></i> Hud</a>
	
	@if (Auth::user()->matricule == env('ADMIN_MAT')) 
	<a class="<?php echo ( Request::is('platforms') ) ? 'active' : 'false'; ?>" href="{{ route('platforms') }}"><i class="fas fa-network-wired"></i> Gestion des CIs</a>

	<hr></hr>
	
	<a class="<?php echo ( Request::is('vusers') ) ? 'active' : 'false'; ?>" href="{{ route('vusers') }}"><i class="far fa-user"></i> Users</a>
	<a class="<?php echo ( Request::is('vplatforms') ) ? 'active' : 'false'; ?>" href="{{ route('vplatforms') }}"><i class="fas fa-network-wired"></i> Platforms</a>
	<a class="<?php echo ( Request::is('vservers') ) ? 'active' : 'false'; ?>" href="{{ route('vservers') }}"><i class="fas fa-server "></i> Servers</a>
	<a class="<?php echo ( Request::is('vtasks') ) ? 'active' : 'false'; ?>" href="{{ route('vtasks') }}"><i class="fas fa-tasks  "></i> Tasks</a>
	
	<hr></hr>
	   
	@endif
	
	<a class="<?php echo ( Request::is('events.index') ) ? 'active' : 'false'; ?>" href="{{ route('events.index') }}"><i class="far fa-calendar"></i>Calender</a>
	<a class="<?php echo ( Request::is('profile') ) ? 'active' : 'false'; ?>" href="{{ route('profile') }}"><i class="icon ion-gear-b"></i> Settings</a>
	<a href="{{ route('logout') }}"><i class="icon ion-android-exit"></i> Logout</a>
</div>

<div class="line"><hr></div>
