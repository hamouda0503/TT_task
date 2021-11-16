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
              <h6 class="m-0 font-weight-bold text-primary">Platforms</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                    <th>name</th>
                      <th>description</th>
              
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>name</th>
                      <th>description</th>
              
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($platforms as $platform)
                    <tr>
                    <td>{{ $platform->name }}</td>
                    <td>{{ $platform->description }}</td>
                  
                   
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
    <script src="{{ asset('assets/js/controllers/user.js') }}"></script>
            
@stop()