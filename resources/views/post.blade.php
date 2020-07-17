@extends('components.layout')


{{--header section--}}
@section('header')
    @includeIf('components.header')
@endsection

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ date('d M y',strtotime($post->created_at ))}} by <a href="#">Mark</a></p>
            {!!  $post->content  !!}

@endsection
{{--sidebar section--}}
@section('sidebar')
    @includeIf('components.sidebar')
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection

