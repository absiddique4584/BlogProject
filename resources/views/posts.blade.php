
@extends('components.layout')


{{--header section--}}
@section('header')
    @includeIf('components.header')
@endsection

{{--content section--}}
@section('content')
   @foreach($posts as $post)
       <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
           <div class="col p-4 d-flex flex-column position-static">
               <strong class="d-inline-block mb-2 text-success">{{ $post->category->name }}</strong>
               <h3 class="mb-0">{{ $post->title }}</h3>
               <div class="mb-1 text-muted">{{ $post->created_at->format('F d Y') }}</div>
               <p class="mb-auto">{!! substr($post->content,0,120) !!}......... </p>
               <a href="#" class="stretched-link">Continue reading</a>
           </div>
           <div class="col-auto d-none d-lg-block">
               <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
           </div>
       </div>
   @endforeach
    {{ $posts->links() }}
@endsection

{{--sidebar section--}}
@section('sidebar')
    @includeIf('components.sidebar')
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection

