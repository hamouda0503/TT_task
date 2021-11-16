@extends('templates/ins/master')

@section('content')

<div id="server" style="background-color:#fafafa ">
    <div class="row" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="col-xs-12 page-title-section">
            <h1 class="pull-left">@{{ server.name }}
                @if ((Auth::user()->matricule == env('ADMIN_MAT') ) or (Auth::user()->role == env('ADMIN_P') ))
                <a v-on:click="startServerEditMode()" class="show-on-hover btn btn-default" title="Edit Server"><i class="ion-edit"></i></a>
                @endif
            </h1>
            <div class="clearfix"></div>
            <div v-if="server.description != '' " class="col-sm-12 col-md-6 no-side-padding">
                <p><span class="dim">Description:</span> @{{ server.description }}</p>
            </div>
            <div class="col-sm-12 col-md-6 no-side-padding">
                <a v-if="server.cpu != '' " href="@{{ server.cpu }} " target="_blank" class="pull-right"><span class="label label-default"> cpu : @{{ server.cpu }}</span></a>
                <a v-if="server.os != '' " href="@{{ server.os }}" target="_blank" class="pull-right"><span class="label label-default"> os : @{{ server.os }}</span></a>
                <a v-if="server.os_ver != '' " href="@{{ server.os_ver }}" target="_blank" class="pull-right"><span class="label label-default"> os_ver : @{{ server.os_ver }}</span></a>
                <a v-if="server.ram != '' " href="@{{ server.ram }} " target="_blank" class="pull-right"><span class="label label-default"> ram : @{{ server.ram }}</span></a>
                <a v-if="server.stockage != '' " href="@{{ server.stockage }}" target="_blank" class="pull-right"><span class="label label-default"> stockage : @{{ server.stockage }}</span></a>
                <a v-if="server.nbr_partition != '' " href="@{{ server.nbr_partition }}" target="_blank" class="pull-right"><span class="label label-default"> nbr_partition : @{{ server.nbr_partition }}</span></a>

            </div>
            <div class="clearfix"></div>
            <p>
                <hr>
                <span class="dim">Progress</span>
                <span>
                    <span class="dim">| Low</span> <span class="priority-circle priority-low"></span>
                    <span class="dim">Normal</span> <span class="priority-circle priority-normal"></span>
                    <span class="dim">Medium</span> <span class="priority-circle priority-medium"></span>
                    <span class="dim">High</span> <span class="priority-circle priority-high"></span>
                    <span class="dim">Highest</span> <span class="priority-circle priority-highest"></span>
                </span>
            </p>

            <div class="col-xs-11 no-padding-left">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:@{{ serverProgress }}%">
                    </div>
                </div>
            </div>
            <div class="col-xs-1 no-margin-right">
                <!-- <div class="pull-right"><span class="weight">w.@{{ serverWeight }}</span></div>
                <div class="clearfix"></div> -->
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col-xs-12">
            <div class="main-section">
                @if (Auth::user()->matricule == env('ADMIN_MAT') or Auth::user()->role == env('ADMIN_P') )
                <div class="pull-right">

                    <button v-on:click="showTaskCreateForm()" style="position: relative; z-index: 10" class="btn btn-primary"><span class="ion-plus-circled"></span> New Task</button>
                </div>
                @endif
<!-- Donut Chart -->

              <!-- <div class="card shadow mb-4">
              
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                </div>
              
                <div class="card-body">
                  <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <hr>
                  Styling for the donut chart can be found in the <code>/js/demo/chart-pie-demo.js</code> file.
                </div>
              </div>
         -->

                <script>
    

                </script>
                <div class="mega-menu mega-menu-tab">
                    <div class="links">
                        <a data-id="tab_tasks" href="">Tasks (@{{ numTasks }})</a>

                        <a data-id="tab_daily" href="">Daily (@{{ numDailyTasks }})</a>
                        @if ((Auth::user()->matricule == env('ADMIN_MAT') ) or (Auth::user()->role == env('ADMIN_P') ))
                        <a data-id="tab_credentials" href="">Credentials (@{{ numCredentials }})</a>
                        <a data-id="tab_members" href="">Members</a>
                        @endif
                    </div>
                    <div class="content">
                        <div class="item" id="tab_tasks">
                            @include('ins.servers.partials.tasks')
                        </div>
                        <div class="item" id="tab_daily">
                            @include('ins.servers.partials.daily')
                        </div>
                        <div class="item" id="tab_credentials">
                            @include('ins.servers.partials.credentials')
                        </div>
                        <div class="item" id="tab_members">
                            @include('ins.servers.partials.members')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>









    @include('ins.servers.partials.forms')

    <script>
        megaMenuInit();
    </script>
</div>

<script src="{{ asset('assets/js/controllers/server.js') }}"></script>



</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<!-- Page level custom scripts -->

<script src="{{ asset('assets/js/controllers/chart-pie-demo.js') }}"></script>

@stop()