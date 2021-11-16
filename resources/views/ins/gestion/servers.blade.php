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

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Servers</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>name</th>
                      <th>description</th>
                      <th>cpu</th>
                      <th>os</th>
                      <th>os version</th>
                      <th>ram</th>
                      <th>stockage</th>
                      <th>nombre de partition</th>
                    

    

                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>name</th>
                      <th>description</th>
                      <th>cpu</th>
                      <th>os</th>
                      <th>os version</th>
                      <th>ram</th>
                      <th>stockage</th>
                      <th>nombre de partition</th>
                    
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($servers as $server)
                    <tr>
                    <td>{{ $server->name }}</td>
                    <td>{{ $server->description }}</td>
                    <td>{{ $server->cpu }}</td>
                    <td>{{ $server->os }}</td>
                    <td>{{ $server->os_ver }}</td>
                    <td>{{ $server->ram }}</td>
                    <td>{{ $server->stockage }}</td>
                    <td>{{ $server->nbr_partition }}</td>
             
                   
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>




                    <script>
        megaMenuInit();
    </script>
    <script src="{{ asset('assets/js/controllers/server.js') }}"></script>
            
@stop()