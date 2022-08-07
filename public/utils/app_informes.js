$(function(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    const formularioInformes = $("#consultarInforme");

    // formularioInformes.on('submit', function(e){
    //     //e.preventDefault();
    //     const idEmpleado = $("#idEmpleado").val();
    //     //obtener fechas
    //     const fechas = $("#fechaRegistro").val();
    //     const fechaSplit = (fechas.split(" - "));
    //     const fechaSplit1 = fechaSplit[0].split("/");
    //     const fechaInicio = `${fechaSplit1[0]}-${fechaSplit1[1]}-${fechaSplit1[2]}`;

    //     const fechaSplit2 = fechaSplit[1].split("/");
    //     const fechaFin =  `${fechaSplit2[0]}-${fechaSplit2[1]}-${fechaSplit2[2]}`;
    //      $.ajax({
    //          data:   {
    //              "_token": $("meta[name='csrf-token']").attr("content"),
    //              "fechaInicio": fechaInicio,
    //              "fechaFin" : fechaFin,
    //              "idEmpleado" : idEmpleado
    //          },
    //          url: `registros/consultar`,
    //          type: "POST",
    //          success: function(response){
    //              if(response.status === 400){
    //                  $.each(response.errors, function (key, err_values) {
    //                      $('.errores_editar').text(err_values);
    //                      setTimeout(() => {
    //                          $('.errores_editar').text("");
    //                      }, 2500);
    //                  })
    //              }
    //              else if(response.status === 401){

    //                  $('.errores_editar').text("Debe registrar la salida del trabajador");
    //                  setTimeout(() => {
    //                      $('.errores_editar').text("");
    //                  }, 2500);

    //              }
    //              else if(response.status === 402){

    //                  $('.errores_editar').text("No hay registros");
    //                  setTimeout(() => {
    //                      $('.errores_editar').text("");
    //                  }, 2500);

    //              }
    //          }

    //      })
    // })






})
