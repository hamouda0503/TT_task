@extends('templates.outs.auth')

@section('content')

    <div class="special-form">
        <a href="{{ route('home') }}"><img src="{{ \App\Helpers\Helpers::logoUrl()  }}" alt=""></a>
        <hr color="white">
        <h3 class="text-center">REGISTER</h3>
        <hr color="white">
        @if ($errors->first())
            <span class="status-msg error-msg">{{ $errors->first() }}</span>
        @endif
        <hr>
        {!! Form::open(array('action' => 'UsersController@register')) !!}
        <div class="form-group">
            <label for="fullName" class="color-primary">Full Name:</label>
            {!! Form::text('fullName', null, array('class' => 'form-control', "placeholder" => "Full name", "autofocus" => "true" )) !!}
        </div>
        <div class="form-group">
            <label for="email" class="color-primary">Email:</label>
            {!! Form::text('email', null, array('class' => 'form-control', "placeholder" => "Email" )) !!}
        </div>
        <div class="form-group">
            <label for="matricule" class="color-primary">matricule:</label>
            {!! Form::text('matricule', null, array('class' => 'form-control', "placeholder" => "matricule" )) !!}
        </div>
        <div class="form-group">
            <label for="password" class="color-primary">Password:</label>
            {!! Form::password('password', array('class' => 'form-control', "placeholder" => "Password" )) !!}
        </div>
        <div class="form-group">
            <label for="phone" class="color-primary">phone number:</label>
            {!! Form::text('phone',  null, array('class' => 'form-control', "placeholder" => "phone" )) !!}
        </div>
        <div class="form-group">
            <label for="role" class="color-primary"> role :</label>
            <!-- {!! Form::text('role', null, array('class' => 'form-control', "placeholder" => "role" )) !!} -->
            {!! Form::select('role', [ 'adp' => 'admin primaire', 'ads' => 'admin secondaire' ], 1, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Register', array('class' => 'btn btn-primary btn-wide' )) !!}
        </div>
        {!! Form::close() !!}
        <p>Have an account? <a href="{{ route('login') }}" class="aa">login</a></p>
    </div>

@stop


