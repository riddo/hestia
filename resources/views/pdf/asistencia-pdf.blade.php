<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
    .container{
        max-width: 50%;
        margin: 0 auto;
    }
    .ticket{
        border: solid 1px #ccc;
        padding: 20px;
        border-radius: 10px;
    }

    h1,h2,p{
        font-family: 'Roboto', sans-serif;
    }

    h1{
        text-align: center;
        font-size: 24px;
    }
    h2{
        font-size: 20px
    }
    .parrafo{
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="ticket">

        <h2>Comprobante de Monitoreo</h2>
        <p><span class="parrafo">Nombre Completo:</span>  {{$nombreCompleto}}</p>
        <p><span class="parrafo">RUN:</span>{{$run}}</p>
        <p><span class="parrafo">Fecha:</span> {{$asistenciaFecha}}</p>
        <p><span class="parrafo">Tipo:</span> {{$asistenciaTipo}}</p>
    </div>

</div>
