@extends('emails.layouts.master')

@section('title')
    You are now a member of the server {{ $server_name }}.
@stop

@section('content')
    You have been invited to {{ $server_name }} making you a new member of this server. As a new member you can create,
    delete, tasks and credentials.
    <br><br>
    <a style="text-decoration: none; background-color: #4e73df;color: #fff;border-radius: 4px;display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height:1.42857143;text-align: center;white-space: nowrap;" target="_blank" href="{{ $server_url }}">Go To Server</a>
@stop
