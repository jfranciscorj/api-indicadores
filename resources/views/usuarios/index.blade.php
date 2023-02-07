@extends('adminlte::page')

@section('title', 'Usuarios')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Usuarios</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
      </ol>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href=" {{ Route('usuarios.create') }} " class="btn btn-outline-primary"> 
            <i class='fas fa-user-plus'></i> 
            Crear usuario 
          </a>
          <a href=" {{ Route('export.usuarios') }} " class="btn btn-outline-info"> 
            <i class="fa fa-file-export"></i>
              Exportar 
          </a>
        </h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">

        <table id="usuarios" class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Rol</th>
              <th>Estado</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($usuarios as $usuario)
            <tr>
              <td>{{$usuario->name}} </td>
              <td>{{$usuario->email}}</td>
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
              <td>{{ $usuario->active ? 'Activo':'Desactivado' }}</td>
              <td class="text-center">
                <!-- <a href="{{route('usuarios.show', $usuario->id)}}">
                  <button type="button" class="btn btn-sm btn-outline-info d-line" data-toggle="tooltip" data-placement="top" title="Ver usuario"> <i class='far fa-eye'></i> </button>
                </a> -->
                <a href="{{route('usuarios.edit', $usuario)}}">
                  <button type="button" class="btn btn-sm btn-outline-primary d-line" data-toggle="tooltip" data-placement="top" title="Actualizar usuario"><i class='far fa-edit'></i> </button>
                </a>
                @if ($usuario->active == 0)
                <a href="{{route('usuarios.activar', $usuario->id)}}"
                  onclick="event.preventDefault();
                  document.getElementById('activar{{$usuario->id}}').submit();" 
                  class="btn btn-sm btn-outline-success"
                  data-toggle="tooltip" data-placement="top" title="Activar usuario">
                  <i class='far fa-check-circle'></i>
                </a>
                <form id="activar{{$usuario->id}}" action="{{route('usuarios.activar', $usuario->id)}}" method="POST" class="d-none">
                  @csrf
                </form>
                @else
                  <a href="{{route('usuarios.desactivar', $usuario->id)}}"
                    onclick="event.preventDefault();
                    document.getElementById('desactivar{{$usuario->id}}').submit();" 
                    class="btn btn-sm btn-outline-danger" 
                    data-toggle="tooltip" data-placement="top" title="Desactivar usuario">
                    <i class='fas fa-ban'></i>
                  </a>
                  <form id="desactivar{{$usuario->id}}" action="{{route('usuarios.desactivar', $usuario->id)}}" method="POST" class="d-none">
                    @csrf
                  </form>
                @endif
                </td>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
    <script>




      $(document).ready(function() {

      $("#usuarios").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "language": {
        "processing": "Procesando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });
  });
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

@if(Session::has('success'))
<script>
  toastr.options.closeButton = true;
  toastr.success("{{Session::get('success')}}");
</script>
@endif

@stop