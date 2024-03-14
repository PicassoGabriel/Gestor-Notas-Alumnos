<?php
require 'Conexion.php';



//consulta alumnos
$alumnos = $conexion->prepare("SELECT * FROM alumnos");
$alumnos->execute();
$resultado = $alumnos->get_result();
$alumnos = $resultado->fetch_all(MYSQLI_ASSOC);

// consulta de cuatrimestres
$cuatrimestres = $conexion->prepare("SELECT * FROM cuatri");
$cuatrimestres->execute();
$resultado_cuatri = $cuatrimestres->get_result();
$cuatrimestres = $resultado_cuatri->fetch_all(MYSQLI_ASSOC);

// consulta las materias
$materias = $conexion->prepare("SELECT * FROM materias");
$materias->execute();
$resultado_mat = $materias->get_result();
$materias = $resultado_mat->fetch_all(MYSQLI_ASSOC);

 // Consulta para obtener los datos de las notas
 $notas = $conexion->prepare("SELECT * FROM notas WHERE parcial1 <> 0 OR parcial2 <> 0 OR recu1 <> 0 OR recu2 <> 0 OR tp <> 0 OR final <> 0");
 $notas->execute();
 $resultado_notas = $notas->get_result();
 $notas = $resultado_notas->fetch_all(MYSQLI_ASSOC);

 $filas_vacias= $conexion->prepare("DELETE FROM notas WHERE parcial1 = 0 AND parcial2 = 0   AND tp = 0  AND final = 0 ");
 $filas_vacias->execute();

 function obtenerNombreMateria($materias, $id_cuatri)
{
    foreach ($materias as $materia) {
        if ($materia['id_cuatri'] == $id_cuatri) {
            return $materia['materia'];
        }
    }
    return '';
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
    <title>Notas | Registro de Notas</title>
    <meta name="description"/>
    <link rel="stylesheet" href="css/style.css" />
    <style>
    
     .table th:nth-child(5),
     .table td:nth-child(5) {
         width: 300px; 
     }
     .table th:nth-child(6),
     .table td:nth-child(6) {
         width: 300px; 
     }
     .table th:nth-child(7),
     .table td:nth-child(7) {
         width: 300px; 
     }
     .table th:nth-child(8),
     .table td:nth-child(8) {
         width: 300px; 
     }
     .table th:nth-child(9),
     .table td:nth-child(9) {
         width: 300px; 
     }
     .table th:nth-child(10),
     .table td:nth-child(10) {
         width: 300px; 
     }
     .table th:nth-child(11),
     .table td:nth-child(11) {
         width: 300px; 
     }
     .table th:nth-child(12),
     .table td:nth-child(12) {
         width: 300px; 
     }
     .table th:nth-child(13),
     .table td:nth-child(13) {
         width: 300px; 
     }
    </style>
    <script>
            function parcial1() {
            
        const parcial1 = document.getElementById("parcial1").value;
        const recu1 = document.getElementById("recu1");
            
        if (parcial1 < 6) {
            recu1.disabled = false;
        } else {
            recu1.disabled = true;
            recu1.value = 0;
        }
    
    }
    
    function parcial2() {
        
        const parcial2 = document.getElementById("parcial2").value;
        const recu2 = document.getElementById("recu2");
    
        if (parcial2 < 6) {
            recu2.disabled = false;
        } else {
            recu2.disabled = true;
            recu2.value = 0;
        }
        
    }
    
    function faltas(){
    
        const faltas = document.getElementById("faltas").value;
    
        const parcial1 = document.getElementById("parcial1");
        const parcial2 = document.getElementById("parcial2");
        const recu1 = document.getElementById("recu1");
        const recu2 = document.getElementById("recu2");
        const tp = document.getElementById("tp");    
        const final = document.getElementById("final");
        const situacionAcademica = document.getElementById("sitAcademica");
    
        if (faltas > 4) {
        
            parcial1.disabled = true;
            parcial2.disabled = true;
            recu1.disabled = true;
            recu2.disabled = true;
            tp.disabled = true;
            final.disabled = true;
            situacionAcademica.value="Recursa";
        
        } else {
            
            parcial1.disabled = false;
            parcial1.value = 0;
        
            parcial2.disabled = false;
            parcial2.value = 0;
        
            recu1.disabled = false;
            recu1.value = 0;
        
            recu2.disabled = false;
            recu2.value = 0;
        
            tp.disabled = false;
            tp.value = 0;
        
            final.disabled = false;
            final.value = 0;
        }
        
    }
    
    function final(){
    
        const parcial1 = document.getElementById("parcial1").value;
        const parcial2 = document.getElementById("parcial2").value;
        const recu1 = document.getElementById("recu1").value;
        const recu2 = document.getElementById("recu2").value;
        const tp = document.getElementById("tp").value;    
        const faltas = document.getElementById("faltas").value;
        const situacionAcademica = document.getElementById("sitAcademica");
        let final=0;
        //prom= promedio
        prom1=parseInt((parcial1+parcial2)/2);
        prom2=parseInt((parcial1+recu2)/2);
        prom3=parseInt((recu1+parcial2)/2);
        prom4=parseInt((recu1+recu2)/2);
    
        //Calculo el final
        if(prom1>=6 && faltas<4 && tp>4){
            final=prom1;
            situacionAcademica.value="Promocion";
        }
        else if(prom2>=6 && faltas<4 && tp>4){
            final=prom2;
            situacionAcademica.value="Promocion";
        }
        else if(prom3>=6 && faltas<4 && tp>4){
            final=prom3;
            situacionAcademica.value="Promocion";
        }
        else if(prom4>=6 && faltas<4 && tp>4){
            final=prom4;
            situacionAcademica.value="Promocion";
        } else  if((prom1==4 || prom1==5) && faltas<4 && tp>4){
            final=prom1;
            situacionAcademica.value="Aprueba";
        }
        else if((prom2==4 || prom2==5) && faltas<4 && tp>4){
            final=prom2;
            situacionAcademica.value="Aprueba";
        }
        else if((prom3==4 || prom3==5) && faltas<4 && tp>4){
            final=prom3;
            situacionAcademica.value="Aprueba";
        }
        else if((prom4==4 || prom4==5) && faltas<4 && tp>4){
            final=prom4;
            situacionAcademica.value="Aprueba";
        }
        else{
            situacionAcademica.value="Recursa";
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("faltas").addEventListener("change", faltas);
    document.getElementById("parcial1").addEventListener("change", parcial1);
    document.getElementById("parcial2").addEventListener("change", parcial2);
    document.getElementById("recu1").addEventListener("change", parcial1);
    document.getElementById("recu2").addEventListener("change", parcial2);
    document.getElementById("tp").addEventListener("change", parcial1);
    document.getElementById("final").addEventListener("change", final);
});

    </script>
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
            <h3>Registro de Notas</h3>
            <form class="form" action="auxNota.php" method="post">
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Legajo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cuatrimestre</th>
                        <th>Materia</th>
                        <th>Faltas</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>1er Recu</th>
                        <th>2do Recu</th>
                        <th>Trabajo Práctico</th>
                        <th>Final</th>
                        <th>Situación Académica</th>
                    </tr>
                    <?php foreach ($alumnos as  $alumno) :?>
                        <tr>
                        <td><?php echo $alumno['legajo'] ?></td>
                        <td><?php echo $alumno['nombre'] ?></td>
                        <td><?php echo $alumno['apellido'] ?></td>
                        <td><?php echo $alumno['id_cuatri']?></td>
                        <td>
                                <select name="materia[<?php echo $alumno['legajo'] ?>]">
                                    <?php
                                    $id_cuatri = $alumno['id_cuatri'];
                                    $materiasFiltradas = array_filter($materias, function ($materia) use ($id_cuatri) {
                                        return $materia['id_cuatri'] == $id_cuatri;
                                    });

                                    foreach ($materiasFiltradas as $materia) {
                                        echo "<option value=\"{$materia['id_materia']}\">{$materia['materia']}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>        
                            <select id="faltas" name="faltas[<?php  echo $alumno['legajo'] ?>] " onchange="faltas()">
                                <?php echo generarOpcionesSelect($alumno['faltas']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="parcial1" name="parcial1[<?php  echo $alumno['legajo'] ?>] " onchange="parcial1()">
                                <?php echo generarOpcionesSelect($alumno['parcial1']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="parcial2" name="parcial2[<?php  echo $alumno['legajo'] ?>] " onchange="parcial2()">
                                <?php echo generarOpcionesSelect($alumno['parcial2']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="recu1" name="recu1[<?php  echo $alumno['legajo'] ?>] " onchange="parcial1()">
                                <?php echo generarOpcionesSelect($alumno['recu1']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="recu2" name="recu2[<?php  echo $alumno['legajo'] ?>] " onchange="parcial2()">
                                <?php echo generarOpcionesSelect($alumno['recu2']); ?>
                            </select>
                            </td>
                            <td>
                            <select id="tp" name="tp[<?php  echo $alumno['legajo'] ?>] " onchange="parcial1()">
                                <?php echo generarOpcionesSelect($alumno['tp']); ?>
                            </select>
                            </td>

                            <td>
                            <select id="final" name="final[<?php  echo $alumno['legajo'] ?>] " onchange="final()">
                                <?php echo generarOpcionesSelect($alumno['final']); ?>
                            </select>
                            </td>
                                
                            <td>
                            <input type="text" required name="sitAcademica[<?php echo $alumno['legajo'] ?>]" value="<?php echo isset($alumno['sitAcademica']) ? $alumno['sitAcademica'] : ''; ?>" id="sitAcademica">
                            <br>
                            </td>
                        </tr>
                    <?php endforeach;?>  

                </table>
                <br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="verNota.php">Consultar Notas</a>
                <br>
            </form>


        <hr>
    
        <?php
        if(isset($_GET['err']))
            echo '<span class="error">Error al almacenar el registro</span>';
        if(isset($_GET['info']))
            echo '<span class="success">Registro almacenado correctamente!</span>';
        ?>
    </div>
</div>

<footer>
    <p>Recuerden tomar agua</p>
</footer>

</body>

</html>
