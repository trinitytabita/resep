@extends('user.template')

@section('content')
<style>
 .custom-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 2rem;
}

.custom-card-detail {
    display: grid;
    flex-direction: wrap;
    position: relative;
    overflow: hidden;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    transition: transform 0.2s, box-shadow 0.3s;
}

.custom-card-detail:hover {
    transform: scale(1.02);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
}

.custom-card-image {
    display: flex;
  height: 260px;
  box-shadow: 0 50px 100px 0 #ffc107;
}

.custom-card-image img {
    display: block;
  width: 100%;
  height: auto;
  object-fit: cover;
    transition: transform 0.3s;
}

.custom-card-image:hover img {
    transform: scale(1.1);
}

.custom-card-content {
  padding: 0.5rem 1rem 1rem;
  color: var(--white);
}



.custom-card-title {
    position: absolute;
  top: 0;
  right: 0;
  width: 90%;
  height: auto;
  color: #222;
  padding: 0.5rem;
  border-radius: 5px 0 0 5px;
  transform: rotate(-3.3deg);
  transform-origin: left top;
  font-family: Georgia, Times, serif;
  font-weight: 600;
  font-size: 1.325rem;
  overflow: hidden;
  z-index: 1;
  background-color: rgba(255, 237, 73, 0.75);
  animation: 0s 0s fly-in 0 reverse both;
  margin-top: 20px;
}
.custom_card_text {
  font-family: Georgia, Times, serif;
  line-height: 1.5;
  text-size-adjust: 0.2px;
  padding: 0 1rem;
}

.custom-card-text h4 {
    font-size: 1.5rem;
    color: white;
    
    margin-bottom: 0.5rem;
}

.custom-card-text p {
    font-size: 1rem;
    line-height: 1.6;
}

.custom-card-text ul, 
.custom-card-text ol {
    margin: 0.5rem 0 1rem 1.5rem;
    color: white;
}

.custom-card-actions {
    margin-top: 1.5rem;
    text-align: center;
}

.custom-action-link {
    text-decoration: none;
    color: white;
    background-color:  #ffc107;
    padding: 0.75rem 1.5rem;
    font-weight: bold;
    border-radius: 5px;
    font-family: Georgia, Times, serif;
    transition: background-color 0.3s, color 0.3s;
}

.custom-action-link:hover {
    background-color: #b4fee7;
    color: #222;
}
.custom-card-text-scroll  {
    max-height: 200px; /* Membatasi tinggi maksimal */
    overflow-y: auto; /* Menambahkan scrollbar vertikal jika konten melebihi batas */
}

.custom-card-text-scroll::-webkit-scrollbar {
    width: 6px; /* Lebar scrollbar */
}

.custom-card-text-scroll::-webkit-scrollbar-thumb {
    background: #ffc107; /* Warna scrollbar */
    border-radius: 3px; /* Membulatkan ujung scrollbar */
}

.custom-card-text-scroll::-webkit-scrollbar-track {
    background: #f1f1f1; /* Warna latar belakang track scrollbar */
}


</style>
<div class="custom-container mt-6 d-flex justify-content-center">
    <div class="custom-card-detail">
        <!-- Gambar -->
        <div class="custom-card-image">
            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
        </div>

        <!-- Konten -->
        <div class="custom-card-content">
            <!-- Judul -->
            <div class="custom-card-title">
                {{ $menu->name }}
            </div>

            <!-- Deskripsi -->
            <div class="custom-card-text">
            <div class="custom-card-text mb-3">
                <h4>Deskripsi:</h4>
                <p>{{ $menu->description }}</p>
            </div>

            <!-- Resep -->
            <div class="custom-card-text-scroll">
                <h4>Resep:</h4>

                <!-- Bahan -->
                <h5>Bahan:</h5>
                <ul>
                    @foreach (explode(',', $menu->recipe->ingredients) as $ingredient)
                        <li>{{ $ingredient }}</li>
                    @endforeach
                </ul>

                <!-- Langkah-langkah -->
                <h5 class="mt-3">Langkah-langkah:</h5>
                <ol>
                    @foreach (explode('.', $menu->recipe->instructions) as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ol>
            </div>

            <!-- Aksi -->
            <div class="custom-card-actions mt-3">
                <a href="{{ route('user.index') }}" class="custom-action-link">Kembali ke Daftar</a>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
