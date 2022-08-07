<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Mail;
class Asistencia extends Model
{

    use HasFactory;
    public $timestamps = false;



    public function empleados(){
        return $this->belongsTo(Empleado::class, 'asistencia_idEmpleado');
    }


    public static function enviarEmail($correo, $empleado, $asistencia, $pdf){

        // Storage::put('public/storage/uploads/'.'-'.rand().'_'.time(). '-'.'pdf', $pdf->output());
        $path = Storage::put('public/storage/uploads/'.$empleado->empleado_rut.'.pdf', $pdf->output());
        Storage::put($path, $pdf->output());

        $data['nombreCompleto'] = $empleado->empleado_nombre." ".$empleado->empleado_apellido;
        $data['run'] = $empleado->empleado_rut;
        $data["asistenciaTipo"] = $asistencia->registro_tipo;
        $data["asistenciaFecha"] = date("d-m-Y H:i", strtotime($asistencia->registro_fecha));
        $data['email'] = $empleado->empleado_correo;

        Mail::send("email.email_empleado_detalle", $data, function ($message) use($correo, $empleado, $asistencia, $pdf, $path) {
            $message->from('hestiaDmin@fpymeatacama.cl', env('APP_NAME'));
            //$message->sender('john@johndoe.com', 'John Doe');

            $message->to($correo);
            $message->cc($empleado->empleado_correo);
            //$message->bcc('john@johndoe.com', 'John Doe');
            //$message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Asistencia');
            $message->priority(3);
            $message->attachData($pdf->output(), $path, [
                 "mime" => "application/pdf",
                 "as" => $empleado->empleado_rut. "."."pdf",
             ]);
            //$message->attach('pathToFile');
        });
    }
}
