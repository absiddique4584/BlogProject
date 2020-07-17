

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
                    <h3>Add Post</h3></div>
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
            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" id="title" placeholder="Post Title">
                </div>


                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">select category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="post_content"></textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Image</label>
                    <input type="file" name="thumbnail"id="thumbnail">
                </div>


                <div class="form-group">
                    <label for="category">Status</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>

                </div>
                <button type="submit" class="btn btn-primary">Add Post</button>
            </form>
        </div>
    </div><br><br><br><br>
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection





