@extends('admin.template')

@section('title', 'Manage Categories')

@section('page-title', 'Manage Categories')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Category Management
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="card-body">
        <div class="row">
            <!-- Form Section -->
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h4 id="form-title" class="text-center text-secondary">Add New Category</h4>
                    <form id="category-form" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="category-id" value="">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button type="reset" class="btn btn-secondary " id="cancel-button" style="display: none;">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Section -->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table  table-hover shadow-sm">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                <button class="btn btn-warning btn-sm edit-button" 
                                        data-id="{{ $category->id }}" 
                                        data-name="{{ $category->name }}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to handle edit form population
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            document.getElementById('category-id').value = id;
            document.getElementById('name').value = name;

            document.getElementById('category-form').action = "{{ route('categories.store') }}";
            document.getElementById('submit-button').textContent = 'Update';
            document.getElementById('form-title').textContent = 'Edit Category';
            document.getElementById('cancel-button').style.display = 'inline-block';
        });
    });

    // Reset form on cancel
    document.getElementById('cancel-button').addEventListener('click', function () {
        document.getElementById('category-id').value = '';
        document.getElementById('name').value = '';
        document.getElementById('submit-button').textContent = 'Save';
        document.getElementById('form-title').textContent = 'Add New Category';
        this.style.display = 'none';
    });
</script>
@endsection
