<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin — Desa Bungur</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {

            min-height: 100vh;

            background: linear-gradient(135deg, #1a4731 0%, #2d7a50 100%);

            display: flex; align-items: center; justify-content: center;

        }

        .login-card {

            background: #fff; border-radius: 16px;

            padding: 40px 36px; width: 100%; max-width: 400px;

            box-shadow: 0 20px 60px rgba(0,0,0,0.2);

        }

        .login-logo {

            width: 64px; height: 64px; border-radius: 16px;

            background: #1a4731;

            display: flex; align-items: center; justify-content: center;

            font-size: 28px; margin: 0 auto 16px;

        }

        .login-title { font-weight: 800; font-size: 1.3rem; color: #1a4731; }

        .login-sub { color: #6c757d; font-size: 13px; }

        .form-control:focus { border-color: #2d7a50; box-shadow: 0 0 0 3px rgba(45,122,80,0.15); }

        .btn-login {

            background: #1a4731; color: #fff;

            border: none; padding: 12px;

            border-radius: 8px; width: 100%;

            font-weight: 700; font-size: 14px;

            transition: all 0.2s;

        }

        .btn-login:hover { background: #2d7a50; }

    </style>

</head>

<body>

    <div class="login-card">

        <div class="text-center mb-4">

            <div class="login-logo">🏘️</div>

            <div class="login-title">Panel Admin</div>

            <div class="login-sub">Desa Bungur · Kep. Meranti</div>

        </div>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label fw-600" style="font-size:13px;">Email</label>

                <input type="email" name="email" value="{{ old('email') }}"

                    class="form-control @error('email') is-invalid @enderror"

                    placeholder="admin@desabungur.id" required autofocus>

                @error('email')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>

            <div class="mb-4">

                <label class="form-label fw-600" style="font-size:13px;">Password</label>

                <input type="password" name="password"

                    class="form-control @error('password') is-invalid @enderror"

                    placeholder="••••••••" required>

                @error('password')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>

            <button type="submit" class="btn-login">Masuk ke Dashboard</button>

        </form>

        <p class="text-center text-muted mt-3 mb-0" style="font-size:12px;">

            Website Resmi Desa Bungur © {{ date('Y') }}

        </p>

    </div>

</body>

</html>
