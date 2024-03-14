<?php
require 'Conexion.php';

if (isset($_POST['insertar'])) {
    $materias = $_POST['materia'];
    $faltas = $_POST['faltas'];
    $parcial1 = $_POST['parcial1'];
    $parcial2 = $_POST['parcial2'];
    $recu1 = $_POST['recu1'];
    $recu2 = $_POST['recu2'];
    $tp = $_POST['tp'];
    $final = $_POST['final'];
    $sitAcademica = $_POST['sitAcademica'];


    foreach ($materias as $legajo => $id_materia) {
     
        $falta = $faltas[$legajo];
    $p1 = $parcial1[$legajo];
    $p2 = $parcial2[$legajo];
    $r1 = $recu1[$legajo];
    $r2 = $recu2[$legajo];
    $t = $tp[$legajo];
    $f = $final[$legajo];
    $sa = $sitAcademica[$legajo];
        $consulta = $conexion->prepare("INSERT INTO notas (legajo, id_materia, faltas, parcial1, parcial2, recu1, recu2, tp, final, sitAcademica) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("ssssssssss", $legajo, $id_materia, $falta, $p1, $p2, $r1, $r2, $t, $f, $sa);
        $consulta->execute();

    }

 
    header("Location: insertNota.php?info=success");
    exit();
}elseif (isset($_POST['modificar'])) {

$legajo = $_POST['legajo'];
$parcial1 = $_POST['parcial1'];
$parcial2 = $_POST['parcial2'];
$recu1 = $_POST['recu1'];
$recu2 = $_POST['recu2'];
$tp = $_POST['tp'];
$final = $_POST['final'];
$sitAcademica = $_POST['sitAcademica'];


$consulta = $conexion->prepare("UPDATE notas SET parcial1=?, parcial2=?, recu1=?, recu2=?, tp=?, final=?, sitAcademica=? WHERE legajo=?");


if ($consulta) {
    $consulta->bind_param("ssssssss", $parcial1, $parcial2, $recu1, $recu2, $tp, $final, $sitAcademica, $legajo);
    $consulta->execute();

    if ($consulta->affected_rows > 0) {
        header("Location: insertNota.php?info=success");
        exit();
    } else {
        echo "Error al actualizar. Verifica tus datos y consulta.";
    }
} else {
    echo "Error al preparar la consulta de actualización.";
}
} else {

header("Location: insertNota.php");
exit();
}

    header("Location: insertNota.php?info=success");
    exit();

?>