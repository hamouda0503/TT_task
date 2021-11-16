@extends('templates.outs.home')

@section('content')
    {{-- HEADER--}}
	<div class="hug hug-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ route('home') }}" class="pull-left"><img src="{{ \App\Helpers\Helpers::logoUrl() }}" alt="tt"></a>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-line pull-right login"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-line pull-right register"><i class="fas fa-user-plus"></i> Register</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
	</div>

    {{-- HEREO SECTION --}}
    <div class="hug hug-hero">
        <div class="container">
            <div class="row">
                <div class="col-xs-10">
                    <div class="left-side">
                        <!-- <h1> </h1> -->
                        <br><br><br>
                        <!-- <h2> Platform management system.</h2>
                        <a href="{{ route('register') }}" class="btn btn-special">GET STARTED</a> -->
                    </div>
                    <center>
                    <div class="">
                        <img class="mascot" src="{{ asset('assets/img/mascot_left.png')  }}" alt="">
                        <br><br>
                        <h2> Platform management system.</h2>
                        <a href="{{ route('register') }}" class="btn btn-special">GET STARTED</a>
                    </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="hug hug-footer">
        <div class="container">
           
                <div class="col-xs-10">
                   
                    <p class="text-center last-line">Copyright {{ date("Y") }} &copy;  <a href="#" target="_blank">Tunisie Telecom</a></p>
                </div>
           
        </div>
    </div> 

@stop