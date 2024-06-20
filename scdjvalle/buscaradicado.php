<?php
// Establece la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia el nombre de usuario si es diferente
$password = ""; // Cambia la contraseña si es diferente
$dbname = "cndj"; // Nombre de la base de datos que creaste

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtiene el término de búsqueda del formulario
$search_term = $_GET['search_term'];

// Construye la consulta SQL para buscar en las columnas 'numerorad', 'despacho' y 'usuario'
$sql = "SELECT * FROM radicado_escribiente
        WHERE numerorad LIKE '%$search_term%' OR
              nombre_archivo LIKE '%$search_term%' OR
              categoria LIKE '%$search_term%' OR
              despacho LIKE '%$search_term%' OR
              tipo LIKE '%$search_term%' OR
              usuario LIKE '%$search_term%'";

// Ejecuta la consulta SQL
$result = mysqli_query($conn, $sql);

// Muestra los resultados en una tabla HTML
if (mysqli_num_rows($result) > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
          </style>";

    echo "<table>";
    echo "<tr><th>Número de Radicado</th><th>Nombre del Archivo</th><th>Categoria</th><th>Despacho</th><th>Tipo</th><th>Usuario</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['numerorad'] . "</td>";
        echo "<td>" . $row['nombre_archivo'] . "</td>";
        echo "<td>" . $row['categoria'] . "</td>";
        echo "<td>" . $row['despacho'] . "</td>";
        echo "<td>" . $row['tipo'] . "</td>";
        echo "<td>" . $row['usuario'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "&nbsp;";
        echo "<a href='http://localhost/pruebateams/historico.php'><button>Volver al histórico</button></a>";
        echo "&nbsp;";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}


// Cierra la conexión
mysqli_close($conn);
?>
