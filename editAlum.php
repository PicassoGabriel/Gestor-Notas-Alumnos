<!DOCTYPE html>
<?php
require 'Conexion.php';
if(isset($_GET['legajo'])) {

    $id_alumno = $_GET['legajo'];

    $alumno = $conexion->prepare("SELECT   * from alumnos where legajo = $id_alumno");
    $alumno->execute();
    $resultado = $alumno->get_result();
    $alumno = $resultado->fetch_all(MYSQLI_ASSOC);

    $cuatri = $conexion->prepare("SELECT * FROM cuatri");
    $cuatri->execute();
    $resultado_cuatri = $cuatri->get_result();
    $cuatri = $resultado_cuatri->fetch_all(MYSQLI_ASSOC);

}else{
    Die('Ha ocurrido un error');
}
?>
<html>
<head>
<title>Inicio | Registro de Notas</title>
    <meta name="description" />
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
        <h4>Edición de Alumnos</h4>
        <form method="post" class="form" action="auxAlum.php">
            <?php if (!empty($alumno)) : ?>
              
                <input type="hidden" value="<?php echo $alumno[0]['legajo'] ?>" name="legajo">
                <label>Nombre</label><br>
                <input type="text" required name="nombre" value="<?php echo $alumno[0]['nombre'] ?>">
                <br>
                <label>Apellido</label><br>
                <input type="text" required name="apellido" value="<?php echo $alumno[0]['apellido'] ?>">
                <br><br>
                <label>Genero</label><br>
                <input required type="radio" name="genero" <?php if ($alumno[0]['genero'] == 'M') {echo "checked"; } ?> value="M"> Masculino
                <input type="radio" name="genero" required value="F" <?php if ($alumno[0]['genero'] == 'F') { echo "checked";} ?>> Femenino
                <input type="radio" name="genero" required value="X" <?php if ($alumno[0]['genero'] == 'X') {echo "checked";} ?>> Otro
                <br><br>
                <label>Cuatrimestre</label><br>
                <select name="cuatri" required>
                    <?php foreach ($cuatri as $cuatri) : ?>
                        <option value="<?php echo $cuatri['id_cuatri'] ?>" <?php if ($alumno[0]['id_cuatri'] == $cuatri['id_cuatri']) { echo "selected";} ?>><?php echo $cuatri['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                <label>Turno</label><br>
                <select name="turno" id="turno">
                    <option value="Mañana" <?php if ($alumno[0]['turno'] == 'Mañana') {echo "selected";} ?>>Mañana</option>
                    <option value="Tarde" <?php if ($alumno[0]['turno'] == 'Tarde') {echo "selected";} ?>>Tarde</option>
                    <option value="Noche" <?php if ($alumno[0]['turno'] == 'Noche') {echo "selected";} ?>>Noche</option>
                </select>
                <br><br>
                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="verAlum.php">Ver Listado</a>
                <br><br>
                <?php
                if (isset($_GET['err']))
                    echo '<span class="error">Error al modificar al alumno</span>';
                if (isset($_GET['info']))
                    echo '<span class="success">Alumno modificado correctamente!</span>';
                ?>
            <?php else : ?>
                <p>No se encontraron datos del alumno.</p>
            <?php endif; ?>
        </form>
    </div>
</div>
<footer>
    <p>Recuerden tomar agua</p>
</footer>

</body>

</html>