<?php
require "Conexion.php";
if (isset($_GET['legajo']) && is_numeric($_GET['legajo'])) {
    try {
        $legajo = $_GET['legajo'];
       // Paso 1: Eliminar registros relacionados en la tabla 'notas'
       $eliminarNotas = $conexion->prepare("DELETE FROM notas WHERE legajo = ?");
       $eliminarNotas->bind_param("i", $legajo);
       $eliminarNotas->execute();

       // Paso 2: Eliminar el alumno después de eliminar las notas
       $eliminarAlumno = $conexion->prepare("DELETE  FROM alumnos WHERE legajo = ?");
       $eliminarAlumno->bind_param("i", $legajo);
       $eliminarAlumno->execute();
        header('location:verAlum.php');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    die('Ha ocurrido un error');
}
?>