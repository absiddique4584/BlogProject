

@extends('components.layout')


{{--header section--}}
@section('header')
    @includeIf('admin.header')
@endsection

@section('content')

    @includeIf('message.message')

   <h1>Home Page</h1>
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection



