@extends('adminlte::page')

@section('title', 'Usuarios - Crear usuario')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Usuarios - Crear usuario</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/admin/usuarios">Usuarios</a></li>
        <li class="breadcrumb-item active"> Crear usuario</li>
      </ol>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href=" {{ Route('usuarios.index') }} " class="btn btn-outline-primary"> Volver </a>
        </div>

        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST" autocomplete="off">
            @csrf

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name"> Nombre completo </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ingrese nombre completo" maxlength="50" required autofocus >
                        @error('name')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email"> Correo electrónico </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Ingrese correo electrónico" maxlength="50" required >
                        @error('email')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="password">Clave</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"  name="password" value="{{ old('password') }}" placeholder="Ingrese clave" minlength="8" maxlength="50" required>
                        @error('password')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password-confirm"> Confirme Clave </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirme clave" minlength="8" maxlength="50" required>
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="rol"> Rol </label>
                        @foreach ($roles as $rol)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="rol[]" id="{{$rol->name}}" value="{{$rol->id}}">
                            <label for="{{$rol->name}}" class="form-check-label">{{$rol->name}}</label>    
                        </div>
                        @endforeach
                        @error('rol')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-outline-primary">
                            Crear usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop