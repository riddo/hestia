$(function(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    /***************************************************************************************************************/
/*****ESTO VERIFICA A TRAVÉS DE UN SELECT EL ESTADO DEL EMPLEADO CON RELACION AL INGRESO O SALIDA DE TRABAJO ****/
/***************************************************************************************************************/
$("#empleadoSelector").on("change", function(){

    $("#salida").prop("checked", false);
    $("#ingreso").prop("checked", false);
    let data = this.value;
    $.ajax({
        data:  {
            "_token": $("meta[name='csrf-token']").attr("content"),
            empleadoId: data,
        },
        url: "verifAsist",
        method: "POST",
        success: function(resp){
            const empleadoEstado = resp.estado;

            if(empleadoEstado === 0){
                $("#salida").prop("disabled", true);
                $("#ingreso").prop("disabled", false);
                //$("#salida").prop("checked", false);
                //$("#ingreso").prop("disabled", false);
            }else if(empleadoEstado === 1){
                $("#ingreso").prop("disabled", true);
                $("#salida").prop("disabled", false);
                //$("#ingreso").prop("checked", false);
                //$("#salida").prop("disabled", false);
            }

        }


    })
});

$("#asistenciaForm").on('submit', function(e){
    e.preventDefault();
    const data = $(this).serialize();

    $.ajax({
        data: data,
        url: "asistencia/save",
        method: "POST",

        success: function(r){
            if(r.status === 400){
                $.each(r.errors, function (key, err_values) {
                    $('.errores_editar').text(err_values);
                })
            }

            if (r.resp === 'exito') {
                $("#nuevoAsistencia").modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: ' Registro agregado satisfactoriamente',
                }).then(function(){
                    window.location = "asistencias";
                })



            }
        }
    })
})

$("#tablaAsistencias").on('click', '.editarAsistencia', function(e){
    e.preventDefault();
    const idRegistro = $(this).val();

    $("#editarAsistenciaTitulo").text(`Editar Asistencia ID: ${idRegistro}`);

    $.ajax({
        type: "GET",
        url: `asistencia/${idRegistro}`,
        success: function (respuesta) {

            if (respuesta.status === 200) {
                $("#fechaHoraRegistro").val(respuesta.fecha);
                $("#idAsistencia").val(idRegistro);
            }
        }

    })
})



    $("#editarAsistenciaForm").on('submit', (e) => {
        e.preventDefault();
        const idAsistencia = $("#idAsistencia").val();

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //     }
        // });
        $.ajax({
            type: "PUT",
            url: `asistencia/${idAsistencia}/update`,
            data: $("#editarAsistenciaForm").serialize(),
            dataType: 'json',
            success: function(respuesta){
                console.log(respuesta)
                if(respuesta.status === 400){
                    $.each(respuesta.errors, function (key, err_values) {
                        $('.errores_editar').text(err_values);
                    })
                }
                else if(respuesta.status === 200){
                    $("#editarAsistenciaModal").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Fecha actualizada satisfactoriamente',

                    }).then(function(){
                        window.location = "asistencias";
                    })

                }
            }

        })
    })
})
