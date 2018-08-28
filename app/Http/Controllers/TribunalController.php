<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Clase que controlara todo
 */
class TribunalController extends Controller
{

  public function dependencia($uuid=null){
    $data = $this->callApi("dependencias",$uuid);
    $_data = json_decode($data);
    if ($_data) {
      $content = "<tr><th>Dependencia</th><th>Opciones</th></tr>";
      foreach ($_data as $key => $val) {
        $content .= "<tr>";
        $content .= "<td>$val->dependencia</td>";
        $content .= "<td><a href='#edit_reg' id='$val->uuid' class='edit' data-toggle='modal'>Editar</a>  <a href='#delete_reg' id='$val->uuid' class='delete'  data-toggle='modal'>Eliminar</a></td>";
        $content .= "</tr>";
      }
    }else{
      $content = "<tr><td>No se encontraron resultados</td></tr>";
    }
    return view("tribunal.show",array("met"=>"dependencias","link" => "autoridades","uuid"=>$uuid,"_data" => $content, "data" => $data));
  }

  public function autoridad($uuid=null){
    $data = $this->callApi("autoridades",$uuid);
    $select = json_decode($this->callApi("dependencias"));
    $_data = json_decode($data);

    if ($_data) {
      $content = "<tr><th>Nombre(Puesto)</th><th>Email</th><th>Opciones</th></tr>";
      foreach ($_data as $key => $val) {
        $content .= "<tr>";
        $content .= "<td>$val->nombre $val->apellido_paterno $val->apellido_materno ($val->cargo)</td>";
        $content .= "<td>$val->email</td>";
        $content .= "<td><a href='#edit_reg' id='$val->uuid' class='edit' data-toggle='modal'>Editar</a>  <a href='#delete_reg' id='$val->uuid' class='delete'  data-toggle='modal'>Eliminar</a></td>";
        $content .= "</tr>";
      }
    }else{
      $content = "<tr><td>No se encontraron resultados</td></tr>";
    }
    return view("tribunal.show",array("met"=>"autoridades","link" => "dependencias","uuid"=>$uuid,"_data" => $content, "data" => $data, "select" => $select));
  }

  public function callApi($param="dependencias",$uuid=null){
    $filter = $uuid ? "$param/${uuid}" : "$param";
    // Crear un flujo
    $opciones = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Content-Type: text/xml\r\n"
      )
    );

    $contexto = stream_context_create($opciones);
    // Abre el fichero usando las cabeceras HTTP establecidas arriba
    $fichero = file_get_contents("http://localhost:81/Api/${filter}", false, $contexto);
    return $fichero;
  }

  public function change_rec(){

  }

}



?>
