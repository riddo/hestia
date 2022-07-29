<!-- Modal agregar cargo -->
<div class="modal fade" id="nuevoHorario" tabindex="-1" role="dialog" aria-labelledby="nuevoHorarioTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoHorarioTitulo">Nuevo Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="horarioForm" action="{{ url('admin/horarios') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-danger errores"></p>
                    <div class="form-group">
                        <label for="turno">Nombre turno</label>
                        <input type="text" name="turno" id="turno" class="form-control" placeholder="Nombre turno">
                    </div>
                    <div class="form-group">
                        <label>Selecciona los días</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" name="dias[]" id="selectorDias"
                                data-placeholder="Selecciona" data-dropdown-css-class="select2-purple"
                                style="width: 100%;">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="horaIngreso">Hora de ingreso</label>
                            <input type="time" class="form-control" name="horaIngreso" id="horaIngreso">
                        </div>
                        <div class="form-group">
                            <label for="horaSalida">Hora de salida</label>
                            <input type="time" class="form-control" name="horaSalida" id="horaSalida">
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
<!-- Modal agregar horario cierre -->

<!-- Modal editar horario-->
<div class="modal fade" id="modalEditarHorario" tabindex="-1" role="dialog" aria-labelledby="editarHorarioTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarHorarioTitulo">Editar Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarHorarioForm">
                <div class="modal-body">
                    @csrf
                    <p class="text-danger errores"></p>
                    <input type="hidden" id="idHorarioEditar">
                    <div class="form-group">
                        <label for="editarTurno">Nombre turno</label>
                        <input type="text" name="editarTurno" id="editarTurno" class="form-control" placeholder="Nombre turno">
                    </div>
                    <div class="form-group">
                        <label>Selecciona los días</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" name="editarDias[]" id="editarSelectorDias"
                                data-placeholder="Selecciona" data-dropdown-css-class="select2-purple"
                                style="width: 100%;">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="horaIngreso">Hora de ingreso</label>
                            <input type="time" class="form-control" name="editarHoraIngreso" id="editarHoraIngreso">
                        </div>
                        <div class="form-group">
                            <label for="horaSalida">Hora de salida</label>
                            <input type="time" class="form-control" name="editarHoraSalida" id="editarHoraSalida">
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierre de modal horario -->

<!-- Modal eliminar Horario-->
<div class="modal fade" id="eliminarHorarioModal" tabindex="-1" role="dialog" aria-labelledby="eliminarHorarioTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarHorarioTitulo">Eliminar Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


                <div class="modal-body">
                    {{-- @csrf --}}
                    <input type="hidden" id="idEliminarHorario">
                    <h4>¿Estás seguro de eliminar este horario?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger eliminarHorarioBtn">Eliminar</button>
                </div>

        </div>
    </div>
</div>







<!--Validar formularios -->
<script src="{{ asset('public/utils') }}/app_horarios.js"></script>

<script>
    $(function() {
        $('.select2').select2();

    })
</script>
