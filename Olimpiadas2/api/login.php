<?php

if (isset($_POST)) {
    $con = new mysqli('localhost', 'root', '', 'olimpiadas') or die(mysqli_error($con));
    
    echo json_encode( $con->query("SELECT `matricula`, `nombre` , `apellido` , `nickname` , `mail` , `cant_llamadas` , `foto` FROM `medico` WHERE `mail` = '" . $_POST["email"] . "' AND `password` = '" . $_POST["password"] . "'")->fetch_assoc(), JSON_UNESCAPED_UNICODE);
}
