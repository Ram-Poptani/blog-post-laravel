@extends('layouts.app')

{{-- {{ dd($categories[1]) }} --}}
@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>
    <div class="card">
        <div class="card-header">Categories</div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>name</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="displayModalForm({{ $category->id }})" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete category?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Category</button>
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
            var url = '/categories/' + $id;
            $("#deleteForm").attr('action', url);
        }
    </script>
@endsection

