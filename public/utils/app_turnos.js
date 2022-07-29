$(function(){

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    //Agregar los turnos

    $("#turnoForm").on("submit", function(e){
        e.preventDefault();



        $.ajax({

            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),

                "idHorario": $("#idHorario").val(),
            },

            url: `turnos`,
            type: 'POST',
            dataType: 'json',
            success: function(respuesta){
                if(respuesta.status === 400){
                    Object.entries(respuesta.errors).forEach(([llave, valor]) => {
                        $(".errores").text(valor);
                      });
                }else if(respuesta.status === 200){
                    Toast.fire({
                        icon: 'success',
                        title: 'Turno agregado satisfactoriamente',
                    }).then(function(){
                        location.reload();
                    })
                }
                if (respuesta.resp === 'registro_existente') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Ya existe el turno'
                    })

                }
            }
        })

    })

    //Eliminar turno

    $("#tablaTurnos").on('click', '.eliminarTurno', function(e){
        const id = $(this).val();
        e.preventDefault();
        $('#idEliminarTurno').val(id);
        $("#eliminarTurnoModal").modal('show');
    })

    $(document).on('click', '.eliminarTurnoBtn', function(e){
        e.preventDefault();
        const idTurno = $("#idEliminarTurno").val();

        $.ajax({
            type: "DELETE",
            url: `turnos/${idTurno}`,
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta){
                console.log(respuesta.status)
                if(respuesta.status === 200){
                    $("#eliminarTurnoModal").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Turno eliminado exitosamente',

                    }).then(function(){
                        location.reload();

                    })
                }

            }
        })
    })
})
