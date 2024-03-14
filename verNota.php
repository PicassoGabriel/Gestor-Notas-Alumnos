<!DOCTYPE html>
<?php
require 'Conexion.php';

$notas = $conexion->prepare("SELECT
                            a.legajo,
                            a.nombre,
                            a.apellido,
                            a.id_cuatri AS Cuatrimestre,
                            a.turno,
                            m.materia,
                            n.id_notas,
                            n.faltas,
                            n.parcial1,
                            n.parcial2,
                            n.recu1,
                            n.recu2,
                            n.tp,
                            n.final,
                            n.sitAcademica
                            FROM
                            alumnos AS a
                            JOIN notas n ON a.legajo = n.legajo
                            JOIN materias m ON n.id_materia = m.id_materia  WHERE n.parcial1 <> 0 OR n.parcial2 <> 0 OR n.recu1 <> 0 OR n.recu2 <> 0 OR n.tp <> 0 OR n.final <> 0 ORDER BY Cuatrimestre ASC;");
$notas->execute();
$resultado = $notas->get_result();
$notas = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<html>

<head>
    <title>Notas | Consulta de Notas</title>
    <meta name="description"/>
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="header">
        <h1>Centro Universitario De la Inovación</h1>
    </div>
    <nav>
        <ul>
        <li><a href="index.php">Inicio</a> </li>
        <li><a href="insertAlum.php">Alumnos</a> </li>
        <li><a href="verNota.php">Materias</a> </li>
        </ul>
    </nav>

    <div class="body">
        <div class="panel">
            <h3>Consulta de Notas</h3>
                <br>
                <a href="insertNota.php"><strong><< Volver</strong></a>
                <br>
                <br>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Legajo</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Cuatrimestre</th>
                        <th>Turno</th>
                        <th>Materia</th>
                        <th>Faltas</th>
                        <th>1er Parcial</th>
                        <th>2do Parcial</th>
                        <th>1er Recu.</th>
                        <th>2do Recu.</th>
                        <th>TP</th>
                        <th>Final</th>
                        <th>Situacion Academica</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <?php
                       
                            foreach ($notas as  $nota) :?>
                            <tr>
                            <td align="center"><?php echo $nota['legajo'] ?></td>
                            <td><?php echo $nota['apellido'] ?></td>
                            <td><?php echo $nota['nombre'] ?></td>
                            <td><?php echo $nota['Cuatrimestre'] ?></td>
                            <td><?php echo $nota['turno'] ?></td>
                            <td><?php echo $nota['materia'] ?></td>
                            <td><?php echo $nota['faltas']?></td>
                            <td><?php echo $nota['parcial1'] ?></td>
                            <td><?php echo $nota['parcial2'] ?></td>
                            <td><?php echo $nota['recu1'] ?></td>
                            <td><?php echo $nota['recu2'] ?></td>
                            <td><?php echo $nota['tp'] ?></td>
                            <td><?php echo $nota['final'] ?></td>
                            <td><?php echo $nota['sitAcademica'] ?></td>
                            <td><?php echo '<a href="editNota.php?id_notas='.$nota['id_notas'].'">Editar</a> '?></td>
                            <td><?php echo '<a href="delNota.php?id_notas='.$nota['id_notas'].'">Eliminar</a>'?></td>
                        </tr>
                           <?php endforeach;?>
                </table>

                <br>
        </div>
    </div>

    <footer>
        <p>Recuerden tomar agua</p>
    </footer>

</body>

</html>