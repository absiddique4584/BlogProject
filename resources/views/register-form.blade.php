

@extends('components.layout')


{{--header section--}}
@section('header')
    @includeIf('components.header')
@endsection

@section('content')

@includeIf('message.message')


  <div class="card">
      <div class="card-body">
          <div class="card-header">
              <h3>Registration Form</h3>
          </div>
          <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Name" required>
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Email Address" required>
              </div>
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control"  id="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                  <label for="cpassword">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control"  id="cpassword" placeholder="Confirm Password" required>
              </div>
              <div class="form-group">
                  <label for="profile">Profile Picture</label>
                  <input type="file" name="image" class="form-control"  id="profile" required>
              </div>

              <button type="submit" class="btn btn-primary">Register</button>
          </form>
      </div>
  </div>
  <br>
@endsection
{{--sidebar section--}}
@section('sidebar')
    @includeIf('components.sidebar')
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection

