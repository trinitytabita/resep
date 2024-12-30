@extends('user.template')

@section('content')

<div class="container text-center mt-5">
    <h1>Pilih Kategori</h1>
    <div class="row justify-content-center mt-4">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="solution_card">
                <div class="hover_color_bubble"></div>
                @if ($category->name == 'Makanan')
                <div class="so_top_icon">
                    <img src="{{ asset('images/gallary-7.jpg') }}" alt="Makanan">
                </div>
                
                @elseif ($category->name == 'Minuman')
                <div class="so_top_icon">
                    <img src="{{ asset('images/coffe1.jpg') }}" alt="Minuman">
                </div>
                @elseif ($category->name == 'Dessert')
                <div class="so_top_icon">
                    <img src="{{ asset('images/desert2.jpg') }}" alt="Dessert">
                </div>
                @endif
                <div class="solu_title">
                    <h3>{{ $category->name }}</h3>
                </div>
                <div class="solu_description">
                    <a href="{{ route('user.show', $category->id) }}" class="btn ">Lihat Menu</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
