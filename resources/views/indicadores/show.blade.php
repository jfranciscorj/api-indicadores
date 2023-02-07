@extends('adminlte::page')

@section('title', 'Indicadores')

@section('plugins.Datatables', true)
@section('plugins.Chartjs', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)


@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Indicadores</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/indicadores">Indicadores</a></li>
      <li class="breadcrumb-item active">{{$indicadores[0]->nombreIndicador}}</li>
    </ol>
  </div>
</div>
@stop

@section('content')

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#myModal">
  Agregar valor
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{$indicadores[0]->nombreIndicador}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="formularioNuevo" action="/indicadores/{{$codigoIndicador}}/nuevo" method="POST" autocomplete="off">
        @csrf
        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group row mt-2">
            <label for="nombreIndicador" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nombreIndicador') is-invalid @enderror" id="nombreIndicador" name="nombreIndicador" placeholder="Nombre indicador" value="{{$indicadores[0]->nombreIndicador}}" readonly>
              @error('nombreIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="codigoIndicador" class="col-sm-2 col-form-label">Codigo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('codigoIndicador') is-invalid @enderror" id="codigoIndicador" name="codigoIndicador" placeholder="Codigo indicador" value="{{$indicadores[0]->codigoIndicador}}" readonly> 
              @error('codigoIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="unidadMedidaIndicador" class="col-sm-2 col-form-label">Unidad de Medida</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('unidadMedidaIndicador') is-invalid @enderror" id="unidadMedidaIndicador" name="unidadMedidaIndicador" placeholder="Unidad de medida indicador" value="{{$indicadores[0]->unidadMedidaIndicador}}" readonly>
              @error('unidadMedidaIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="valorIndicador" class="col-sm-2 col-form-label">Valor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('valorIndicador') is-invalid @enderror" id="valorIndicador" name="valorIndicador" placeholder="Valor indicador" value="{{old('valorIndicador')}}">
              <small class="invalid-feedback" id="errorValorIndicador"></small>
              @error('valorIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="fechaIndicador" class="col-sm-2 col-form-label">Fecha</label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('fechaIndicador') is-invalid @enderror" id="fechaIndicador" name="fechaIndicador" placeholder="Fecha indicador" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}">
              <small class="invalid-feedback" id="errorFechaIndicador"></small>
              @error('fechaIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="tiempoIndicador" class="col-sm-2 col-form-label">Tiempo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tiempoIndicador') is-invalid @enderror" id="tiempoIndicador" name="tiempoIndicador" placeholder="Tiempo indicador" value="{{old('tiempoIndicador')}}">
              <small class="invalid-feedback" id="errorTiempoIndicador"></small>
              @error('tiempoIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="origenIndicador" class="col-sm-2 col-form-label">Origen</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('origenIndicador') is-invalid @enderror" id="origenIndicador" name="origenIndicador" placeholder="Origen indicador" value="{{old('origenIndicador')}}">
              <small class="invalid-feedback" id="errorOrigenIndicador"></small>
              @error('origenIndicador')
                <small class="invalid-feedback">*{{$message}}</small>
              @enderror
            </div>
          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          @can('indicadores.create')
          <button type="button" class="btn btn-outline-primary btn-sm" onclick="event.preventDefault();
          nuevo('{{$indicadores[0]->codigoIndicador}}');">Crear indicador</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelarModal">Cancelar</button>
          @endcan
        </div>
      </form>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    
    <form action="/indicadores/{{$codigoIndicador}}" method="POST">
      @csrf

      <div class="row">
        <div class="col">
          <label for="fechaIndicadorMin">Desde</label>
          <input type="date" name="fechaIndicadorMin" id="fechaIndicadorMin" class="form-control" min="" value="{{$indicadores->min()->fechaIndicador}}">
          @error('fechaIndicadorMin')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
        <div class="col">
          <label for="fechaIndicadorMax">Hasta</label>
          <input type="date" name="fechaIndicadorMax" id="fechaIndicadorMax" class="form-control" max="" value="{{$indicadores->max()->fechaIndicador}}">
          @error('fechaIndicadorMin')
            <small class="invalid-feedback">*{{$message}}</small>
          @enderror
        </div>
        <div class="col">
          <label for="">Filtrar información</label>
          <input type="submit" class="form-control btn btn-outline-primary" value="Filtrar">
        </div>
      </div>
    </form>
  </div>
    <div class="card-body">
      <h5 class="card-title">indicadores generales</h5>
      <h6 class="card-subtitle mb-2 text-muted">ultima actualización</h6>
      <div>
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <div class="card-footer text-muted">
      <table id="example" class="table display" style="width:100%">
        <thead>
            <tr>
                <th> # </th>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id='data'>
        <?php $valores=""; $fecha=""; $contador=0;?>
        @foreach($indicadores as $indicador)

        <?php
        
            if($contador == 0){
                $valores = $indicador->valorIndicador;
                $fecha = \Carbon\Carbon::parse($indicador->fechaIndicador)->format('d-m-Y');
            } else {
                $valores = $valores.','.$indicador->valorIndicador;
                $fecha = $fecha.','.\Carbon\Carbon::parse($indicador->fechaIndicador)->format('d-m-Y');
            }

            $contador++;
        ?>
            <tr>
                <td> {{$indicador->id}}</td>
                <td> 
                  
                  @if($indicador->unidadMedidaIndicador == "Pesos")
                    ${{number_format(($indicador->valorIndicador), 0, ',', '.')}}
                  @endif
                  @if($indicador->unidadMedidaIndicador == "Dólar")
                    US {{number_format(($indicador->valorIndicador), 0, ',', '.')}}
                  @endif
                  @if($indicador->unidadMedidaIndicador == "Porcentaje")
                    {{number_format(($indicador->valorIndicador), 2, ',', '.')}}%
                  @endif
                </td>
                <td> {{ \Carbon\Carbon::parse($indicador->fechaIndicador)->format('d-m-Y')}} </td>
                <td> 
                  @can('indicadores.edit')
                    <a class="btn btn-sm btn-outline-primary" href="/indicadores/{{strtolower($indicador->codigoIndicador)}}/{{$indicador->id}}"> Modificar </a>
                  @endcan
                  @can('indicadores.destroy')
                  <a href="{{route('indicadores.destroy', $indicador->id)}}"
                    onclick="event.preventDefault();
                    eliminar('{{$indicador->id}}');" 
                    class="btn btn-sm btn-outline-danger"> Eliminar </a>
                    <form id="enviar" action="" method="POST" class="d-none">
                      @csrf
                      @method('delete')
                    </form>
                  @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
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

    @if (Session::has('message'))
      <script>
        toastr.options.closeButton = true;
        toastr.error("{{Session::get('message')}}");
      </script>
    @endif

    <script>
      const ctx = document.getElementById('myChart');
  
        valores = '{{$valores}}';
        valoresstr = valores.split(',');
  
        fecha = '{{$fecha}}';
        fechastr = fecha.split(',');
  
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: fechastr,
          datasets: [{
            label: '{{$indicadores[0]->unidadMedidaIndicador}}',
            data: valoresstr,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
    <!-- ./chartjs -->

    <script>

      $( "#cancelarModal" ).click(function() {
          $('#valorIndicador').val('');
          $('#valorIndicador').removeClass('is-invalid');
          $('#fechaIndicador').val('');
          $('#fechaIndicador').removeClass('is-invalid');
          $('#tiempoIndicador').val('');
          $('#tiempoIndicador').removeClass('is-invalid');
          $('#origenIndicador').val('');
          $('#origenIndicador').removeClass('is-invalid');
      });
    
      function nuevo(id){
    
          $.ajax({
            type: $('#formularioNuevo').attr('method'), 
            url: $('#formularioNuevo').attr('action'),
            data: $('#formularioNuevo').serialize(),
            success: function (data) { 
    
            if(data.id){
    
              $('#valorIndicador').val('');
              $('#valorIndicador').removeClass('is-invalid');
              $('#fechaIndicador').val('');
              $('#fechaIndicador').removeClass('is-invalid');
              $('#tiempoIndicador').val('');
              $('#tiempoIndicador').removeClass('is-invalid');
              $('#origenIndicador').val('');
              $('#origenIndicador').removeClass('is-invalid');
              
              toastr.options.closeButton = true;
              toastr.success("Registro creado exitosamente");
    
              setTimeout(function(){
                window.location.reload();
              }, 2000);
    
            } else {
              if(data.valorIndicador){
                $('#valorIndicador').addClass('is-invalid');
                $('#errorValorIndicador').html(data.valorIndicador[0]);
              }else{
                $('#valorIndicador').removeClass('is-invalid');
                $('#errorValorIndicador').html('');
              }
    
              if(data.fechaIndicador){
                $('#fechaIndicador').addClass('is-invalid');
                $('#errorFechaIndicador').html(data.fechaIndicador[0]);
              }else{
                $('#fechaIndicador').removeClass('is-invalid');
                $('#errorFechaIndicador').html('');
              }
    
              if(data.tiempoIndicador){
                $('#tiempoIndicador').addClass('is-invalid');
                $('#errorTiempoIndicador').html(data.tiempoIndicador[0]);
              }else{
                $('#tiempoIndicador').removeClass('is-invalid');
                $('#errorTiempoIndicador').html('');
              }
    
              if(data.origenIndicador){
                $('#origenIndicador').addClass('is-invalid');
                $('#errorOrigenIndicador').html(data.origenIndicador[0]);
              } else {
                $('#origenIndicador').removeClass('is-invalid');
                $('#errorOrigenIndicador').html('');
              }
            }
    
    
          }, 
          error: function(xhr, textStatus, error){
            toastr.options.closeButton = true;
            toastr.error("{{Session::get('message')}}");
          }
        });
      }
        function eliminar(id){
    
          var id = id;
          var url = "{{ url('/indicadores')}}" + '/{{$codigoIndicador}}' + '/' + id + "/delete";
                
          Swal.fire({
                title: '¿Está seguro de eliminar este registro?',
                text: "...",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Eliminar',
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  
                  $("#enviar").attr("action", url);
                  $("#enviar").submit();
                } 
              })
    
        }
    
    
    </script>

<script>
  $(document).ready(function() {
      var table = $("#example").DataTable({
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
  });
</script>

@stop