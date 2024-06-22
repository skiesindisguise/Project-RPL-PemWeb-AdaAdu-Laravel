<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('style/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-page">
        <div class="container">
            <div class="left-side">
                <img src="{{ asset('images/login-bg.png') }}" alt="Side Image">
            </div>
            <div class="right-side">
                <div class="logo-container">
                    <img src="{{ asset('images/logo-adaadu-svg.svg') }}" alt="Logo 1" class="logo-uns">
                    <img src="{{ asset('images/logo-uns-svg.svg') }}" alt="Logo 2">
                </div>
                <h2>Welcome to AdaAdu</h2>
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="form-group">
                        <label for="email">Email (SSO)</label>
                        <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
