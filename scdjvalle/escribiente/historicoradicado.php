<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="">
  <title>Historico Radicado</title>
</head>
<body>

  <center>
    <h1>Historico de Indice por Radicados</h1>
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
    echo "<table border='1' align='center'>
    <tr>
    <th>Número de Radicado</th>
    <th>Categoría</th>
    <th>Despacho</th>
    <th>Tipo</th>
    <th>Estado</th>
    <th>Usuario</th>
    <th>Ruta del Documento</th>
    <th>Acción</th>
    </tr>";

    if ($result->num_rows > 0) {

      // Mostrar cada fila de datos
      while($row = $result->fetch_assoc()) {

        echo "<tr align='center'>";
        echo "<td>" . $row['numerorad'] . "</td>";
        echo "<td>" . $row['categoria'] . "</td>";
        echo "<td>" . $row['despacho'] . "</td>";
        echo "<td>" . $row['tipo'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>" . $row['usuario'] . "</td>";
        echo "<td>" . $row['rutadocumento'] . "</td>";
        echo "<td><form action='eliminarregistro.php' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' value='Eliminar'></form></td>";
        echo "</tr>";
      }

      // Cerrar la tabla HTML
      echo "</table>";

      echo "<p>&nbsp;</p>";
      // Imprimir el botón "Verificar Índice" después de la tabla
      echo "<form action='descargarindice.php' method='GET'>";
      echo "<input type='hidden' name='numerorad1' value='$numerorad'>";
      echo "<center><button type='submit'>Verificar Índice</button>
        <button><a href='http://localhost/pruebateams/escribiente/indiceradicado.html'>Volver al Buscador</a></button></center>
      ";
      echo "</form>";

    } else {
      echo "<p>No se encontraron resultados.</p>";
    }

  } else {
    echo "Ingrese un número de radicado para buscar.";
  }

  // Cerrar conexión
  $conn->close();

  ?>

  <p>&nbsp;</p>


</body>
</html>
