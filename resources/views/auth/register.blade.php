<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('assets/blk/img/Web/tecnología-verde-3d-32.png') }}">
    <title>Registro de cuenta</title>
    <link rel="stylesheet" href="{{ asset('assets/blk/css/blk-login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/columns.css') }}">
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('assets/blk/img/3529415.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link SoberanaSans-Regular text-register">
                            ¿Ya tienes una cuenta?
                            <br>
                            Inicia aquí
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
                                <h2 class="form-title text-register SoberanaSans-Regular text-center"
                                    style="margin-bottom: 10px">
                                    Registro
                                </h2>
                                <form method="POST" action="{{ route('register') }}"
                                    class="register-form SoberanaSans-Regular" id="register-form">
                                    @csrf
                                    <div class="row w-100">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="text" name="first_name"
                                                    :value="old('first_name')" required autofocus
                                                    placeholder="Primer nombre" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="text" name="second_name"
                                                    :value="old('second_name')" required autofocus
                                                    placeholder="Segundo nombre" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="text"
                                                    name="first_last_name" :value="old('first_last_name')" required
                                                    autofocus placeholder="Primer apellido" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="text"
                                                    name="second_last_name" :value="old('second_last_name')" required
                                                    autofocus placeholder="Segundo apellido" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="email" name="email"
                                                    :value="old('email')" required autofocus
                                                    placeholder="Correo institucional" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="password" name="password"
                                                    :value="old('password')" required autofocus
                                                    placeholder="Contraseña" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <div class="form-group">
                                                <input class="SoberanaSans-Regular" type="password"
                                                    name="password_confirmation" :value="old('password_confirmation')"
                                                    required autofocus placeholder="Confirmación de contraseña" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w-100">
                                            <small class="text-justify">Recuerda que, por seguridad, tu contraseña
                                                debe tener una combinación de caracteres alfanuméricos.
                                                <br>
                                                <strong>Ejemplo: </strong>
                                                @C0ntr4$3ña1234</small>
                                                <br>
                                        </div>
                                    </div>
                                    <div class="form-group form-button" style="margin-top: 20px !important">
                                        <button class="btn btn-register w-100 SoberanaSans-Black">
                                            Registarse
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
