@extends('user.template')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Daftar Menu {{ ucfirst($categoryName) }}</h1>
    <div class="row justify-content-center mt-4">
        {{-- Menampilkan daftar menu --}}
        @forelse ($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="solution_card">
                    <div class="hover_color_bubble"></div>
                    <div class="so_top_icon">
                        {{-- Gambar menu --}}
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="card-img-top">
                        @else
                            <img src="{{ asset('images/default-menu.jpg') }}" alt="Default Image" class="card-img-top">
                        @endif
                    </div>
                    <div class="solu_title text-center">
                        <h3>{{ $menu->name }}</h3>
                    </div>
                    <div class="solu_description">
                        <p>{{ Str::limit($menu->description, 100) }}</p>
                        <a href="{{ route('user.detail', $menu->id) }}" class="btn ">Lihat Resep</a>
                    </div>
                </div>
            </div>
        @empty
            {{-- Jika tidak ada menu --}}
            <div class="col-md-12 text-center">
                <p class="text-muted">Tidak ada menu yang tersedia untuk kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
