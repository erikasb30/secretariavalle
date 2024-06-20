
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title></title>
  </head>
  <body>


<?php

// Obtener el número de RAD ingresado por el usuario
$numerorad = $_GET['numerorad'];

// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cndj");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para buscar en la tabla reg_info_despachos
$sql = "SELECT * FROM reg_info_despachos WHERE numerorad = '$numerorad'";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

?>
<table>
   <tr align="center">
    <td>Categoría</td>
    <td>Despacho</td>
    <td>Tipo</td>
    <td>Estado</td>
    <td>Usuario</td>
    <td>Acciones</td>
   </tr>

<?php

// Verificar si se encontraron resultados
if (mysqli_num_rows($resultado) > 0) {
  // Mostrar los resultados
  while ($fila = mysqli_fetch_assoc($resultado)) {

  ?>
  <tr align="center">
    <td><?php echo $fila['categoria'] ?></td>
    <td><?php echo $fila['despacho'] ?></td>
    <td><?php echo $fila['tipo'] ?></td>
    <td><?php echo $fila['estado'] ?></td>
    <td><?php echo $fila['usuario'] ?></td>
    <td>

<form class="" action="reemplace_documento.html" method="post">
  <button type="submit" name="button">Reemplace Documento</button>

</form>

    </td>
  </tr>
</table>



      <?php
      }
      } else {
      echo "No se encontraron resultados para el número RAD ingresado.";
      }

      // Cerrar la conexión
      mysqli_close($conexion);
      ?>


     <a href='http://localhost/pruebateams/escribiente/buscaradicado.html'><button>Volver al Buscador</button></a>
  </body>
</html>
