<?php 
 require_once "controladores/plantilla.controlador.php";
 // Llamando al controlador de ruta, valor suscripcion y patrocinador
 require_once "controladores/general.controlador.php";
 
 // Llamando al controlador y modelo usuarios
 require_once "controladores/usuarios.controlador.php";
 require_once "modelos/usuarios.modelo.php";

 // Instancia la clase ControladorPlantilla que se encuentra en controladores/plantilla.controlador.php
 $plantilla = new ControladorPlantilla();
 // Ejecuta el metodo ctrPlantilla
 $plantilla->ctrPlantilla();