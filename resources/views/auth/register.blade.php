<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ada Kasir</title>
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

        .register-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-container h2 {
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

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #55AD9B;
            outline: none;
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

        .already-registered {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #055a4f;
            text-decoration: none;
        }

        .already-registered:hover {
            text-decoration: underline;
        }

        .register-footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .register-footer a {
            color: #55AD9B;
            text-decoration: none;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <div class="app-name">Ada Kasir</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="Owner">Owner</option>
                    <option value="Kasir">Kasir</option>
                </select>
            </div>

            <!-- Nomor HP -->
            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" placeholder="08123456789" value="{{ old('no_hp') }}" required autocomplete="tel">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Register</button>

            <!-- Already Registered -->
            <a class="already-registered" href="{{ route('login') }}">Already registered?</a>
        </form>
    </div>
</body>
</html>
