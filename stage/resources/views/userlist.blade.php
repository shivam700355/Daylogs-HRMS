{{-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User List</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2>User List</h2>
  <div class="table-responsive">
    <table class="table table-hover" id="userTable">
      <thead>
        <tr>
          <th>User</th>
          <th>Product</th>
          <th>Sale</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <script>
    // Fetch data from the API endpoint
    fetch('https://daylogs.in/APIs/employee/user.php')
      .then(response => response.json())
      .then(data => {
        // Check if the response contains user data
        if (data.code === 200 && data.data) {
          // Get the table body element
          var tbody = document.querySelector('#userTable tbody');

          // Loop through the user data and create table rows
          data.data.forEach(user => {
            var row = document.createElement('tr');
            row.innerHTML = `
              <td>${user.id}</td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.contact}</td>
            `;
            tbody.appendChild(row);
          });
        } else {
          // Handle error or empty response
          console.error('Error: Unable to fetch user data');
        }
      })
      .catch(error => {
        // Handle network error
        console.error('Network error:', error);
      });
  </script>
</body>

</html> --}}


@extends('../layout/header')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title p-2">Users</h4> 
                    </div>
                    <div class="col-2">
                        <a href="{{ route('users.create') }}" class="btn btn-primary ">Add User</a>
                    </div>
                </div>
              <p class="card-description">
                Add class <code>.table-hover</code>
              </p>
              <div class="table-responsive">
                <table class="table table-hover" id="userTable">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
<script>
    // Fetch data from the API endpoint
    fetch('https://daylogs.in/APIs/employee/user.php')
      .then(response => response.json())
      .then(data => {
        // Check if the response contains user data
        if (data.code === 200 && data.data) {
          // Get the table body element
          var tbody = document.querySelector('#userTable tbody');

          // Loop through the user data and create table rows
          data.data.forEach(user => {
            var row = document.createElement('tr');
            row.innerHTML = `
              <td>${user.id}</td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.contact}</td>
            `;
            tbody.appendChild(row);
          });
        } else {
          // Handle error or empty response
          console.error('Error: Unable to fetch user data');
        }
      })
      .catch(error => {
        // Handle network error
        console.error('Network error:', error);
      });
  </script>