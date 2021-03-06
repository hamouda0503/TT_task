@extends('templates/ins/master')

@section('content')
    <div class="row" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="col-xs-12 page-title-section">
            <h1 class="pull-left">Servers</h1>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default panel-list animated fadeIn">
                <div class="panel-heading">Servers</div>
                <div class="panel-body">
                    @foreach ($servers as $server)
                        <?php $counter++; ?>
                        <a class="with-number"  href="/servers/{{ $server->id }}">
                            <span class="dim"><?php echo $counter; ?>.</span> {{ $server->name }}
                            <span class="weight pull-right">w.{{$server->weight}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop()