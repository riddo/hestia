<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
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

}
