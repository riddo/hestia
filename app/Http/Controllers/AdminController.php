<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Empleado;
use Session;
class AdminController extends Controller
{
    //Login

    function login(){
        return view('admin.login');
    }

    //Check Login

    function checkLogin(Request $request){
        $request->validate([
            "username" => "required",
            "password" => "required"
        ],[
            "username.required" => "Debes ingresar el nombre de usuario",
            "password.required" => "Debes ingresar la contraseña"
        ]);

        $admin = Admin::where(['username' => $request->username, 'password' => sha1($request->password)])
            ->count();

        if($admin > 0){
            $adminData = Admin::where(['username' => $request->username, 'password' => sha1($request->password)])
                ->get();

            session(['adminData' => $adminData]);

            return redirect('admin');
        }else{
            return redirect('admin/login')->with('msg', 'Usuario o contraseña inválidos');
        }
    }
    //Logout

    function logout(){
        session()->forget('adminData');
        return redirect('admin/login');
    }


    public function getInfo(){
        $empleados = Empleado::all();
        $cantidadEmpleados = Empleado::count();
        $empleadosActivos = Empleado::where(['estado_turno' => 1])->count();
        $empleadosInactivos = Empleado::where(['estado_turno' => 0])->count();
        return view('admin.dashboard', ["empleados" => $empleados,
        "cantidadEmpleados" => $cantidadEmpleados,
        "activos" => $empleadosActivos,
        "inactivos" => $empleadosInactivos]);
    }

    public function config($id){



        $admin = Admin::find($id);
        if($admin){
            return view("admin.config", ["admin" => $admin]);
        }
        else{
            return view("admin.login");
        }

    }

    public function update(Request $request){
        $id = $request->id;
        $username = $request->username;
        $fullname = $request->fullname;
        $empresa = $request->empresa;
        $email= $request->email;

        $admin = Admin::find($id);

        $admin->username = $username;
        $admin->nombreCompleto = ucfirst($fullname);
        $admin->empresa = ucfirst($empresa);
        $admin->correo = $email;

        $admin->update();
        return redirect('admin/config/'.$admin->id)->with('msg', 'Actualizado');

    }
}
