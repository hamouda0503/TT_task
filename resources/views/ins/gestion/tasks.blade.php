@extends('templates/ins/master')

@section('content')

<!-- <table class="table table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table> -->
           
            <div class="card shadow mb-4" id="server">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>name</th>
                      <th>state</th>
                      <th>description</th>
                      <th>priority</th>
                      <th>weight</th>
                      <!-- <th>weight</th> -->

    

                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>name</th>
                      <th>state</th>
                      <th>description</th>
                      <th>priority</th>
                      <th>weight</th>
                      <!-- <th>weight</th> -->
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($tasks as $task)
                    <tr>
                  
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->state }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->weight }}</td>
                    <!-- <td><button v-on:click="editMode(task)" v-for="task in server.tasks | filterBy 'progress' in 'state' " class="task-@{{ task.id }}" >edit</button></td> -->
                
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            
          </div>
          


          @include('ins.servers.partials.forms')
                    <script>
        megaMenuInit();
    </script>
    <script src="{{ asset('assets/js/controllers/server.js') }}"></script>
            
@stop()