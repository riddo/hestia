<!-- Modal eliminar Turnos-->
<div class="modal fade" id="eliminarTurnoModal" tabindex="-1" role="dialog" aria-labelledby="eliminarTurnoTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarTurnoTitulo">Eliminar Turno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


                <div class="modal-body">
                    {{-- @csrf --}}
                    <input type="hidden" id="idEliminarTurno">
                    <h4>¿Estás seguro de eliminar este Turno?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger eliminarTurnoBtn">Eliminar</button>
                </div>

        </div>
    </div>
</div>
<script src="{{ asset('public/utils') }}/app_turnos.js"></script>
