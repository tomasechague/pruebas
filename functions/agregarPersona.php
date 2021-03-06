<?php
session_start();
include 'funciones.php';

$pdo = conectar();
$statement = $pdo->prepare("INSERT INTO personas(dni,nombre,apellido,fecha_nacimiento) VALUE (:dni,:nombre, :apellido, :fecha_nacimiento)");
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$nacimiento = $_POST['nacimiento'];
$errores = validarPersona($dni, $nombre, $apellido, $nacimiento);

if(count($errores) == 0){

$statement->bindParam(':fecha_nacimiento',  desformatearFechaNacimiento($nacimiento));
$statement->bindParam(':nombre', $nombre);
$statement->bindParam(':apellido', $apellido);
$statement->bindParam(':dni', $dni);
$statement->execute();

$mensaje = "La persona ha sido agregada satisfactoriamente";
header("Location: ../web/exito.php?mensaje=$mensaje");
}else{
    if(!isset($errores['nombre'])){
        $_SESSION['form_persona']['nombre']= $nombre;
    }
    if(!isset($errores['apellido'])){
        $_SESSION['form_persona']['apellido']= $apellido;
    }
    if(!isset($errores['dni'])){
        $_SESSION['form_persona']['dni']= $dni;
    }
    if(!isset($errores['nacimiento'])){
        $_SESSION['form_persona']['nacimiento']= $nacimiento;
    }
    
    
    $mensajes = implode('<br>', $errores);
   header("Location: ../web/formAgregarPersona.php?mensaje=$mensajes"); 
    
   
    }
?>    
