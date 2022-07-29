$(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    /**Agregar cargo***/
    const cargoForm = $('#cargoForm');
    const modalCargo = $('#nuevoCargo');

    cargoForm.on('submit', (e) => {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            data: cargoForm.serialize(),
            type: cargoForm.attr('method'),
            url: cargoForm.attr('action'),
            dataType: 'json',

            success: (respuesta) => {
                //console.log(respuesta);
                if (respuesta.status === 400) {
                    $.each(respuesta.errors, function (key, err_values) {
                        $('.errores').text(err_values);
                    })
                }
                if (respuesta.resp === 'exito') {
                    modalCargo.modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Cargo agregado satisfactoriamente',
                    }).then(function(){
                        window.location = "cargos";
                    })



                } else if (respuesta.resp === 'registro_existente') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Ya existe el cargo'
                    })

                }

            },
            error: (error) => {
                console.log(error)
            }
        })
    });

    /** Editar cargo (mostrar datos en el modal y submitting)**/

    $("#tablaCargos").on('click', '.editarCargo', function (e) {
        e.preventDefault();
        const idCargo = $(this).val();


        $.ajax({
            type: "GET",
            url: `cargos/${idCargo}/edit`,
            success: function (respuesta) {
                //console.log(respuesta)
                if (respuesta.status === 400) {
                    Toast.fire({
                        icon: 'error',
                        title: 'El cargo no existe'
                    })
                } else {
                    $("#editarNombreCargo").val(respuesta.cargo.cargo_nombre);
                    $("#idCargo").val(respuesta.cargo.id);
                }
            }

        })
    })

    $("#editarCargoForm").on('submit', (e) => {
        e.preventDefault();
        const idCargo = $("#idCargo").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: `cargos/${idCargo}`,
            data: $("#editarCargoForm").serialize(),
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
                        title: 'El cargo ya existe'
                    })
                }
                else{
                    $("#editarCargoModal").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Cargo actualizado satisfactoriamente',

                    }).then(function(){
                        window.location = "cargos";
                    })

                }
            }

        })
    })

    /***Eliminar Cargo***/

    $("#tablaCargos").on('click', '.eliminarCargo', function(e) {
        const id = $(this).val();
        e.preventDefault();
        $("#idEliminarCargo").val(id);
        $("#eliminarCargoModal").modal('show');

    })

    $(document).on('click', '.eliminarCargoBtn', function(e){
        e.preventDefault();
        const idCargo = $("#idEliminarCargo").val();

        $.ajax({
            type: "DELETE",
            url: `cargos/${idCargo}/delete`,
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta){
                if(respuesta.status === 200){
                    $("#eliminarCargoModal").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Cargo eliminado exitosamente',

                    }).then(function(){
                        window.location = "cargos";

                    })
                }

            }
        })

    })
});
