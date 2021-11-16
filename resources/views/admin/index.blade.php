@extends('templates/ins/master')

@section('content')

<div class="row">
  <div class="col-xs-12">
    <h1>Admin</h1>
    <!-- <p>Number of users: <span class="badge">{{ $n_users  }}</span></p>
            <p>Number of platforms: <span class="badge">{{ $n_platforms  }}</span></p>
            <p>Number of servers: <span class="badge">{{ $n_servers  }}</span></p>
            <p>Number of tasks: <span class="badge">{{ $n_tasks  }}</span></p> -->



    <div class="col-xl-3 col-md-6 mb -4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of users: </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $n_users  }}</div>
              <!-- <button onclick="myFunction()">Click Me</button> -->
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of platforms:</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $n_platforms  }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number of servers:</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $n_servers  }}</div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number of tasks:</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $n_tasks  }}</div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<!-- ---------------------------------------- -->
<!-- <div class="card shadow mb-4" id="s">
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
            <th>Title</th>



          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Title</th>

          </tr>
        </tfoot>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{ $user->full_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->title }}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div> -->
<!-- ---------------------------------------- -->
<!-- Button trigger modal -->




</div>


<script>
  megaMenuInit();
</script>
<script src="{{ asset('assets/js/controllers/user.js') }}"></script>
<script>
  function myFunction() {
    var x = document.getElementById("s");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>

@stop()