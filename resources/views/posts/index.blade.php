@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>
    <div class="card">
        <div class="card-header">Posts</div>

        <div class="card-body">
        @if($posts->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <!-- 
                        TODO: 
                     -->
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" width="128"></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>{{ $post->categoryDto->name }}</td>
                            <td>{{ $post->author_name }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm" onclick= "displayModalForm({{ $post->id }})"  data-toggle="modal" data-target="#deleteModal">Trash</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>No Posts to show!</h3>
        @endif
        </div>
        <div class="card-footer">
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trash Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div> 
                <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')               
                <div class="modal-body">                    
                    <p>
                        Are you sure you want to trash Post?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Trash Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
@endsection

@section('page-level-scripts')
    <script type="text/javascript">
        function displayModalForm($id){
            var url = '/trash/' + $id;
            $("#deleteForm").attr('action', url);
        }
    </script>
@endsection

