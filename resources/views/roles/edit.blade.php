@extends('adminlte::page')

@section('title', 'Roles - Actualizar rol')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Roles - Actualizar rol</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/admin/roles">Roles</a></li>
        <li class="breadcrumb-item active">Actualizar rol</li>
      </ol>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href=" {{ Route('roles.index') }} " class="btn btn-outline-primary">  
            Volver
          </a>
        </h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form action="{{ Route('roles.update', $rol) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

          <div class="form-group">
            <label for="nombre">Nombre del rol</label>
            <input type="text" name="name" class="form-control" placeholder="Ingrese nombre de rol" value="{{ $rol->name }}" required>
            @error('name')
                <p class="text-danger">{{ $message }} </p>
            @enderror 
          </div>
          <div class="form-group">
            <label for="permisos">PERMISOS</label>
        
            <div class="row">
              <div class="col-4">
                <label for="roles">Roles</label>
              @foreach($permisos as $permiso)
                @if(Illuminate\Support\Str::contains($permiso->name, "admin")) 
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="permissions[]" id="" value="{{$permiso->id}}" {{ $rol->hasPermissionTo($permiso->id) ? 'checked':'' }}>
                      <label for="" class="form-check-label">{{$permiso->description}}</label>    
                  </div>
                @endif
              @endforeach
              </div>
              <div class="col-4">
                <label for="usuarios">Indicadores</label>
                @foreach($permisos as $permiso)
                  @if(Illuminate\Support\Str::contains($permiso->name, "indicadores")) 
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permissions[]" id="" value="{{$permiso->id}}" {{ $rol->hasPermissionTo($permiso->id) ? 'checked':'' }}>
                        <label for="" class="form-check-label">{{$permiso->description}}</label>    
                    </div>
                  @endif
                @endforeach
              </div>
      
            </div>
            <hr>
  
            @error('rol')
                <p class="text-danger">{{ $message }} </p>
            @enderror 
          </div>

          <input type="submit" value="Actualizar rol" class="btn btn-outline-primary">
        </form>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
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

@stop