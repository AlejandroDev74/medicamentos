@extends('adminlte::page')

@section('title', 'Contraseña')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-6">
        <br>
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Restablecer contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
    <form action="restablecer_contrasena" method="post">
    @csrf

    <div class="input-group mb-3">
    <strong>Contraseña: </strong>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>
        <input type="password" class="form-control" name="contrasena" autofocus required>
    </div>
    </div>

    <div class="input-group mb-3">
    <strong>Confirmar contraseña: </strong>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>
        <input type="password" class="form-control" name="confirmar_contrasena" autofocus required>
    </div>
    </div>

    </div>

    <div class="card-footer">
    <button type="submit" class="btn btn-primary float-right">
        <span class="fas fa-recycle"></span> Restablecer</button>
    </div>

    </form>

            </div>
        </div>
    </div>
    </div>
</div>
@endsection
