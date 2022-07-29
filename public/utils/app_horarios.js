$(function(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $("#horarioForm").on('submit', function(e){
        e.preventDefault();



        $.ajax({
            data: $(this).serialize(),
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            success: function(respuesta){
                console.log(respuesta)
                if(respuesta.status === 400){
                    Object.entries(respuesta.errors).forEach(([llave, valor]) => {
                        $(".errores").text(valor);
                      });
                }
                if(respuesta.resp === 'exito'){
                    $("#nuevoHorario").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Horario agregado satisfactoriamente',
                    }).then(function(){
                        window.location = "horarios";
                    })
                }
                else if(respuesta.resp == 'existe'){
                    Toast.fire({
                        icon: 'error',
                        title: ' Ya existe el turno'
                    })
                }
            }

        })


    })

    $("#tablaHorarios").on('click', '.editarHorarioBtn', function(e){
        e.preventDefault();
        $("#modalEditarHorario").modal('show');
        const idHorarioEdit = $(this).val();

        $.ajax({
            type: "GET",
            url: `horarios/${idHorarioEdit}/edit`,
            success: function (respuesta) {
                //console.log(respuesta)
                if (respuesta.status === 400) {
                    Toast.fire({
                        icon: 'error',
                        title: 'El Horario no existe'
                    })
                } else {
                    $("#idHorarioEditar").val(respuesta.horario.id);
                    $("#editarTurno").val(respuesta.horario.nombre_turno);
                    $("#editarHoraIngreso").val(respuesta.horario.hora_ingreso);
                    $("#editarHoraSalida").val(respuesta.horario.hora_salida);
                    let diasTurno = respuesta.horario.dias.split(",");
                    $("#editarSelectorDias").select2().val(diasTurno).trigger('change.select2');

                }
            }

        })
    })


    $("#editarHorarioForm").on('submit', function(e){
        e.preventDefault();
        $idHorario = $("#idHorarioEditar").val();

        $.ajax({
            type: "PUT",
            url: `horarios/${$idHorario}`,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(respuesta){
                console.log(respuesta);
                if(respuesta.status === 400){
                    $.each(respuesta.errors, function (key, err_values) {
                        $('.errores_editar').text(err_values);
                    })
                }
                else if(respuesta.status === 404){
                    Toast.fire({
                        icon: 'error',
                        title: ' No existe el horario u ocurrió un problema'
                    })
                }
                else{
                    $("#modalEditarHorario").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Horario actualizado satisfactoriamente',

                    }).then(function(){
                        window.location = "horarios";
                    })

                }
            }

        })
    })

    $("#tablaHorarios").on('click', '.eliminarHorario', function(e) {
        const id = $(this).val();
        e.preventDefault();
        $("#idEliminarHorario").val(id);
        $("#eliminarHorarioModal").modal('show');

    })

    $(document).on('click', '.eliminarHorarioBtn', function(e){
        e.preventDefault();
        const idHorario = $("#idEliminarHorario").val();

        $.ajax({
            type: "DELETE",
            url: `horarios/${idHorario}/delete`,
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta){
                if(respuesta.status === 200){
                    $("#eliminarHorarioModal").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Horario eliminado exitosamente',

                    }).then(function(){
                        window.location = "horarios";

                    })
                }

            }
        })

    })
})
