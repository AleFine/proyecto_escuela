<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lord Kelvin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>
<section class="bg-light py-3 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <div class="card border border-light-subtle rounded-3 shadow-sm">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="text-center mb-3">
                            <a href="#!">
                                <img src="/assets/img/logos/logo.png" alt="Logo" width="250">
                            </a>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus autocomplete="name">
                                <label for="name">{{ __('Nombre') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="username">
                                <label for="email">{{ __('Correo Electrónico') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Role Selection -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="admin">Administrador</option>
                                    <option value="profesor">Profesor</option>
                                    <option value="padre_familia">Padre de Familia</option>
                                </select>
                                <label for="rol">{{ __('Selecciona el rol') }}</label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                                <label for="password">{{ __('Contraseña') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                <label for="password_confirmation">{{ __('Confirmar Contraseña') }}</label>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Register Button -->
                            <div class="d-grid my-3">
                                <button class="btn btn-primary btn-lg" type="submit">{{ __('Register') }}</button>
                            </div>
                            <div class="col-12">
                                <p class="m-0 text-secondary text-center"> <a href="{{ route('login') }}" class="link-primary text-decoration-none">Login</a></p>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</html>
