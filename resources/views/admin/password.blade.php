@extends('adminlte::page')

@section('title', 'Cambiar clave')

@section('plugins.Toastr', true)

@section('content_header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Cambiar clave</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item active"> Cambiar clave </li>
      </ol>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href=" {{ Route('admin') }} " class="btn btn-outline-primary"> 
            Inicio
          </a>
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

          <form action="{{ route('settings.password') }}" method="POST" class="form-group">
          @csrf
            <div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Ingrese clave">
            </div>
            @error('password')
                <p class="text-danger">{{ $message }} </p>
            @enderror
            <div class="form-group">
                <label for="confirme">Confirme Clave</label>
                <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirme clave">
            </div>
            @error('password_confirmation')
                <p class="text-danger">{{ $message }} </p>
            @enderror
            <button type="submit" class="btn btn-outline-primary">
                {{ __('Cambiar clave') }}
            </button>
        </form>

      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        --
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
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