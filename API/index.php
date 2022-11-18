<?php

include('conexion.php');

$consulta = $_GET['consulta'];
if ($consulta) {
    switch ($consulta) {
        case 'obtenerLlamadosPendientesNormales':
            $sql = "SELECT count(*) as 'pendientes' FROM llamados l inner join boton b on l.lugar = b.id
            where l.respondida = 0 and b.emergencia = 0";
            
            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            if ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "pendientes" => $row['pendientes'],
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerLlamadosPendientesEmergencia':
            $sql = "SELECT count(*) as 'pendientes' FROM llamados l inner join boton b on l.lugar = b.id
            where l.respondida = 0 and b.emergencia = 1";
            
            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            if ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "pendientes" => $row['pendientes'],
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerTiempoRespuestaNormal':
            $sql = "SELECT round(avg(TIMESTAMPDIFF(SECOND, hora, hora_respondida))) as tiempo FROM llamados l inner join boton b on l.lugar = b.id where b.emergencia = 0;";
            
            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "tiempo" => $row['tiempo'],
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerTiempoRespuestaEmergencia':
            $sql = "SELECT round(avg(TIMESTAMPDIFF(SECOND, hora, hora_respondida))) as tiempo FROM llamados l inner join boton b on l.lugar = b.id where b.emergencia = 1;";
            
            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "tiempo" => $row['tiempo'],
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerMedicos':
            $sql = "SELECT * FROM medico";
            
            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "id" => $row['id'],
                    "matricula" => $row['matricula'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellido'],
                    "nickname" => $row['nickname'],
                    "password" => $row['password'],
                    "mail" => $row['mail'],
                    "cant_llamadas" => $row['cant_llamadas'],
                    "foto" => $row['foto']
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerPacientes':
            $sql = "SELECT * FROM paciente";
            
            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellido'],
                    "documento" => $row['documento'],
                    "edad" => $row['edad'],
                    "medico" => $row['medico'],
                    "ubicacion" => $row['ubicacion']
                );
            }
            echo json_encode($json);
            break;
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
        case 'insertPaciente':
            if(isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['documento']) && isset($_GET['edad']) && isset($_GET['medico']) && isset($_GET['ubicacion'])){
                $sql = "INSERT INTO paciente(nombre,apellido,documento,edad,medico,ubicacion)
                values ('".$_GET['nombre']."','".$_GET['apellido']."',".$_GET['documento'].",".$_GET['edad'].",".$_GET['medico'].",".$_GET['ubicacion'].")";

                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }
            break;
        case 'updatePaciente':
            if(isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['documento']) && isset($_GET['edad']) && isset($_GET['medico']) && isset($_GET['ubicacion'])){
                $sql = "UPDATE paciente SET
                    nombre = '".$_GET['nombre']."',
                    apellido = '".$_GET['apellido']."',
                    documento = ".$_GET['documento'].",
                    edad = ".$_GET['edad'].",
                    medico = ".$_GET['medico'].",
                    ubicacion = ".$_GET['ubicacion'].
                    " where id = ".$_GET['id'];

                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }
            break;
        case 'insertMedico':
            if(isset($_GET['matricula']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['nickname']) && isset($_GET['password']) && isset($_GET['mail']) && isset($_GET['cant_llamadas']) && isset($_GET['foto'])){
                $sql = "INSERT INTO medico(matricula,nombre,apellido,nickname,password,mail,cant_llamadas,foto)
                values (".$_GET['matricula'].",'".$_GET['nombre']."','".$_GET['apellido']."','".$_GET['nickname']."','".$_GET['password']."','".$_GET['mail']."',".$_GET['cant_llamadas'].",'".$_GET['foto']."')";
                
                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }
            break;
        case 'updateMedico':
            if(isset($_GET['id']) && isset($_GET['matricula']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['nickname']) && isset($_GET['password']) && isset($_GET['mail']) && isset($_GET['cant_llamadas']) && isset($_GET['foto'])){
                $sql = "UPDATE medico SET
                    matricula = ".$_GET['matricula'].",
                    nombre = '".$_GET['nombre']."',
                    apellido = '".$_GET['apellido']."',
                    nickname = '".$_GET['nickname']."',
                    password = '".$_GET['password']."',
                    mail = '".$_GET['mail']."',
                    cant_llamadas = ".$_GET['cant_llamadas'].",
                    foto = '".$_GET['foto'].
                    "' where id = ".$_GET['id'];

                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }
            break;
        case 'verificarUsuario':
            if (isset($_GET['email']) && isset($_GET['password'])) {

                $sql = mysqli_query($conexion, "SELECT `matricula`, `nombre` , `apellido` , `nickname` , `mail` , `cant_llamadas` , `foto` FROM `medico` WHERE `mail` = '" . $_GET["email"] . "' AND `password` = '" . md5($_GET["password"]) . "'") or die(mysqli_error($con));
            
                echo json_encode($sql->fetch_assoc(), JSON_UNESCAPED_UNICODE);
            }

            break;
    }
}
