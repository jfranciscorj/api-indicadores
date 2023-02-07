@extends('adminlte::page')

@section('title', 'Usuarios - Actualizar usuario')

@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Usuarios - Actualizar usuario</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/admin/usuarios">Usuarios</a></li>
        <li class="breadcrumb-item active"> Actualizar usuario </li>
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
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('put')
                        
                        <div class="form-group">
                            <label for="name"> Nombre completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" maxlength="50" required>
                            @error('name')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email"> Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" maxlength="50" required>
                            @error('email')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="form-group"> 
                            <label for="rol">Rol</label>
                            @foreach ($roles as $rol)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="rol[]" id="" value="{{$rol->id}}" {{ $usuario->hasRole($rol->name) ? 'checked':'' }} >
                                <label for="" class="form-check-label">{{$rol->name}}</label>    
                            </div>
                            @endforeach
                            @error('rol')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror    
                        </div>
        
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">
                                Actualizar usuario
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-xs-12">
                    <form action="{{ route('usuarios.password', $usuario) }}" method="POST" class="form-group">
                    @csrf

                        <div class="form-group">
                            <label for="clave">Clave</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Ingrese clave" minlength="8" maxlength="50" required>
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                        <div class="form-group">
                            <label for="confirme">Confirme Clave</label>
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirme clave" minlength="8" maxlength="50" required>
                        </div>
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                        <button type="submit" class="btn btn-outline-primary">
                            {{ __('Cambiar clave') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer">
            --
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    @if(Session::has('success'))
    <script>
        toastr.options.closeButton = true;
        toastr.success("{{Session::get('success')}}");
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        toastr.options.closeButton = true;
        toastr.warning("{{Session::get('error')}}");
    </script>
    @endif
@stop