@extends('components.layout')


{{--header section--}}
@section('header')
    @includeIf('components.header')
@endsection

@section('content')
 @foreach($posts->posts as $post)
     <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
         <div class="col p-4 d-flex flex-column position-static">
             <strong class="d-inline-block mb-2 text-success">{{ $post->name }}</strong>
             <h5 class="mb-0">{{ $post->title }}</h5>
             <div class="mb-1 text-muted">{{ date('d M y',strtotime($post->created_at ))}}</div>
             <p class="mb-auto">{{ substr($post->content,0,120) }} ............</p>
             <a href="{{ route('post', $post->id) }}" class="stretched-link">Continue reading</a>
         </div>
         <div class="col-auto d-none d-lg-block">
             <img src="{{ asset('uploads/post/',$post->thumbnail) }}" alt="">
         </div>
     </div>
 @endforeach
@endsection
{{--sidebar section--}}
@section('sidebar')
    @includeIf('components.sidebar')
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection


