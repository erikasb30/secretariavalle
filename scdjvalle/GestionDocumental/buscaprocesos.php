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
$sql = "SELECT * FROM radicado_procuraduria
        WHERE radicado LIKE '%$search_term%' OR
              procuraduria LIKE '%$search_term%' OR
              timestamp LIKE '%$search_term%'";

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
    echo "<tr><th>Número de Radicado</th><th>Numero de Procurador</th><th>Fecha y Hora</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['radicado'] . "</td>";
        echo "<td>" . $row['procuraduria'] . "</td>";
        echo "<td>" . $row['timestamp'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "&nbsp;";
        echo "<a href='http://localhost/pruebateams/GestionDocumental/buscaprocesopro.html'><button>Volver al histórico</button></a>";
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
