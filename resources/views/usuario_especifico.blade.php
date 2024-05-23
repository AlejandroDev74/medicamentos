@extends('adminlte::page')

@section('title', 'Edición usuarios')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-6">
        <br>
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Actualización de datos de usuario') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
    <form action="{{ url('actualizar_usuario_especifico')  }}" method="post">
    @csrf
    
    @foreach($data as $d)

    <div class="input-group mb-3">
    <strong>Id: </strong>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>
        <input type="number" class="form-control" name="id" value="{{ $d->id }}" autofocus required>
    </div>
    </div>

    <div class="input-group mb-3">
    <strong>Nombre de usuario: </strong>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
        <input type="text" class="form-control" name="nombre" value="{{ $d->name }}" autofocus required>
    </div>
    </div>

    <div class="input-group mb-3">
    <strong>Correo electrónico: </strong>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-at"></i></span>
        </div>
        <input type="email" class="form-control" name="correo" value="{{ $d->email }}" autofocus required>
    </div>
    </div>


    </div>

    <div class="card-footer">
    <button type="submit" class="btn btn-primary float-right">
        <span class="fas fa-recycle"></span> Actualizar</button>
    </div>
    @endforeach
    </form>
                    
            </div>
        </div>
    </div>       
</div>
@endsection