$(function(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const validarRut = {
        validar: function(rutCompleto){
            rutCompleto = rutCompleto.replace("-", "-");
            if(!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto)) return false;

            let rutSplit = rutCompleto.split("-");
            let digitoVerif = rutSplit[1];
            let rutSinGuion = rutSplit[0];

            if(digitoVerif == "K") digitoVerif = 'k';

            return (validarRut.dv(rutSinGuion) == digitoVerif);

        },
        dv : function(T){
            var M=0,S=1;
            for(;T;T=Math.floor(T/10))
                S=(S+T%10*(9-M++%6))%11;
            return S?S-1:'k';
        }
    }
    const hasOptions = $('#cargoEmpleado option').filter(function() { return !this.disabled; }).length;
    if(hasOptions <= 0){
        $(".btnGuardar").prop('disabled', true);
        $(".errores").text("Agregue cargo primero");
    }

    $("#empleadoForm").on('submit', function(e){
        e.preventDefault();
        if(!validarRut.validar($("#rutEmpleado").val())){
            $(".errores").text("El rut es inválido")
        }
        else{
            $.ajax({
                data: $(this).serialize(),
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                dataType: 'json',
                success:function(respuesta){
                    if(respuesta.status === 400){
                        Object.entries(respuesta.errors).forEach(([llave, valor]) => {
                            $(".errores").text(valor);
                          });
                    }
                    else{
                        $("#nuevoempleado").modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Empleado agregado satisfactoriamente',
                        }).then(function(){
                            window.location = "empleados";
                        })
                    }
                }
            })
        }

    })

    $("#tablaEmpleados").on('click', '.editarEmpleadoBtn', function(e){
        e.preventDefault();
        const idEmpleado = $(this).val();
        $("#editarEmpleadoModal").modal('show');
        $("#idEditarEmpleado").val(idEmpleado);

        $.ajax({
            type: 'GET',
            url: `empleados/${idEmpleado}/edit`,
            success: function(respuesta){
                $("#editarNombreEmpleado").val(respuesta.empleado.empleado_nombre);
                $("#editarApellidoEmpleado").val(respuesta.empleado.empleado_apellido);
                $("#editarRutEmpleado").val(respuesta.empleado.empleado_rut);
                $("#editarFonoEmpleado").val(respuesta.empleado.empleado_fono);
                $("#editarDireccionEmpleado").val(respuesta.empleado.empleado_direccion);
                $("#editarEmailEmpleado").val(respuesta.empleado.empleado_correo);
                $("#editarGeneroEmpleado").val(respuesta.empleado.empleado_genero);
                $(`#editarCargoEmpleado option:eq(${respuesta.empleado.empleado_idCargo})`).prop('selected', true);

            }
        })
    })

    $("#editarEmpleadoForm").on('submit', function(e){
        e.preventDefault();
        const idEmpleado = $("#idEditarEmpleado").val();

        if(!validarRut.validar($("#editarRutEmpleado").val())){
            $(".errores_editar").text("El rut es inválido")
        }else{
            $.ajax({
                type: "PUT",
                url: `empleados/${idEmpleado}`,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(respuesta){
                    if(respuesta.status === 400){
                        $.each(respuesta.errors, function (key, err_values) {
                            $('.errores_editar').text(err_values);
                        })
                    }
                    else if(respuesta.status === 404){
                        Toast.fire({
                            icon: 'error',
                            title: ' No existe el empleado u ocurrió un problema'
                        })
                    }
                    else{
                        $("#editarEmpleadoModal").modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: ' Empleado actualizado satisfactoriamente',

                        }).then(function(){
                            window.location = "empleados";
                        })

                    }
                }
            })
        }

    })


      /***Eliminar Empleado***/

      $("#tablaEmpleados").on('click', '.eliminarEmpleadoBtn', function(e) {
        const id = $(this).val();
        e.preventDefault();
        $("#idEliminarEmpleado").val(id);
        $("#eliminarEmpleadoModal").modal('show');

    })

    $(document).on('click', '.eliminarEmpleado', function(e){
        e.preventDefault();
        const idEmpleado = $("#idEliminarEmpleado").val();

        $.ajax({
            type: "DELETE",
            url: `empleados/${idEmpleado}/delete`,
            dataType: 'json',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta){
                if(respuesta.status === 200){
                    $("#eliminarEmpleadoModal").modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: ' Empleado eliminado exitosamente',

                    }).then(function(){
                        window.location = "empleados";
                    })
                }

            }
        })

    })
})
