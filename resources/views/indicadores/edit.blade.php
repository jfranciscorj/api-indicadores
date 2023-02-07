@extends('adminlte::page')

@section('title', 'Indicadores')

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Indicadores</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
          <li class="breadcrumb-item active"><a href="/indicadores">Indicadores</a></li>
          <li class="breadcrumb-item"><a href="/indicadores/{{$detalle->codigoIndicador}}">{{$detalle->codigoIndicador}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ \Carbon\Carbon::parse($detalle->fechaIndicador)->format('d-m-Y') }}</li>
        </ol>
      </div>
    </div>
@stop

@section('content')

<div class="card card-secondary">
  <div class="card-header">
    Actualizar indicador
  </div>
  <div class="card-body">
    <form action="{{ route('indicadores.update', $detalle) }}" method="POST" autocomplete="off">
      @csrf
      @method('put')

      <input type="hidden" name="id" value="{{$detalle->id}}">

      <div class="form-group row mt-2">
        <label for="nombreIndicador" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('nombreIndicador') is-invalid @enderror" id="nombreIndicador" name="nombreIndicador" placeholder="Nombre indicador" value="{{$detalle->nombreIndicador}}">
          @error('nombreIndicador')
          <small class="invalid-feedback">*{{$message}}</small>
        @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="codigoIndicador" class="col-sm-2 col-form-label">Codigo</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('codigoIndicador') is-invalid @enderror" id="codigoIndicador" name="codigoIndicador" placeholder="Codigo indicador" value="{{$detalle->codigoIndicador}}"> 
          @error('codigoIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="unidadMedidaIndicador" class="col-sm-2 col-form-label">Unidad de Medida</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('unidadMedidaIndicador') is-invalid @enderror" id="unidadMedidaIndicador" name="unidadMedidaIndicador" placeholder="Unidad de medida indicador" value="{{$detalle->unidadMedidaIndicador}}">
          @error('unidadMedidaIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="valorIndicador" class="col-sm-2 col-form-label">Valor</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('valorIndicador') is-invalid @enderror" id="valorIndicador" name="valorIndicador" placeholder="Valor indicador" value="{{$detalle->valorIndicador}}">
          @error('valorIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="fechaIndicador" class="col-sm-2 col-form-label">Fecha</label>
        <div class="col-sm-10">
          <input type="date" class="form-control @error('fechaIndicador') is-invalid @enderror" id="fechaIndicador" name="fechaIndicador" placeholder="Fecha indicador" value="{{$detalle->fechaIndicador}}">
          @error('fechaIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="tiempoIndicador" class="col-sm-2 col-form-label">Tiempo</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('tiempoIndicador') is-invalid @enderror" id="tiempoIndicador" name="tiempoIndicador" placeholder="Tiempo indicador" value="{{$detalle->tiempoIndicador}}">
          @error('tiempoIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="origenIndicador" class="col-sm-2 col-form-label">Origen</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('origenIndicador') is-invalid @enderror" id="origenIndicador" name="origenIndicador" placeholder="Origen indicador" value="{{$detalle->origenIndicador}}">
          @error('origenIndicador')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row mt-2">
        <div class="col-sm-10">
          @can('indicadores.edit')
          <button type="submit" class="btn btn-outline-primary">Actualizar indicador</button>
          @endcan
          @can('indicadores.destroy')
            <a href="{{route('indicadores.destroy', $detalle->id)}}"
              onclick="event.preventDefault();
              eliminar('{{$detalle->id}}');" 
              class="btn btn-outline-danger"> Eliminar indicador </a>
          @endcan
        </div>
      </div>
    </form>
    @can('indicadores.destroy')
      <form id="enviar" action="" method="POST" class="d-none">
        @csrf
        @method('delete')
      </form>
    @endcan
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

  <script>

    function eliminar(id){

        var id = id;
        var url = "{{ url('/indicadores')}}" + '/{{$detalle->codigoIndicador}}' + '/' + id + "/delete";

        Swal.fire({
              title: '¿Está seguro de eliminar este registro?',
              text: "...",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: 'Eliminar',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              console.log(result);
              if (result.isConfirmed) {
                $("#enviar").attr("action", url);
                $("#enviar").submit();
              } 
            })

      }

  </script>
@stop