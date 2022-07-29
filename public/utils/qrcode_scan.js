

    $(".btn__codigoQr").attr("disabled", "true");

    async function onScanSuccess(decodedText, decodedResult) {

        // handle the scanned code as you like, for example:
        //leerQr(decodedText);


    }

    function onScanFailure(error) {

    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);


    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    const leerQr = function(codigo){
    /**Vanilla JS */
        document.querySelector(".codigoQr").value = codigo;
    }

    function procesarAsistencia(){


    }

    // $("#asistencia").on("submit", function(e){
    //     e.preventDefault();

    //     const datos = $(this).serialize();
    //     /** AJAX */


    //     $.ajax({
    //         data: datos,
    //         type: "post",
    //         url: "asistencia",
    //         dataType: "json",
    //         success: function(respuesta){
    //             $(".codigoQr").val("");
    //             if(respuesta.status === 400){
    //                 $.each(respuesta.errors, function (key, err_values) {
    //                     $('.errores_editar').text(err_values);
    //                 })
    //             }else{
    //                 $('.errores_editar').text("");
    //                 if(respuesta.resp === 'exito'){
    //                     $('.usuario').text(respuesta.usuario);
    //                 }else {
    //                     $('.errores_editar').text(respuesta.usuario);
    //                 }

    //             }
    //         }
    //     })
    // })




