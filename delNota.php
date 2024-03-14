<?php
require 'Conexion.php';

    if ( isset($_GET['id_notas'])) {
        try {
            
            $id_notas = $_GET['id_notas'];
            $alumno = $conexion->prepare("DELETE FROM notas WHERE  id_notas = ?");
            $alumno->bind_param("i", $id_notas);
            $alumno->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        die('Ha ocurrido un error');
    }

?>