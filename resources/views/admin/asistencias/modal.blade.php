<!-- Modal agregar Asistencia -->
<div class="modal fade" id="nuevoAsistencia" tabindex="-1" role="dialog" aria-labelledby="nuevoAsistenciaTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoAsistenciaTitulo">Nueva Asistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="asistenciaForm" action="{{ url('admin/asistencias') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-danger errores_editar" ></p>
                    <div class="form-group">
                        <label for="empleado">Seleccionar empleado</label>
                        <select class="custom-select form-control-border" id="empleadoSelector" name="empleado">
                          <option selected disabled>---Seleccionar empleado---</option>
                         @if ($empleados)
                            @foreach ($empleados as $empleado)
                            <option value="{{$empleado->id}}">{{$empleado->empleado_nombre." ".$empleado->empleado_apellido. "  -  ".$empleado->cargos->cargo_nombre}}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success custom-control-input-outline" type="radio" id="ingreso" value="1" name="registro">
                        <label for="ingreso" class="custom-control-label">Ingreso</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" id="salida" value = "0" name="registro">
                        <label for="salida" class="custom-control-label">Salida</label>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal agregar asistencia cierre -->

<!-- Modal editar asistencia -->
<div class="modal fade" id="editarAsistenciaModal" tabindex="-1" role="dialog" aria-labelledby="editarAsistenciaTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarAsistenciaTitulo">Editar Asistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarAsistenciaForm">
                @csrf
                @method('put')
                <div class="modal-body">
                    <p class="text-danger errores_editar" ></p>
                    <div class="form-group">
                        <input type="hidden" id="idAsistencia">
                        <label>Editar fecha y hora del registro</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="datetime" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="fechaHoraRegistro" id="fechaHoraRegistro"/>
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary actualizarAsistencia">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierre de modal asistencia -->






<!--Validar formularios -->


<script src="{{ asset('public/utils') }}/app_asistencia.js"></script>
<script>

    //Date and time picker
    $('#reservationdatetime').datetimepicker({
        icons: { time: 'far fa-clock' },
        locale: moment.locale('es'),
     });

  //Date range picker


</script>


