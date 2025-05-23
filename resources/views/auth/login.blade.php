<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bem-Vindo</title>
    <!-- MDB CSS -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
        rel="stylesheet"
    />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
</head>
<body>

<div class="container py-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                    <label class="form-label" for="email">Email</label>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    />
                    <label class="form-label" for="password">Senha</label>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember me and Forgot password -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            />
                            <label class="form-check-label" for="remember">Mantenha-me conectado</label>
                        </div>
                    </div>
                    <div class="col text-end">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Esqueceu sua senha??</a>
                        @endif
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

                <!-- Register Link -->
                <div class="text-center">
                    <p>Primeira vez?
                        <a href="{{ route('register') }}">Cadastre-se</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MDB JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>
</html>
