@extends('adminlte::page')

@section('title', 'Usuarios - Ver usuario')

@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Usuarios - Ver usuario</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/admin/usuarios">Usuarios</a></li>
        <li class="breadcrumb-item active"> Ver usuario </li>
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
      <table class="table table-striped">
        <tr>
          <th scope="row">Nombre</th>
          <td>{{ $usuario->name}}</td>
        </tr>
        <tr>
          <th scope="row">Correo</th>
          <td>{{ $usuario->email}}</td>
        </tr>
        <tr>
          <th scope="row">Rol</th>
          <td>
            <?php $i = 1; ?>
            @foreach ($usuario->roles as $rol)
                @if($usuario->roles->count() > $i)
                    {{$rol}},
                @else
                    {{$rol}}
                @endif
            <?php $i++; ?>
            @endforeach
          </td>
        </tr>
        <tr>
          <th scope="row">Estado</th>
          <td>{{ $usuario->estado}}</td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td>
            <a href="{{Route('usuarios.edit', $usuario)}}" class="btn btn-outline-primary">Actualizar</a>
              @if ($usuario->active == 0)
                <a href="{{route('usuarios.activar', $usuario->id)}}"
                  onclick="event.preventDefault();
                  document.getElementById('activar{{$usuario->id}}').submit();" 
                  class="btn btn-outline-success">
                  Activar
                </a>
                <form id="activar{{$usuario->id}}" action="{{route('usuarios.activar', $usuario->id)}}" method="POST" class="d-none">
                  @csrf
                </form>
              @else
                <a href="{{route('usuarios.desactivar', $usuario->id)}}"
                  onclick="event.preventDefault();
                  document.getElementById('desactivar{{$usuario->id}}').submit();" 
                  class="btn btn-outline-danger">
                  Desactivar
                </a>
                <form id="desactivar{{$usuario->id}}" action="{{route('usuarios.desactivar', $usuario->id)}}" method="POST" class="d-none">
                  @csrf
                </form>
              @endif
          </td>
        </tr>
      </table>
    </div>
    <div class="card-footer clearfix">
      --
    </div>
    <!-- /.card-footer -->
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
@stop