@extends('adminlte::page')

@section('title', 'TEST MAIL')

@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Probar servicio de correo</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item active"> Probar servicio de correo </li>
      </ol>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Ingrese un correo valido
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('mail.test') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="text" class="form-control" name="correo" id="correo" value="{{ old('correo') }}" placeholder="Ingrese correo electrónico" required autocomplete="off">
                            @error('correo')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                        <button class="btn btn-outline-primary">Probar</button>
                    </form>
                </div>
            </div>
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