<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;

/**
 * Clase para inicio de sesion
 */
class UserController extends Controller
{


  public function login(Request $request){
    $user = $request->input("usr");
    $pass = md5($request->input("pass"));

    $auth = DB::table('user')->where('name',$user)->where('passwd',$pass)->first();
    if ($auth) {
      return redirect('inicio');
    }else{
      //Contraseña o usuario incorrectos
    }
  }


}


?>
