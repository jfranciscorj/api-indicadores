@extends('adminlte::page')

@section('title', 'Roles')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Roles</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item active">Roles</li>
      </ol>
    </div>
  </div>
@stop

@section('content')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href=" {{ Route('roles.create') }} " class="btn btn-outline-primary"> 
            <i class='fas fa-user-cog'></i> 
            Crear rol
          </a>
          <a href=" {{ Route('export.roles') }} " class="btn btn-outline-info"> 
            <i class="fa fa-file-export"></i>
              Exportar 
          </a>
        </h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
      <table id="roles" class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>Rol</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($roles as $rol)
              <tr>
                <td>{{$rol->id}}</td>
                <td>{{$rol->name}}</td>
                <td>
                  <a href="{{route('roles.edit', $rol)}}" class="btn btn-sm btn-outline-info d-line" data-toggle="tooltip" data-placement="top" title="Actualizar rol">
                    <i class='far fa-edit'></i>
                  </a>
                  @if ($rol->active == 0)
                  <a href="{{route('roles.activar', $rol->id)}}"
                    onclick="event.preventDefault();
                    document.getElementById('activar{{$rol->id}}').submit();" 
                    class="btn btn-sm btn-outline-success"
                    data-toggle="tooltip" data-placement="top" title="Activar rol">
                    <i class='far fa-check-circle'></i>
                  </a>
                  <form id="activar{{$rol->id}}" action="{{route('roles.activar', $rol->id)}}" method="POST" class="d-none">
                    @csrf
                  </form>
                  @else
                    <a href="{{route('roles.desactivar', $rol->id)}}"
                      onclick="event.preventDefault();
                      document.getElementById('desactivar{{$rol->id}}').submit();" 
                      class="btn btn-sm btn-outline-danger"
                      data-toggle="tooltip" data-placement="top" title="Desactivar rol">
                      <i class='fas fa-ban'></i>
                    </a>
                    <form id="desactivar{{$rol->id}}" action="{{route('roles.desactivar', $rol->id)}}" method="POST" class="d-none">
                      @csrf
                    </form>
                  @endif
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
      $("#roles").DataTable({
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
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        },
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