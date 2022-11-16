<?php

include('conexionHospital.php');

$consulta = $_GET['consulta'];
if ($consulta) {
    switch ($consulta) {
        case 'obtenerLlamadosEmergencia':
            $sql = "SELECT * from llamados where tipo = 'emergencia'";

            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "id" => $row['id']
                    //, resto de campos
                );
            }
            echo json_encode($json);
            break;
        case 'obtenerLlamadosNormales':
            $sql = "SELECT * from llamados where tipo = 'normal'";

            $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            $json = array();
            while ($row = $query->fetch_assoc()) {
                $json[] = array(
                    "id" => $row['id']
                    //, resto de campos
                );
            }
            echo json_encode($json);
            break;
        case 'tomarLlamado':
            /*if (isset($_GET['']) && isset($_GET['']) && isset($_GET[''])) {
                $sql = "INSERT...";

                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }*/
            break;
        case 'tomarLlamadoEmergencia':
            /*if (isset($_GET['']) && isset($_GET['']) && isset($_GET[''])) {
                $sql = "INSERT...";

                $query = $conexion->query($sql) or die($query . mysqli_error($conexion));
            }*/
            break;
        case 'verificarUsuario':
            if (isset($_GET['user']) && isset($_GET['password'])) {

                $user = $_GET['user'];
                $password = $_GET['password'];

                $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE user = '".$user."' and password = '".$password."'");

                if (mysqli_num_rows($validar_login) > 0){
                    if ($row = $validar_login->fetch_assoc()) {
                            echo $row['id'];
                    }
                }else{
                    echo false;
                }

            }
            break;
    }
}
