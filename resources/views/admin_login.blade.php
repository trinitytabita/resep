<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
         .wrapper .form-field input {
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.11rem;
        color: #666;
        padding: 10px 15px 10px 10px;
        /* border: 1px solid red; */
    }

    .wrapper .form-field {
        padding-left: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
        color: #555;
    }


        /* Tambahan gaya untuk pesan error */
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <h1 class="opacity">ADMIN LOGIN</h1>
                
                <!-- Tampilkan pesan error jika ada -->
                @if(session('error'))
                <p class="error-message">{{ session('error') }}</p>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST" class="p-3 mt-3">
                    @csrf
                    <div class="form-field d-flex align-items-center">
                        <span class="far fa-user"></span>
                        <input type="text" id="username" name="username" placeholder="Masukkan Username Anda..." required>
                    </div>
                    
                    <div class="form-field d-flex align-items-center">
                        <span class="fas fa-key"></span>
                        <input type="password" id="password" name="password" placeholder="Silahkan Masukan Passworrd Anda..." required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
    </section>
</body>

</html>
