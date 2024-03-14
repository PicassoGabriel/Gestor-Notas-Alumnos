<!DOCTYPE html>
<?php
require 'Conexion.php';

if (isset($_GET['id_notas'])) {
    $id_notas = $_GET['id_notas'];

    $notas = $conexion->prepare("SELECT * FROM notas WHERE id_notas = ?");
    $notas->bind_param("i", $id_notas);
    $notas->execute();
    $resultado_notas = $notas->get_result();
    $notas = $resultado_notas->fetch_assoc();

    $alumno = $conexion->prepare("SELECT * FROM alumnos WHERE legajo = ?");
    $alumno->bind_param("i", $notas['legajo']);
    $alumno->execute();
    $resultado = $alumno->get_result();
    $alumno = $resultado->fetch_assoc();


    $materia=$conexion->prepare("SELECT* FROM materias WHERE id_materia = ?");
    $materia->bind_param("i", $notas['id_materia']);
    $materia->execute();
    $resultado_materia = $materia->get_result();
    $materia = $resultado_materia->fetch_assoc();

 
} else {
    die('Ha ocurrido un error');
}
function generarOpcionesSelect($selectedValue) {
    $options = '';
    for ($i = 0; $i <= 10; $i++) {
        $selected = ($i == $selectedValue) ? 'selected' : '';
        $options .= "<option value='$i' $selected>$i</option>";
    }
    return $options;
}
?>
<html>
<head>
    <title>Inicio | Registro de Notas</title>
    <meta name="description"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="restricciones.js"></script>
</head>
<body>

<div class="header">
    <h1>Centro Universitario De la Innovación</h1>
</div>
<nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="insertAlum.php">Alumnos</a></li>
        <li><a href="verNota.php">Materias</a></li>
    </ul>
</nav>
<div class="body">
    <div class="panel">
        <h4>Edición de Notas</h4>
        <form method="post" class="form" action="auxNota.php">
            <?php if (!empty($alumno) && !empty($notas)) : ?>
                <input type="hidden" value="<?php echo $notas['legajo'] ?>" name="legajo">

                <label><?php echo "Apellido: ";?></label><label><?php echo $alumno['apellido']?></label> <br>
                <label><?php echo "Nombre: ";?></label><label><?php echo $alumno['nombre']?></label> <br>
                <label>Materia</label><br>
                <input type="text" readonly value="<?php echo $materia['materia'] ?>">
                <br>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Faltas</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>1er Recu</th>
                        <th>2do Recu</th>
                        <th>Trabajo Práctico</th>
                        <th>Final</th>
                        <th>Situación Académica</th>
                    </tr>
                    
                        <tr>

                            <td>        
                            <select id="faltas" name="faltas[<?php  echo $notas['faltas'] ?>] " onchange="faltas()">
                                <?php echo generarOpcionesSelect($notas['faltas']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="parcial1" name="parcial1[<?php  echo $notas['parcial1'] ?>] " onchange="parcial1()">
                                <?php echo generarOpcionesSelect($notas['parcial1']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="parcial2" name="parcial2[<?php  echo $notas['parcial2'] ?>] " onchange="parcial2()">
                                <?php echo generarOpcionesSelect($notas['parcial2']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="recu1" name="recu1[<?php  echo $notas['recu1'] ?>] " onchange="parcial1()">
                                <?php echo generarOpcionesSelect($notas['recu1']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="recu2" name="recu2[<?php  echo $notas['recu2'] ?>] " onchange="parcial2()">
                                <?php echo generarOpcionesSelect($notas['recu2']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="tp" name="tp[<?php  echo $notas['tp'] ?>] " onchange="parcial1()">
                            <?php echo generarOpcionesSelect($notas['tp']); ?>
                            </select>
                            </td>
                            <td><input type="number" name="final[<?php echo $alumno['legajo'] ?>]" id="final"/></td>
                            <td><input type="text" name="sitAcademica[<?php echo $alumno['legajo'] ?>]" id="sitAcademica"/></td>
                        </tr>
                    

                </table>
                <button type="submit" name="modificar">Guardar Cambios</button>
                <a class="btn-link" href="verNota.php">Ver Listado</a>
                <br><br>
                <?php
                if (isset($_GET['err']))
                    echo '<span class="error">Error al modificar las notas</span>';
                if (isset($_GET['info']))
                    echo '<span class="success">Notas modificadas correctamente!</span>';
                ?>
            <?php else : ?>
                <p>No se encontraron datos del alumno o notas.</p>
            <?php endif; ?>
        </form>
    </div>
</div>
<footer>
    <p>Recuerden tomar agua</p>
</footer>
</body>
</html>