<?php
if(!$_POST){
    header('insertAlum.php');
}
else {
   
    require 'Conexion.php';
   
    $legajo = htmlentities($_POST['legajo']);
    $nombre = htmlentities($_POST ['nombre']);
    $apellido = htmlentities($_POST ['apellido']);
    $genero = htmlentities($_POST['genero']);
    $id_cuatri = htmlentities($_POST['cuatri']);
    $turno = htmlentities($_POST['turno']);

    if (isset($_POST['insertar'])) {
        $stmt = $conexion->prepare("INSERT INTO `alumnos` (`legajo`, `nombre`, `apellido`, `genero`, `id_cuatri`, `turno`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssis", $legajo, $nombre, $apellido, $genero, $id_cuatri, $turno);
    
        if ($stmt->execute()) {
            header('location:insertAlum.php?info=1');
        } else {
            header('location:insertAlum.php?err=1');
        }
    } else if (isset($_POST['modificar'])) {
        $stmt = $conexion->prepare("UPDATE alumnos SET  nombre = ?, apellido = ?, genero = ?, turno = ? WHERE legajo = ?");
        $stmt->bind_param("sssss", $nombre, $apellido, $genero, $turno, $legajo);
        if ($stmt->execute()) {
            header('location:verAlum.php?legajo=' . $legajo . '&info=1');
        } else {
            header('location:verAlum.php?legajo=' . $legajo . '&err=1');
        }
    }

}
?>
