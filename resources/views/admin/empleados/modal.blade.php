<!-- Modal agregar empleado -->
<div class="modal fade" id="nuevoEmpleado" tabindex="-1" role="dialog" aria-labelledby="nuevoEmpleadoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoEmpleadoTitulo">Nuevo Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="empleadoForm" action="{{ url('admin/empleados') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-danger errores"></p>
                    <div class="form-group">
                        <label>Cargo</label>
                        <select class="form-control"   style="width: 100%;" name="cargoEmpleado" id="cargoEmpleado">
                            <option selected disabled>--Selecciona Cargo--</option>
                            @if($cargos)
                            @foreach ($cargos as $cargo)
                                <option value="{{$cargo->id}}">{{$cargo->cargo_nombre}}</option>
                            @endforeach

                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombreEmpleado">Nombres</label>
                        <input type="text" name="nombreEmpleado" id="nombreEmpleado"
                            placeholder="Ingrese el nombre del empleado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="apellidoEmpleado">Apellidos</label>
                        <input type="text" name="apellidoEmpleado" id="apellidoEmpleado"
                            placeholder="Ingrese el apellido del empleado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="rutEmpleado">RUT Empleado <span class="badge badge-success">Utilice guión</span></label>
                        <input type="text" name="rutEmpleado" id="rutEmpleado"
                            placeholder="12345678-9" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fonoEmpleado">Fono</label>
                        <input type="text" name="fonoEmpleado" id="fonoEmpleado" placeholder="Ingrese el fono"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="direccionEmpleado">Dirección</label>
                        <input type="text" name="direccionEmpleado" id="direccionEmpleado"
                            placeholder="Ingrese la dirección" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="emailEmpleado">Email</label>
                        <input type="email" name="emailEmpleado" id="emailEmpleado"
                            placeholder="Ingrese el correo electrónico" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="generoEmpleado">Género</label>
                        <select name="generoEmpleado" id="generoEmpleado" class="form-control">
                            <option selected disabled >--Seleccionar género--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="No especificar">No especificar</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btnGuardar">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal agregar Empleado cierre -->
<div class="modal fade" id="editarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="editarEmpleadoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEmpleadoTitulo">Editar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarEmpleadoForm">
                @csrf
                @method('put')
                <div class="modal-body">
                    <p class="text-danger errores_editar"></p>
                    <div class="form-group">
                        <input type="hidden" id="idEditarEmpleado" name="idEditarEmpleado">
                        <label for="editarNombreEmpleado">Nombres</label>
                        <input type="text" name="editarNombreEmpleado" id="editarNombreEmpleado"
                            placeholder="Ingrese el nombre del empleado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editarApellidoEmpleado">Apellidos</label>
                        <input type="text" name="editarApellidoEmpleado" id="editarApellidoEmpleado"
                            placeholder="Ingrese el apellido del empleado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editarRutEmpleado">RUT Empleado</label>
                        <input type="text" name="editarRutEmpleado" id="editarRutEmpleado"
                            placeholder="Ingrese el rut del empleado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editarFonoEmpleado">Fono</label>
                        <input type="text" name="editarFonoEmpleado" id="editarFonoEmpleado" placeholder="Ingrese el fono"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editarDireccionEmpleado">Dirección</label>
                        <input type="text" name="editarDireccionEmpleado" id="editarDireccionEmpleado"
                            placeholder="Ingrese la dirección" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editarEmailEmpleado">Email</label>
                        <input type="email" name="editarEmailEmpleado" id="editarEmailEmpleado"
                            placeholder="Ingrese el correo electrónico" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editarGeneroEmpleado">Género</label>
                        <select name="editarGeneroEmpleado" id="editarGeneroEmpleado" class="form-control">
                            <option selected disabled >--Seleccionar género--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="No especificar">No especificar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cargo</label>
                        <select class="form-control"  style="width: 100%;" name="editarCargoEmpleado" id="editarCargoEmpleado">
                            <option selected disabled>--Selecciona Cargo--</option>
                            @if($cargos)
                            @foreach ($cargos as $cargo)
                                <option value="{{$cargo->id}}">{{$cargo->cargo_nombre}}</option>
                            @endforeach

                            @endif

                        </select>
                      </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btnActualizar">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal editar Empleado -->

<!-- Modal eliminar empleado -->
<div class="modal fade" id="eliminarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="eliminarEmpleadoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarEmpleadoTitulo">Eliminar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="idEliminarEmpleado">
                    <h4>¿Estás seguro de eliminar empleado?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger eliminarEmpleado">Eliminar</button>
                </div>

        </div>
    </div>
</div>




<!--Validar formularios -->
<script src="{{ asset('public/utils') }}/app_empleados.js"></script>




