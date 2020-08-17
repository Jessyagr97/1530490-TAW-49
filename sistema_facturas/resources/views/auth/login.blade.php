@extends('auth.contenido')

@section('login')
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
        </div>

        <div class="card card-primary">
            <div class="card-header"><h4>Login</h4></div>
            {!!$errors->first('usuario','<div class="alert alert-danger">:message</div>')!!}<!--Mostrar Mensaje-->
                   
            <div class="card-body">
            <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
                <!--Proteccion de solicitudes de falsificacion -->
                {{ csrf_field() }}
                <!-------------->
                <div class="{{ $errors->has('usuario' ? 'is-invalid' : '')}}">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input id="emausuarioil" value="{{old('usuario')}}" type="text" class="form-control" name="usuario" required>
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
                        {!!$errors->first('password','<div class="color bg-danger text-white"><div>:message</div></div>')!!}
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                    </button>
                </div>
            </form>
        </div>
        <div class="simple-footer">
            Copyright &copy; Stisla 2018
        </div>
    </div>
</div>
@endsection