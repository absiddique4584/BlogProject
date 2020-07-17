

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
                <h3>User Login Form</h3>
            </div>
            <form method="post" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control"  id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
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


