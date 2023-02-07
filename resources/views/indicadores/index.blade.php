@extends('adminlte::page')

@section('title', 'Indicadores')

@section('plugins.Datatables', true)

@section('content_header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Indicadores</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
        <li class="breadcrumb-item active">Indicadores</li>
      </ol>
    </div>
  </div>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      @can('indicadores.create')
        <a href=" {{ Route('indicadores.create') }} " class="btn btn-outline-primary"> 
          <i class='fas fa-chart-line'></i> 
          Crear indicador
        </a>
      @endcan
    </div>
    <div class="card-body">
      <table id="example" class="display table mb-5">
        <thead>
            <tr>
                <th>Indicador</th>
                <th>Codigo</th>
                <th>Medida</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="data">
        </tbody>
    </table>
    </div>
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
@stop

@section('js')
    <script>
      $(document).ready(function(){
        
        url = "/indicadores/data";

        $.ajax({
          url: url,
          type: "GET",
          success: function(data) {
            
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

              var calculo = data[i].calculo;
              var arrow = "";

              if(calculo >= 0){
                arrow = "<span class='text-success'><i class='fa-solid fa-arrow-up'></i></span>";
              } else {
                if(calculo <= 0){
                  arrow = "<span class='text-danger'><i class='fa-solid fa-arrow-down'></i></span>";
                }
              }                             

              codigo = data[i].codigoIndicador;
              html += '<tr>' +
                '<td>' + data[i].nombreIndicador + '</td>' +
                '<td>' + data[i].codigoIndicador + '</td>' +
                '<td>' + data[i].unidadMedidaIndicador + '</td>' +
                '<td class="text-end">' + data[i].valorIndicador + " " +arrow + '</td>' +
                '<td>' + data[i].fechaIndicador + '</td>' +
                '<td class="text-center"> <a class="btn btn-sm btn-outline-primary" href="/indicadores/' + codigo.toLowerCase() + '">VER</a> </td>' +
                '</tr>';
            }

            $('#data').html(html);
            $("#example").DataTable({
              "responsive": true, 
              "lengthChange": true, 
              "autoWidth": false,
              "paging": true,
              "searching": true,
              "ordering": true,
              "order": [[0, 'desc']],
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

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error...');
          }
        });

      });

    </script>

@stop