<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public/bs5/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/styles.css') }}">
    <title>Hestia - Gestion de asistencia de trabajadores</title>
</head>

<body>
    <div class="contenedor">
        <form action="#" id="asistencia" accept-charset="ISO-8859-1">
            @csrf
            <div class="camara">
                <div id="reader"></div>
            </div>
            <div class="form-floating codigoQr__form">
                <input type="password" readonly class="form-control codigoQr" id="floatingPassword"
                    placeholder="Password" name="codigoQr">
                <label for="floatingPassword">Código QR</label>
            </div>
            <div class="form-group usuario_success">
                <span class="usuario text-success"></span>
            </div>
            <div class="form-group errores">
                <p class="text-danger errores_editar"></p>
            </div>

            <button type="submit" class="btn btn-primary mt-3 btnCodigoQr">Marcar</button>
        </form>
        <audio id="audio" controls>
            <source type="audio/wav" src="{{ asset('public/utils/timbre.wav') }}">
        </audio>
    </div>
    <div class="logo__container">
        <img src="{{ asset('public/img/logo.png') }}" alt="logo fpyme">
    </div>
    @section('scripts')


        <script src="{{ asset('public/lteadmin') }}/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('public/utils/qrscanner.min.js') }}"></script>
        <script>
            $("#asistencia").on("submit", function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                console.log("loading... " + data)
                $.ajax({
                    type: 'post',
                    data: data,
                    url: 'asistencia',
                    dataType: 'json',
                    success: function(r) {
                        console.log(r.resp);
                        if (r.status === 400) {
                            $.each(r.errors, function(key, err_values) {
                                //Display error
                                setTimeout(() => {
                                    $('.errores_editar').text("");
                                }, 2500);
                            })
                        } else {
                            $('.errores_editar').text("");
                            if (r.resp === 'exito') {
                                $('.errores_editar').text("");
                                $('.usuario').text(r.usuario);

                                document.getElementById("audio").play();
                                setTimeout(() => {
                                    $('.usuario').text("");
                                }, 2500);

                            } else {
                                $('.errores_editar').text(r.usuario);
                                setTimeout(() => {
                                    $('.errores_editar').text("");
                                }, 2500);
                            }

                        }
                    }
                })
                $(".codigoQr").val("");
            })


            const btnQr =  $(".btnCodigoQr");
            function onScanSuccess(qrCodeMessage) {
                const input = $(".codigoQr");
                input.val(qrCodeMessage);

            }

            setInterval(() => {
                if(($(".codigoQr").val().length > 1)){
                    setTimeout(() => {
                        $(".btnCodigoQr").click();
                        $(".codigoQr").val("");
                    }, 3000);
                }
            }, 3000);

            function onScanError(errorMessage) {
                //handle scan error
            }
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 300
                });
            html5QrcodeScanner.render(onScanSuccess, onScanError);
        </script>
    </body>

    </html>
