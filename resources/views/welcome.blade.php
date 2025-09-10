<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ada Kasir</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            height: 100vh; /* Pastikan body hanya setinggi layar */
            margin: 0; /* Hilangkan margin */
            display: flex;
            flex-direction: column;
        }

        .container-full {
            display: flex;
            flex-direction: column;
            height: 100%; /* Memenuhi tinggi layar */
        }

        header, footer {
            flex: 0 0 auto; /* Tinggi tetap */
        }

        header {
            padding: 10px 0; /* Sesuaikan padding untuk header */
        }

        footer {
            padding: 8px 0; /* Footer sedikit lebih kecil */
        }

        section {
            flex: 1; /* Bagian gambar fleksibel */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F1F8E8; /* Warna background gambar diubah */
        }

        .image-container img {
            max-height: 100%; /* Gambar menyesuaikan tinggi container */
            max-width: 100%; /* Gambar menyesuaikan lebar container */
            object-fit: contain; /* Gambar tidak terpotong */
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 16px; /* Jarak antar tombol */
            margin-top: 10px; /* Jarak tombol dengan elemen lain */
        }

        /* Efek Mengetik */
        .typing-container {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid white; /* Garis berkedip */
            animation: typing 4s steps(30, end), blink 0.5s step-end infinite; /* Gabungkan mengetik dan berkedip */
        }

        /* Keyframes untuk mengetik */
        @keyframes typing {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }

        /* Keyframes untuk kedipan garis */
        @keyframes blink {
            from {
                border-right-color: white;
            }
            to {
                border-right-color: transparent;
            }
        }
    </style>
</head>
<body>
    <div class="container-full">
        <!-- Header -->
        <header class="w-full bg-[#55AD9B] text-white">
            <div class="container mx-auto text-center">
                <!-- Efek Mengetik -->
                <h1 class="typing-container">Selamat Datang di Ada Kasir</h1>
                <p class="mt-2 text-lg">Solusi pintar untuk manajemen kasir dan transaksi bisnis Anda.</p>

                <!-- Tombol Login dan Register -->
                <div class="button-container">
                    @if (Route::has('login'))
                        <a
                            href="{{ route('login') }}"
                            class="bg-white text-[#55AD9B] px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300 text-md"
                        >
                            Login
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="bg-[#3E8272] text-white px-6 py-2 rounded-lg hover:bg-[#2D5E52] transition duration-300 text-md"
                        >
                            Register
                        </a>
                    @endif
                </div>
            </div>
        </header>

        <!-- Gambar -->
        <section>
            <div class="image-container">
                <img 
                    src="{{ asset('storage/vektor/gambar_vektor_kasir.jpg') }}" 
                    alt="Gambar Kasir"
                >
            </div>
        </section>

        <!-- Footer -->
        <footer class="w-full bg-[#55AD9B] text-white text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Ada Kasir. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>