<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="">
    <title>Histórico Radicado</title>
  </head>
  <body>

  <center>
      <h1>Histórico de Proceso</h1>
  </center>

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "cndj";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió un número de radicado desde el formulario
if(isset($_POST['numerorad'])) {
    $numerorad = $_POST['numerorad'];
    // Consulta SQL para buscar el número de radicado
    $sql = "SELECT * FROM reg_info_despachos WHERE numerorad = '$numerorad'";

    $result = $conn->query($sql);

    // Mostrar los resultados en una tabla HTML
    echo "<table border='1'align='center'>
    <tr>
    <th>Número de Radicado</th>
    <th>Categoría</th>
    <th>Despacho</th>
    <th>Tipo</th>
    <th>Estado</th>
    <th>Usuario</th>
    <th>Ruta del Documento</th>
    <th>Opcion Descarga</th>
    <th colspan='2'>Estado</th>
    </tr>";

    if ($result->num_rows > 0) {
        // Mostrar cada fila de datos
        while($row = $result->fetch_assoc()) {
            echo "<tr align='center'>";
            /*echo "<td>" . $row['id'] . "</td>";*/
            echo "<td>" . $row['numerorad'] . "</td>";
            echo "<td>" . $row['categoria'] . "</td>";
            echo "<td>" . $row['despacho'] . "</td>";
            echo "<td>" . $row['tipo'] . "</td>";
            echo "<td>" . $row['estado'] . "</td>";
            echo "<td>" . $row['usuario'] . "</td>";
            echo "<td>" . $row['rutadocumento'] . "</td>";
            echo "<td><form action='descargar_documento.php' method='post'><input type='hidden' name='ruta_documento' value='" . $row['rutadocumento'] . "'><input type='submit' value='Descargar Documento'></form></td>";
            echo "<td><form action='cambiar_estado.php' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='hidden' name='numerorad1' value='" . $row['numerorad'] . "'><select name='nuevo_estado'><option>Seleccione Estado</option><option>Tramite</option><option>Proceso</option><option>Terminado</option></td>";
            echo "<td><input type='submit' value='Cambiar Estado'></form></td>";
            echo "</tr>";


            /*
            <form action='cambiar_estado.php' method="post">
      <h4>Número RAD:</h4>
      <select name="numerorad1">
        <option>Seleccione Radicado</option>
        <option><?php echo $fila['numerorad'];?></option>
      </select>



       <select name="nuevo_estado">
          <option>Seleccione Estado</option>
          <option>Tramite</option>
          <option>Proceso</option>
          <option>Terminado</option>
     </select>
          <input type='submit' value='Cambiar Estado'>
     </form>

            */

        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
    }

    echo "</table>";
} else {
    echo "Ingrese un número de radicado para buscar.";
}

// Cerrar conexión
$conn->close();
?>
<p>&nbsp;</p>
<center>
<a href='http://localhost/pruebateams/escribiente/buscaradicado.html'><button>Volver al Buscador</button></a>
</center>

</body>
</html>
