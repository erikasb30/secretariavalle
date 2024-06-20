<?php
// Conectar con la base de datos (suponiendo que ya tienes una conexión establecida)
$conn1 = new mysqli("localhost", "root", "", "cndj");

// Verificar la conexión
if ($conn1->connect_error) {
    die("Error de conexión: " . $conn1->connect_error);
}

// Consulta SQL para obtener las categorías
$sql = "SELECT DISTINCT categoria FROM registro_categoria";
$result = $conn1->query($sql);

?>






<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div id="header">
        <ul class="nav">
            <li><a href="/pruebateams/portalcndj.php">Volver al Portal</a></li>
            <li><a href="/pruebateams/categorias/registrocategoria.php">Registre Categoria</a></li>
            <li><a href="/pruebateams/tipo/registrotipo.php">Registre Tipo</a></li>

        </ul>
    </div>
      <div class="">
        <p>&nbsp;</p>
        <li>Ingrese Proceso</li>
        <ul>
          <form class="" action="crearadicado.php" method="post">
        <h4>No.Radicacion:</h4>
        <input type="text" name="numerorad" value="" required>
        
        <h4>Seleccione Categoría:</h4>

        <select name="categoria" required>
            <option value="">Seleccione Categoria</option>
            <?php
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
        $conn1->close();
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
        <h4>Municipio:</h4>
        <select class="municipio" name="municipio" required>
          <option value="">Seleccione Municipio</option>
          <option value="">CALI</option>
          <option value="">ALCALÁ</option>
          <option value="">ANDALUCÍA</option>
          <option value="">ANSERMANUEVO</option>
          <option value="">ARGELIA</option>
          <option value="">BOLÍVAR</option>
          <option value="">BUENAVENTURA</option>
          <option value="">BUGA</option>
          <option value="">BUGALAGRANDER</option>
          <option value="">CAICEDONIA</option>
          <option value="">CALIMA - DARIEN</option>
          <option value="">CANDELARIA</option>
          <option value="">CARTAGO</option>
          <option value="">DAGUA</option>
          <option value="">EL ÁGUILA</option>
          <option value="">EL CAIRO</option>
          <option value="">EL CERRITO</option>
          <option value="">EL DOVIO</option>
          <option value="">FLORIDA</option>
          <option value="">GINEBRA</option>
          <option value="">GUACARÍ</option>
          <option value="">JAMUNDÍ</option>
          <option value="">LA CUMBRE</option>
          <option value="">LA UNIÓN</option>
          <option value="">LA VICTORIA</option>
          <option value="">OBANDO</option>
          <option value="">PALMIRA</option>
          <option value="">PRADERA</option>
          <option value="">RESTREPO</option>
          <option value="">RIOFRÍO</option>
          <option value="">ROLDANILLO</option>
          <option value="">SAN PEDRO</option>
          <option value="">SEVILLA</option>
          <option value="">TORO</option>
          <option value="">TRUJILLO</option>
          <option value="">TULUÁ</option>
          <option value="">ULLOA</option>
          <option value="">VERSALLES</option>
          <option value="">VIJES</option>
          <option value="">YOTOCO</option>
          <option value="">YUMBO</option>
          <option value="">ZARZAL</option>
        </select>
        <h4>Despacho Judicial:</h4>
        <input type="text" name="despachojudicial" value="" required>
        <h4>Serie o Subserie Documental:</h4>
        <input type="text" name="serie" value="" required>
        <h4>Partes Procesales (Parte A):</h4>
        <input type="text" name="procesalesa" value="" required>
        <h4>Partes Procesales (Parte B):</h4>
        <input type="text" name="procesalesb" value="" required>
        <h4>Nombre de Usuario:</h4>
        <input type="text" name="usuario" value="" required>
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
