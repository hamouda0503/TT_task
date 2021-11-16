@extends('templates.outs.auth')

@section('content')
<br><br><br><br><br><br><br>
  <div class="special-form">
      <a href="{{ route('home') }}"><img src="{{ \App\Helpers\Helpers::logoUrl()  }}" alt=""></a>
      <hr color="white">
      <h3 class="text-center">LOGIN</h3>
      <hr color="white">
      @if ($errors->first())
          <span class="status-msg error-msg">{{ $errors->first() }}</span>
      @endif
      <hr>
    {!! Form::open(array('action' => 'UsersController@login')) !!}
        <div class="form-group">
            <label for="matricule" class="color-primary">Matricule:</label>
            {!! Form::text( 'matricule', null, array('class' => 'form-control', "placeholder" => "matricule","autofocus" => "true" )) !!}
        </div>
        <div class="form-group">
            <label for="password" class="color-primary">Password:</label>
            {!! Form::password( 'password', array('class' => 'form-control', "placeholder" => "Password" )) !!}
        </div>
        <div class="form-group">
            {!! Form::submit( 'Login', array('class' => 'btn btn-primary btn-wide')) !!}
        </div>
    {!! Form::close() !!}
    <p>Don't have an account? <a href="{{ route('register') }}"class="aa">register</a></p>
  </div>
  <br><br><br><br><br><br><br><br><br><br>

@stop