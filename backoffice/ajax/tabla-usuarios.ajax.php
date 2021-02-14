<?php 

// Llamndo controladores y modelos de usuarios
 require_once "../controladores/usuarios.controlador.php";
 require_once "../modelos/usuarios.modelo.php";
 // Controlador de rutas
 require_once "../controladores/general.controlador.php";

  class TablaUsuarios{

    public function mostrarTabla(){
      // Como necesito a todos pongo parametros null
      // NOta que estas variables se usan de igual forma en usuarios.php, aunque no es necesario, si queres puedes comentarlos ahí
      $item=null;
      $valor=null;
      $usuarios=ControladorUsuarios::ctrMostrarUsuario($item, $valor);
      // variables generales definidas del ControladorGeneral en general.controlador.php
      $ruta=ControladorGeneral::ctrRuta();
      
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
          
          // No muestra al admin
          if($value["perfil"] != "admin"){


          /*----------  Si trae foto  ----------*/
           if($value["foto"] == ""){
            // Tener cuidado con las comillas simples
            $foto = "<img src='vistas/img/usuarios/default/default.png' class='img-fluid rounded-circle' width='30px'>";
            }else{

            $foto = "<img src='".$value["foto"]."' class='img-fluid rounded-circle' width='30px'>";

          }

          /*----------  Mostrar si está suscrito  ----------*/
            if($value["suscripcion"] == 0){

              $suscripcion = "<button type='button' class='btn btn-danger btn-sm'>Desactivada</button>";

             }else{

              $suscripcion = "<button type='button' class='btn btn-success btn-sm'>Activada</button>";
            }

          // Contenido de datos JSON
          $datosJson.='[
                "'.($key+0).'",
                "'.$foto.'",
                "'.$value["nombre"].'",
                "'.$value["email"].'",
                "'.$value["pais"].'",
                "'.$suscripcion.'",
                "'.$value["id_suscripcion"].'",
                "'.$value["ciclo_pago"].'",
                "'.$ruta.$value["enlace_afiliado"].'",
                "'.$value["patrocinador"].'",
                "'.$value["paypal"].'",
                "'.$value["fecha"].'",
                "'.$value["vencimiento"].'"
          ],';
        }

      }

      // Borra la coma del ultimo dato json, osea la coma esta jeje (],'')
      $datosJson=substr($datosJson,0, -1);

      // Finaliza sintaxis datos json
      $datosJson.=']}';

      // muestra los datos json en usuarios.php
      echo $datosJson;

    }//Cierre metodo

  }//Cierre clase

// Instanciamos la clase
$activarTabla = new TablaUsuarios();
$activarTabla->mostrarTabla();
