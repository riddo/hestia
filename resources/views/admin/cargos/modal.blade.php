<!-- Modal agregar cargo -->
<div class="modal fade" id="nuevoCargo" tabindex="-1" role="dialog" aria-labelledby="nuevoCargoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoCargoTitulo">Nuevo Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cargoForm" action="{{ url('admin/cargos') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-danger errores" ></p>
                    <div class="form-group">
                        <label for="nombreCargo">Nombre del cargo</label>
                        <input  type="text" name="nombreCargo" id="nombreCargo" placeholder="Ingrese el nombre del cargo"
                            class="form-control">
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
<!-- Modal agregar cargo cierre -->

<!-- Modal editar cargo -->
<div class="modal fade" id="editarCargoModal" tabindex="-1" role="dialog" aria-labelledby="editarCargoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCargoTitulo">Editar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarCargoForm">
                @csrf
                @method('put')
                <div class="modal-body">
                    <p class="text-danger errores_editar" ></p>
                    <div class="form-group">
                        <input type="hidden" id="idCargo">
                        <label for="editarNombreCargo">Nombre del cargo</label>
                        <input type="text" name="editarNombreCargo" id="editarNombreCargo" placeholder="Ingrese el nombre del cargo" value=""
                            class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary actualizarCargo">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cierre de modal cargo -->

<!-- Modal eliminar cargo -->
<div class="modal fade" id="eliminarCargoModal" tabindex="-1" role="dialog" aria-labelledby="eliminarCargoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarCargoTitulo">Eliminar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="idEliminarCargo">
                    <h4>¿Estás seguro de eliminar este cargo?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger eliminarCargoBtn">Eliminar</button>
                </div>

        </div>
    </div>
</div>






<!--Validar formularios -->
<script src="{{ asset('public/utils') }}/app_cargos.js"></script>


