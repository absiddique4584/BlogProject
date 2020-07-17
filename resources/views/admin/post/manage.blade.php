

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
               <div  class="col-sm-6">
                   <h3>Manage Posts</h3></div>
                   <div  class="col-sm-3"></div>
                   <div  class="col-sm-3">
                   <a  style="color: #fff;" href="{{ route('posts.create') }}" class="btn btn-info">New Post</a>
                   </div>
           </div>

       </div>
       <div class="card-body">
          <table class="table table-bordered">
              <tr>
                  <th>SI No</th>
                  <th>Category</th>
                  <th>Username</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              @foreach($posts as $post)
              <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->category->name }}</td>
                  <td>{{ $post->user->name }}</td>
                  <td>{{ $post->title }}</td>
                  <td style="color: {{ $post->status === 'draft' ? 'red':'green' }};">{{ $post->status === 'draft' ? 'draft':'published' }}</td>
                  <td>
                      <a href="{{ route('posts.edit', [$post->id]) }}">Edit</a>
                      <form method="POST" action="{{ route('posts.delete', $post->id) }}" onclick="return confirm('Are you sure to delete it ?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </td>
              </tr>
              @endforeach

          </table>
           {{ $posts->links() }}
           <p>Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} out-of {{ $posts->total() }} Posts</p>
       </div>
   </div><br><br><br><br>
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection




