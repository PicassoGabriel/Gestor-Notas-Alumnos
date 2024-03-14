<?php
require 'Conexion.php';

$alumnos = $conexion->prepare("SELECT a.legajo, a.nombre, a.apellido, a.genero, a.turno, b.nombre AS cuatrimestre FROM alumnos AS a INNER JOIN cuatri AS b ON a.id_cuatri = b.id_cuatri ;");
$alumnos->execute();
$resultado = $alumnos->get_result();
$alumnos = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Alumnos | Registro de Notas</title>
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
        <li><a href="insertNota.php">Materias</a> </li>


    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Alumnos</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Legajo</th><th>Apellido</th><th>Nombre</th><th>Genero</th><th>Cuatrimestre</th><th>Turno</th>
                    <th>Editar</th><th>Eliminar</th>
                </tr>
                <?php foreach ($alumnos as $alumno) :?>
                <tr>
                    <td align="center"><?php echo $alumno['legajo'] ?></td><td><?php echo $alumno['apellido'] ?></td>
                    <td><?php echo $alumno['nombre'] ?></td><td align="center"><?php echo $alumno['genero'] ?></td>
                    <td align="center"><?php echo $alumno['cuatrimestre'] ?></td><td align="center"><?php echo $alumno['turno'] ?></td>
                    <td><a href="editAlum.php?legajo=<?php echo $alumno['legajo'] ?>">Editar</a> </td>
                    <td><a href="delAlum.php?legajo=<?php echo $alumno['legajo'] ?>">Eliminar</a> </td>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="insertAlum.php">Agregar Alumno</a>
                <br><br>
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al registrar al alumno</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Alumno registrado correctamente!</span>';
                ?>


        </div>
</div>

<footer>
    <p>Recuerden tomar agua</p>
</footer>

</body>

</html>