

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
                    <h3>Add Category</h3></div>
                <div  class="col-sm-4"></div>
                <div  class="col-sm-4">
                    <a  style="color: #fff;" href="{{ route('categories.index') }}" class="btn btn-info">Manage Category</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-header">
                <h3>Add Category Form</h3>
            </div>
            <form method="post" action="{{ route('categories.store') }}">
                @csrf

                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="category" placeholder="Category">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status" value="1">
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="0">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div><br><br><br><br>
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection





