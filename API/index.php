<?php

include('conexion.php');

$consulta = $_GET['consulta'];
if ($consulta) {
    switch ($consulta) {
        case 'obtenerLlamadosEmergencia':
            $sql = "
            SELECT l.id,l.hora,l.hora_respondida,l.respondida,
            b.localizacion, b.emergencia,
            concat(m.nombre, ' ', m.apellido) as 'medico', concat(p.nombre, ' ', p.apellido) as 'paciente'
            FROM llamados l
            inner join boton b on l.lugar = b.id
            inner join medico m on m.id = l.medico
            inner join paciente p on p.id = l.paciente
            where b.emergencia = 1
            ";

            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "id" => $row['id'],
                    "localizacion" => $row['localizacion'],
                    "emergencia" => $row['emergencia'],
                    "hora" => $row['hora'],
                    "hora_respondida" => $row['hora_respondida'],
                    "respondida" => $row['respondida'],
                    "medico" => $row['medico'],
                    "paciente" => $row['paciente']
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerLlamadosNormales':
            $sql = "
            SELECT l.id,l.hora,l.hora_respondida,l.respondida,
            b.localizacion, b.emergencia,
            concat(m.nombre, ' ', m.apellido) as 'medico', concat(p.nombre, ' ', p.apellido) as 'paciente'
            FROM llamados l
            inner join boton b on l.lugar = b.id
            inner join medico m on m.id = l.medico
            inner join paciente p on p.id = l.paciente
            where b.emergencia = 0
            ";

            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "id" => $row['id'],
                    "localizacion" => $row['localizacion'],
                    "emergencia" => $row['emergencia'],
                    "hora" => $row['hora'],
                    "hora_respondida" => $row['hora_respondida'],
                    "respondida" => $row['respondida'],
                    "medico" => $row['medico'],
                    "paciente" => $row['paciente']
                );
            }
            echo json_encode($json);
            break;
        case 'tomarLlamado':
            if(isset($_GET['medico']) && isset($_GET['id'])){
                $sql = "UPDATE llamados set hora_respondida = now(), medico = ".$_GET['medico'].", respondida = 1 where id = ".$_GET['id'];

                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }
            break;
        case 'verificarUsuario':
            if (isset($_GET['user']) && isset($_GET['password'])) {

                $user = $_GET['user'];
                $password = $_GET['password'];

                $validar_login = mysqli_query($conexion, "SELECT * FROM medico WHERE nickname = ".$user." and password = ".$password."");

                if (mysqli_num_rows($validar_login) > 0){
                    if ($row = $validar_login->fetch_assoc()) {
                            echo $row['id'];
                    }
                }else{
                    echo 0;
                }

            }
            break;
    }
}
