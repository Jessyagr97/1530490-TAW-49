@extends('auth.contenido')

@section('login')
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
        </div>

        <div class="card card-primary">
            <div class="card-header"><h4>Login</h4></div>

            <div class="card-body">
            <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
                <!--Proteccion de solicitudes de falsificacion -->
                {{ csrf_field() }}
                <!-------------->
                <div class="{{ $errors->has('email' ? 'is-invalid' : '')}}">
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input id="email" value="{{old('email')}}" type="email" class="form-control" name="email" required>
                        {!!$errors->first('email','<span class="invalid-feedback">:message</span>')!!}<!--Mostrar Mensaje-->
                    </div>
                </div>

                <div class="{{ $errors->has('password' ? 'is-invalid' : '')}}">
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Contraseña</label>
                            <div class="float-right">
                            <a href="auth-forgot-password.html" class="text-small">
                                Forgot Password?
                            </a>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password"required>
                        {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                    </button>
                </div>
            </form>
            <div class="text-center mt-4 mb-3">
                <div class="text-job text-muted">Login With Social</div>
            </div>
            <div class="row sm-gutters">
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                        <span class="fab fa-facebook"></span> Facebook
                    </a>
                </div>
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                        <span class="fab fa-twitter"></span> Twitter
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-5 text-muted text-center">
            Don't have an account? <a href="auth-register.html">Create One</a>
        </div>
        <div class="simple-footer">
            Copyright &copy; Stisla 2018
        </div>
    </div>
</div>
@endsection