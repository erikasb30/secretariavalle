<?php

function connect(){
	return new mysqli("localhost","root","","cndj");
}
$con = connect();

// AGREGANDO CHARSET UTF8
if (!$con->set_charset("utf8")) {
    printf("Error al cargar el conjunto de caracteres utf8: %s\n", $con->error);
    exit();
} else {
    //printf("Conjunto de caracteres actual: %s\n", $db->character_set_name());
}
?>
