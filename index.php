<?php 

 require_once "controladores/plantilla.controlador.php";
 require_once "controladores/ruta.controlador.php"; //Para llamar a http://localhost/ventas-sucripcion"

 // Llamndo controladores y modelos de usuarios
 require_once "backoffice/controladores/usuarios.controlador.php";
 require_once "backoffice/modelos/usuarios.modelo.php";
// Llamndo al archivo autoload de PHPMailer
 require_once "backoffice/extensiones/vendor/autoload.php";

// Instancia la clase ControladorPlantilla que se encuentra en controladores/plantilla.controlador.php
 $plantilla = new ControladorPlantilla();
 // Ejecuta el metodo ctrPlantilla
 $plantilla->ctrPlantilla();