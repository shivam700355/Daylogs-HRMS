@extends('../layout/header')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title p-2">Users</h4> 
                    </div>
                    {{-- <div class="col-4">
                        <a href="{{ route('users.create') }}" class="btn btn-primary ">Add User</a>
                    </div> --}}
                </div>
              {{-- <p class="card-description">
                Add class <code>.table-hover</code>
              </p> --}}
              <form class="forms-sample">
                <div class="form-group">
                  <label for="exampleInputUsername1">Name</label>
                  <input type="text"name="name" id="name" class="form-control" id="exampleInputUsername1" placeholder="name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mobile</label>
                  <input type="text" name="mobile" id="mobile" class="form-control" id="exampleInputEmail1" placeholder="Mobile">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Confirm Password</label>
                  <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">State</label>
                      <select class="form-control" id="exampleSelectGender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">District</label>
                      <select class="form-control" id="exampleSelectGender">
                        {{-- <option>Male</option>
                        <option>Female</option> --}}
                      </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Project</label>
                    <input type="text" class="form-control" id="exampleInputConfirmProject1" placeholder="Project">
                </div>
                {{-- <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div> --}}
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                {{-- <button class="btn btn-light">Cancel</button> --}}
              </form>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection