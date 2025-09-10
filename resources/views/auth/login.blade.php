<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ada Kasir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F1F8E8; /* Warna latar hijau muda */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 10px;
            font-size: 1.8rem;
            color: #055a4f; /* Warna hijau tua untuk heading */
        }

        .app-name {
            background-color: #55AD9B; /* Warna hijau utama */
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-block;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #055a4f;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group input:focus {
            border-color: #55AD9B;
            outline: none;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-check input {
            margin-right: 10px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #55AD9B; /* Warna hijau utama */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #469987;
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #055a4f;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .login-footer a {
            color: #55AD9B;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <div class="app-name">Ada Kasir</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <!-- Remember Me -->
            <div class="form-check">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me">Remember me</label>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn">Log in</button>
            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </form>
        <div class="login-footer">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        </div>
    </div>
</body>
</html>
