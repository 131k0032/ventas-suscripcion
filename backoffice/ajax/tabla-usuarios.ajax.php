<?php 

// Llamndo controladores y modelos de usuarios
 require_once "../controladores/usuarios.controlador.php";
 require_once "../modelos/usuarios.modelo.php";


  class TablaUsuarios{

    public function mostrarTabla(){
      // Como necesito a todos pongo parametros null
      // NOta que estas variables se usan de igual forma en usuarios.php
      $item=null;
      $valor=null;
      $usuarios=ControladorUsuarios::ctrMostrarUsuario($item, $valor);
      
      // Si no hay usuarios
      if (count($usuarios)==0) {
        // Retorna vacio
        echo '{"data":[]}';

        // Para que no siga avanzando el code
        return;
      }

      // Inicia formato datos json
      $datosJson='{"data":[';
  
        // Recorremos los elementos
        foreach ($usuarios as $key => $value) {
          $datosJson.='[
                "'.($key+1).'",
                "'.$value["foto"].'",
                "'.$value["nombre"].'",
                "'.$value["email"].'",
                "'.$value["pais"].'",
                "'.$value["suscripcion"].'",
                "'.$value["id_suscripcion"].'",
                "'.$value["ciclo_pago"].'",
                "'.$value["enlace_afiliado"].'",
                "'.$value["patrocinador"].'",
                "'.$value["paypal"].'",
                "'.$value["fecha"].'",
                "'.$value["vencimiento"].'"
          ],';
        }

      // Borra la coma del ultimo dato json, osea la coma esta jeje (],'')
      $datosJson=substr($datosJson,0, -1);

      // Finaliza sintaxis datos json
      $datosJson.=']}';


      echo $datosJson;

    }//Cierre metodo

  }//Cierre clase

// Instanciamos la clase
$activarTabla = new TablaUsuarios();
$activarTabla->mostrarTabla();
