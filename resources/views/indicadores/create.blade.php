@extends('adminlte::page')

@section('title', 'Crear nuevo indicador')

@section('content_header')

<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Indicadores</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/indicadores">Indicadores</a></li>
      <li class="breadcrumb-item active">Crear indicador</li>
    </ol>
  </div>
</div>

@stop

@section('content')

  <div class="card card-secondary">
    <div class="card-header">
      Nuevo indicador
    </div>
    <div class="card-body">
      <form action="{{ route('indicadores.store') }}" method="POST" autocomplete="off">
      @csrf

        <div class="form-group row mt-2">
          <label for="nombreIndicador" class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('nombreIndicador') is-invalid @enderror" id="nombreIndicador" name="nombreIndicador" placeholder="Nombre indicador" value="{{old('nombreIndicador')}}">
            @error('nombreIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="codigoIndicador" class="col-sm-2 col-form-label">Codigo</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('codigoIndicador') is-invalid @enderror" id="codigoIndicador" name="codigoIndicador" placeholder="Codigo indicador" value="{{old('codigoIndicador')}}"> 
            @error('codigoIndicador')
              <small class="invalid-feedback">*{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="unidadMedidaIndicador" class="col-sm-2 col-form-label">Unidad de Medida</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('unidadMedidaIndicador') is-invalid @enderror" id="unidadMedidaIndicador" name="unidadMedidaIndicador" placeholder="Unidad de medida indicador" value="{{old('unidadMedidaIndicador')}}">
            @error('unidadMedidaIndicador')
              <small class="invalid-feedback">*{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="valorIndicador" class="col-sm-2 col-form-label">Valor</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('valorIndicador') is-invalid @enderror" id="valorIndicador" name="valorIndicador" placeholder="Valor indicador" value="{{old('valorIndicador')}}">
            @error('valorIndicador')
              <small class="invalid-feedback">*{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="fechaIndicador" class="col-sm-2 col-form-label">Fecha</label>
          <div class="col-sm-10">
            <input type="date" class="form-control @error('fechaIndicador') is-invalid @enderror" id="fechaIndicador" name="fechaIndicador" placeholder="Fecha indicador" value="{{old('fechaIndicador')}}">
            @error('fechaIndicador')
              <small class="invalid-feedback">*{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="tiempoIndicador" class="col-sm-2 col-form-label">Tiempo</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('tiempoIndicador') is-invalid @enderror" id="tiempoIndicador" name="tiempoIndicador" placeholder="Tiempo indicador" value="{{old('tiempoIndicador')}}">
            @error('tiempoIndicador')
              <small class="invalid-feedback">*{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="origenIndicador" class="col-sm-2 col-form-label">Origen</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('origenIndicador') is-invalid @enderror" id="origenIndicador" name="origenIndicador" placeholder="Origen indicador" value="{{old('origenIndicador')}}">
            @error('origenIndicador')
              <small class="invalid-feedback">*{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row mt-2">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-outline-primary">Crear indicador</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop

@section('css')
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css " rel="stylesheet">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('breadcrumb')
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/indicadores">Indicadores</a></li>
      <li class="breadcrumb-item active" aria-current="page">Crear indicador</li>
  </ol>
@endsection
