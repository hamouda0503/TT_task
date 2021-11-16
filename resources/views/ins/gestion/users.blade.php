@extends('templates/ins/master')

@section('content')
<!-- <button onclick="myFunction()">Click Me</button> -->
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
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>phone</th>
                      <th>Title</th>
                      <th>bio</th>
                      <th>matricule</th>
                      <th>role</th>
    

                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Full Name</th>
                      <th>Email</th>
                      <th>phone</th>
                      <th>Title</th>
                      <th>bio</th>
                      <th>matricule</th>
                      <th>role</th>

                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->title }}</td>
                    <td>{{ $user->bio }}</td>
                    <td>{{ $user->matricule }}</td>
                    @if (($user->role == env('ADMIN_P') ) ) 
                    <td>Admin primaire</td>
                    @else
                    <td>Admin secondaire</td>
                    @endif
                   
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

    <!-- <script> function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}</script> -->
            
@stop()