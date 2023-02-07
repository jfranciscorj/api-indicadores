@extends('adminlte::page')

@section('title', 'Roles - Ver rol')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Roles - Ver rol</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/admin/roles">Roles</a></li>
        <li class="breadcrumb-item active">Ver rol</li>
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
        <h3>{{ $rol->name }}</h3>
        <h5>{{ $rol->direccion }}</h5>
        <hr>
        <div class="form-group">
            <label for="permisos">PERMISOS</label>
            <div class="row">
              <div class="col-4">
                <label for="roles">Roles</label>
              @foreach($permisos as $permiso)
                @if(Illuminate\Support\Str::contains($permiso->name, "admin")) 
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="permissions[]" id="" value="{{$permiso->id}}" {{ $rol->hasPermissionTo($permiso->id) ? 'checked':'' }} disabled>
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
                        <input type="checkbox" class="form-check-input" name="permissions[]" id="" value="{{$permiso->id}}" {{ $rol->hasPermissionTo($permiso->id) ? 'checked':'' }} disabled>
                        <label for="" class="form-check-label">{{$permiso->description}}</label>    
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
            <hr>
            <div class="row form-group">
              <a href="{{route('roles.edit', $rol)}}" class="btn btn-outline-primary"> Actualizar </a>
            </div>
      </div>
      <!-- /.card-body -->
      
    </div>
    <div class="card-footer clearfix">
    --
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