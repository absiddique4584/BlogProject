

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
                   <h3>Manage Categories</h3></div>
                   <div  class="col-sm-3"></div>
                   <div  class="col-sm-3">
                   <a  style="color: #fff;" href="{{ route('categories.create') }}" class="btn btn-info">New Category</a>
                   </div>
           </div>

       </div>
       <div class="card-body">
          <table class="table table-bordered">
              <tr>
                  <th>Si No</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              @foreach($categories as $category)
              <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td style="color: {{ $category->status === 1 ? 'green':'red' }};">{{ $category->status === 1 ? 'Active':'Inactive' }}</td>
                  <td>
                      <a href="{{ route('categories.edit', [$category->slug, $category->id]) }}">Edit</a>
                      <form method="POST" action="{{ route('categories.delete', $category->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </td>
              </tr>
              @endforeach

          </table>
           {{ $categories->links() }}
           <p>Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} out-of {{ $categories->total() }} categories</p>
       </div>
   </div><br><br><br><br>
@endsection

{{--footer section--}}
@section('footer')
    @includeIf('components.footer')
@endsection




