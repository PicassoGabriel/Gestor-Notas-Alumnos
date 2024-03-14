<!DOCTYPE html>
<?php
require "Conexion.php";


$cuatri = $conexion->prepare("SELECT * FROM cuatri");
$cuatri->execute();
$resultado_cuatri = $cuatri->get_result();
$cuatri = $resultado_cuatri->fetch_all(MYSQLI_ASSOC);

?>
<html>
<head>
<title>Inicio | Registro de Notas</title>
    <meta name="description" />
    <link rel="stylesheet" href="CSS/style.css" />

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
            <h4>Registro de Alumnos</h4>
            <form method="post" class="form" action="auxAlum.php">
                <label>Legajo</label><br>
                <input type="number"  class="number" name="legajo">
                <br><br>
                <label>Nombre</label><br>
                <input type="text" required name="nombre" >
                <br>
                <label>Apellido</label><br>
                <input type="text" required name="apellido" >
                <br><br>
                <label>Genero</label><br>
                <input required type="radio" required name="genero" value="M"> Masculino
                <input required type="radio" name="genero" required value="F"> Femenino
                <input required type="radio" name="genero" required value="X"> Otro
                <br><br>
                <label>Cuatrimestre</label><br>
                <select name="cuatri" required>
                    <?php foreach ($cuatri as $cuatri):?>
                        <option value="<?php echo $cuatri['id_cuatri'] ?>"><?php echo $cuatri['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <label>Turno</label><br>
                <select name="turno" id="turno">
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Noche">Noche</option>
                </select>
                <br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="verAlum.php">Ver Alumnos</a>
                <br><br>
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al registrar al alumno</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Alumno registrado correctamente!</span>';
                ?>

            </form>
        <?php
        if(isset($_GET['err']))
            echo '<span class="error">Error al guardar</span>';
        ?>
        </div>
</div>

<footer>
    <p>Recuerden tomar agua</p>
</footer>

</body>

</html>