@extends('admin.template')

@section('title', 'Recipes')

@section('page-title', 'Manage Recipe')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recipe Management</h3>
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
    
        <div class="row">
            <!-- Form Create/Edit -->
            <div class="col-md-4">
                <div class="card card-body">
                    <h3 id="form-title">Add Recipe</h3>
                    <form action="{{ route('recipes.store') }}" method="POST" id="recipe-form">
                        @csrf
                        <input type="hidden" name="id" id="recipe-id">
                        <div class="form-group">
                            <label for="menu_model_id">Menu</label>
                            <select id="menu_model_id" name="menu_model_id" class="form-control" required>
                                <option value="">-- Select Menu --</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ingredients">Ingredients</label>
                            <textarea id="ingredients" name="ingredients" class="form-control" placeholder="Enter Ingredients Menu" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="instructions">Instructions</label>
                            <textarea id="instructions" name="instructions" class="form-control" placeholder="Enter Instructions" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button type="reset" class="btn btn-secondary " id="cancel-button" style="display: none;">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </form>
                </div>
            </div>

            <!-- List Recipes -->
            <div class="col-md-8">
                <div class="card card-body ">
                    <div class="table-responsive">
                    <table class="table table-bordered  table-hover shadow-sm">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Ingredients</th>
                                <th>Instructions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recipes as $recipe)
                                <tr>
                                    <td>{{ $recipe->menu?->name ?? 'Menu not available' }}
                                    </td>
                                    <td>{{ $recipe->ingredients }}</td>
                                    <td>{{ $recipe->instructions }}</td>
                                    <td>
                                        <button 
                                            class="btn btn-warning btn-sm edit-button mb-1" 
                                            data-id="{{ $recipe->id }}" 
                                            data-menu-id="{{ $recipe->menu_model_id }}" 
                                            data-ingredients="{{ $recipe->ingredients }}" 
                                            data-instructions="{{ $recipe->instructions }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No recipes available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle edit button
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const menuId = this.getAttribute('data-menu-id');
            const ingredients = this.getAttribute('data-ingredients');
            const instructions = this.getAttribute('data-instructions');

            document.getElementById('recipe-id').value = id;
            document.getElementById('menu_model_id').value = menuId;
            document.getElementById('ingredients').value = ingredients;
            document.getElementById('instructions').value = instructions;
            document.getElementById('cancel-button').style.display = 'inline-block';
            document.getElementById('form-title').textContent = 'Edit Recipe';
        });
    });

    // Handle cancel button
    document.getElementById('cancel-button').addEventListener('click', function() {
        document.getElementById('recipe-id').value = '';
        document.getElementById('menu_id').value = '';
        document.getElementById('ingredients').value = '';
        document.getElementById('instructions').value = '';

        document.getElementById('form-title').textContent = 'Add Recipe';
    });
</script>
@endsection
