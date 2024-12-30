@extends('admin.template')

@section('title', 'Manage Menu')

@section('page-title', 'Manage Menu')

@section('content')
<div class="wrapper">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="card mb-4">
        <div class="card-body mb-5">
            <h3>{{ isset($menu) ? 'Edit Menu' : 'Add New Menu' }}</h3>
            <form action="{{ isset($menu) ? route('menus.update', $menu) : route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($menu))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Menu Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $menu->name ?? old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <!-- Options kategori bisa dinamis dari database -->
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (isset($menu) && $menu->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ $menu->description ?? old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @if(isset($menu) && $menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" width="170" class="mt-4">
                    @endif
                </div>
                <button type="submit" class="btn btn-success">{{ isset($menu) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
            <script>
                 document.getElementById('cancel-button').addEventListener('click', function () {
                document.getElementById('menu-id').value = '';
                document.getElementById('menu-form').action = "{{ isset($menu) ? route('menus.update', $menu) : route('menus.store') }}";
                document.getElementById('submit-button').textContent = 'Save';
                document.getElementById('form-title').textContent = 'Add New Menu';
                 this.style.display = 'none';
    });
            </script>
        </div>
    </div>
    <!-- Notification Success -->
    @if (session('success')) 
    <div class="alert fade show custom-alert-success" role="alert">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
   
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Menu List</h3>
        </div>
        <div class="card-body">
            <div class="table-resposnsive">
            <!-- Table for Menus -->
            <table class="table table-hover shadow-sm">
                <thead>
                    <tr> 
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>{{ $menu->category->name }}</td>
                        <td>
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="150">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('menus.edit', $menu) }}" class="btn btn-warning btn-sm edit-button" 
                                    data-id="{{ $menu->id }}" 
                                    data-name="{{ $menu->name }}" 
                                    data-description="{{ $menu->description }}" 
                                    data-category="{{ $menu->category }}">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center border" colspan="5"> <strong>Tidak ada Menu</strong></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <script>
    // JavaScript to handle edit form population
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function () {
            // Set form action and fields
            const id = this.getAttribute(' data-id');
            const name = this.getAttribute('data-name');
            const description = this.getAttribute('data-description');
            const category = this.getAttribute('data-category');

            document.getElementById('menu-id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('category').value = category;

            document.getElementById('menu-form').action = "{{ route('menus.update', '') }}/" + id;
            document.getElementById('submit-button').textContent = 'Update';
            document.getElementById('form-title').textContent = 'Edit Menu';
            document.getElementById('cancel-button').style.display = 'inline-block';
        });
    });

    // Reset form on cancel
    // document.getElementById('cancel-button').addEventListener('click', function () {
    //     document.getElementById('menu-id').value = '';
    //     document.getElementById('menu-form').action = "{{ route('menus.store') }}";
    //     document.getElementById('submit-button').textContent = 'Save';
    //     document.getElementById('form-title').textContent = 'Add New Menu';
    //     this.style.display = 'none';
    // });
</script>    
</div>
@endsection
