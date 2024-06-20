<?php
// Conectar con la base de datos (suponiendo que ya tienes una conexión establecida)
$conn1 = new mysqli("localhost", "root", "", "cndj");

// Verificar la conexión
if ($conn1->connect_error) {
    die("Error de conexión: " . $conn1->connect_error);
}

// Consulta SQL para obtener las categorías
$sql = "SELECT DISTINCT numerorad FROM radicado_escribiente";
$result = $conn1->query($sql);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
  </head>
  <body>
    <div id="header">
        <ul class="nav">
            <li><a href="/pruebateams/portalcndj.php">Volver al Portal</a></li>
            <li><a href="/pruebateams/notificaciones.php">Crear Radicado</a></li>
            <li><a href="/pruebateams/categorias/registrocategoria.php">Registre Categoria</a></li>
            <li><a href="/pruebateams/tipo/registrotipo.php">Registre Tipo</a></li>

        </ul>
    </div>
      <div class="">
        <p>&nbsp;</p>
        <li>Ingrese Proceso</li>
        <ul>
          <form action="prodocumento.php" method="post" enctype="multipart/form-data">
        <h4>Seleccione Radicado:</h4>
        <select name="numerorad" required>
            <option value="">Seleccione Radicado</option>
            <?php
            // Iterar sobre los resultados de la consulta y construir las opciones de la lista de selección
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['numerorad'] . "'>" . $row['numerorad'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay numero radicados disponibles</option>";
            }
            ?>
        </select>
        <?php
        // Cerrar la conexión
        $conn1->close();
        ?>

        <h4>Seleccione Categoría:</h4>

        <select name="categoria" required>
            <option value="">Seleccione Categoria</option>
            <?php

            // Conectar con la base de datos (suponiendo que ya tienes una conexión establecida)
            $conn2 = new mysqli("localhost", "root", "", "cndj");

            // Verificar la conexión
            if ($conn2->connect_error) {
                die("Error de conexión: " . $conn2->connect_error);
            }

            // Consulta SQL para obtener las categorías
            $sql = "SELECT DISTINCT categoria FROM registro_categoria";
            $result = $conn2->query($sql);

            // Iterar sobre los resultados de la consulta y construir las opciones de la lista de selección
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['categoria'] . "'>" . $row['categoria'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay categorías disponibles</option>";
            }
            ?>
        </select>
        <?php
        // Cerrar la conexión
        $conn2->close();
        ?>
        <h4>Numero de Despacho:</h4>
        <select name="despacho" required>
          <option value="">Seleccione Despacho</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>

        </select>
        <?php
        // Conectar con la base de datos (suponiendo que ya tienes una conexión establecida)
        $conn = new mysqli("localhost", "root", "", "cndj");

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener las categorías
        $sql = "SELECT DISTINCT nombre_tipo FROM registro_tipo";
        $result = $conn->query($sql);

        ?>
        <h4>Tipo:</h4>
        <select name="tipo" required>
            <option value="">Seleccione Tipo</option>
            <?php
            // Iterar sobre los resultados de la consulta y construir las opciones de la lista de selección
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['nombre_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay nombre de tipo disponibles</option>";
            }
            ?>
        </select>

        <h4>Estado:</h4>
        <select name="estado" required>
          <option>Seleccione Estado</option>
          <option>Tramite</option>
          <option>Proceso</option>
          <option>Terminado</option>
        </select>
        <h4>Nombre de Usuario:</h4>
        <input type="text" name="usuario" value="" required>
        <h2>Cargar Documento</h2>

        <label for="documento">Selecciona un documento (máximo 24 caracteres):</label><br>
        <input type="file" id="documento" name="documento" maxlength="24" required><br><br>
        <script>
            function validateFileNameLength() {
                var fileName = document.getElementById("documento").value;
                if (fileName.length > 24) {
                    alert("Error: El nombre del documento no puede ser mayor a 24 caracteres.");
                    return false;
                }
                return true;
            }
        </script>
        <h4></h4>
        <button type="submit" name="registrar">Registrar</button>
        </form>
        </ul>
      </div>
  </body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
