@extends('templates/ins/master')

@section('content')
<div class="row" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
  <div class="col-xs-12 page-title-section">
    <h1 class="pull-left">Hud</h1>
  </div>
</div>

<div id="hud" class="row">
  <!-- <div class="col-xs-12 col-sm-4">
            <div class="jumbotron text-center">
                <p class="dim">Platforms</p>
                <h1>@{{ platforms }}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="jumbotron text-center">
                <p class="dim">Servers</p>
                <h1>@{{ servers.length }}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="jumbotron text-center">
                <p class="dim">Tasks</p>
                <h1>@{{ tasks }}</h1>
            </div>
        </div> -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">  Platforms</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{ platforms }}</div>
          </div>
          <div class="col-auto">
            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
            <i class="fas fa-network-wired fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Servers</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{ servers.length }}</div>
          </div>
          <div class="col-auto">
            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
            <i class="fas fa-server fa-2x text-gray-300 "></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">shared Servers</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{  sharedServers.length }}</div>
          </div>
          <div class="col-auto">
            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
            <i class="fas fa-server fa-2x text-gray-300 "></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{ tasks }}</div>
          </div>
          <div class="col-auto">
            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
            <i class="fas fa-tasks fa-2x text-gray-300 "></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">@{{ tasks }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-tasks fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  @if ((Auth::user()->matricule == env('ADMIN_MAT') ) ) 

  <div class="col-xs-6">
    <div class="server-list-container">
      <template v-if="servers.length > 0">
        <h4>My Servers</h4>
        <input placeholder="Search servers" type="text" class="form-control" v-model="my_server_text">
        <hr>
        <table class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="server in servers | filterBy my_server_text">
              <td>@{{ $index + 1 }}</td>
              <td><a href="{{ route('servers.show', ['id' => '']) }}/@{{ server.id }}">@{{ server.name }}</a></td>
              <td>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:@{{ server.completedWeight / server.totalWeight * 100 }}%;">
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </template>

      <template v-if="servers.length == 0">
        <p class="alert alert-warning">
          Your servers will be listed here once you create some.
          Create a new server within the <a href="{{ route('platforms') }}">platforms</a> page.
        </p>
      </template>
    </div>
  </div>
@endif
  <div class="col-xs-6">
    <div class="server-list-container">
      <template v-if="sharedServers.length > 0">
        <h4>Servers Shared With Me</h4>
        <input placeholder="Search servers" type="text" class="form-control" v-model="my_sserver_text">
        <hr>
        <table class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="server in sharedServers | filterBy my_sserver_text">
              <td>@{{ $index + 1 }}</td>
              <td><a href="{{ route('servers.show', ['id' => '']) }}/@{{ server.id }}">@{{ server.name }}</a></td>
              <td>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:@{{ server.completedWeight / server.totalWeight * 100 }}%;">
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </template>

      <template v-if="sharedServers.length == 0">
        <p class="alert alert-warning">
          Servers that you have been invited to will show up here. Currently
          you have not been invited to any server.
        </p>
      </template>
    </div>
  </div>

</div>
<div class="col-xs-6">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Statistiques</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                    {!! $chart1->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $chart1->script() !!}
</div>



<div id="platform" class="popup-form new-platform">
  <header>
    <p class="pull-left">New Platform</p>
    <div class="actions pull-right">
      <i title="Minimze " class="ion-minus-round"></i>
      <i title="Close" class="ion-close-round"></i>
    </div>
    <div class="clearfix"></div>
  </header>
  <section>
    <form>
      <span class="status-msg"></span>
      <input v-model="platform.name" placeholder="Platform Name" type="text" class="form-control">
      <input v-model="platform.description" placeholder="Description" type="text" class="form-control">

    </form>
  </section>
  
  <footer>
    <a v-on:click="create(platform)" href="" class="btn btn-primary pull-right">Save</a>
    <div class="clearfix"></div>
  </footer>
</div>
<script src="{{ asset('assets/js/controllers/hud.js') }}"></script>

@stop()