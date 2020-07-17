

@extends('components.layout')


{{--header section--}}
@section('header')
    @includeIf('admin.header')
@endsection

@section('content')

    @includeIf('message.message')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div  class="col-sm-4">
                    <h3>Update Posts</h3></div>
                <div  class="col-sm-4"></div>
                <div  class="col-sm-4">
                    <a  style="color: #fff;" href="{{ route('posts.index') }}" class="btn btn-info">Manage Post</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-header">
                <h3>Add Post Form</h3>
            </div>
            <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" id="title" >
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">select category</option>
                        @foreach($categories as $category)
                            <option {{ $category->id == $post->category_id ? 'selected':'' }} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="post_content">{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Image</label>
                    <input type="file" name="thumbnail"id="thumbnail">
                    <img style="width: 50px; height: auto;" src="{{ asset('uploads/posts/'.$post->thumbnail) }}"/>
                </div>


                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{ $post->status=='published' ? 'selected':'' }} value="published">Published</option>
                        <option {{ $post->status=='draft' ? 'selected':'' }} value="draft">Draft</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div><br><br><br><br>
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection






