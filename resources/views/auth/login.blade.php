<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('assets/blk/img/Web/tecnología-verde-3d-32.png') }}">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="{{ asset('assets/blk/css/blk-login.css') }}">
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('assets/blk/img/3770546.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('register') }}" class="signup-image-link SoberanaSans-Regular text-register">
                            ¿No tienes una cuenta?
                            <br>
                            Crea una aquí
                        </a>
                    </div>
                    <div class="signin-form div-center">
                        <div class="div-center">
                            <div class="div-size-custom">
                                <div class="row row-icon">
                                    <a href="/">
                                        <img src="{{ asset('assets/img/Web/tecnologia_verde_3d_96.png') }}"
                                            alt="" srcset="">
                                    </a>
                                </div>
                                <h2 class="form-title text-register SoberanaSans-Regular text-center">Inicio de sesión
                                </h2>
                                <form action="{{ route('login') }}" method="post"
                                    class="register-form SoberanaSans-Regular" id="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="your_name"><i class="fa-solid fa-envelope"></i></label>
                                        <input class="SoberanaSans-Regular" type="email" name="email"
                                            :value="old('email')" required autofocus
                                            placeholder="usuario@registraduria.gov.co" />
                                    </div>
                                    <div class="form-group">
                                        <label for="your_pass"><i class="fa-solid fa-key"></i></label>
                                        <input type="password" name="password" required
                                            autocomplete="current-password" placeholder="Contraseña" />
                                    </div>
                                    <div class="form-group form-button">
                                        <button type="submit" class="btn btn-register w-100 SoberanaSans-Black">
                                            Iniciar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://kit.fontawesome.com/c6ef26fdf4.js" crossorigin="anonymous"></script>
</body>

</html>
