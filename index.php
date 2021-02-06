<?php 

 require_once "controladores/plantilla.controlador.php";
 require_once "controladores/ruta.controlador.php"; //Para llamar a http://localhost/ventas-sucripcion"

// Instancia la clase ControladorPlantilla que se encuentra en controladores/plantilla.controlador.php
 $plantilla = new ControladorPlantilla();
 // Ejecuta el metodo ctrPlantilla
 $plantilla->ctrPlantilla();