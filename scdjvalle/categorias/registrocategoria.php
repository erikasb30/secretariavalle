<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Categoría</title>
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
</head>
<body>
    <div id="header">
        <ul class="nav">
            <li><a href="/pruebateams/portalcndj.php">Volver al Portal</a></li>
            <li><a href="/pruebateams/categorias/registrocategoria.php">Registrar Categoría</a></li>
            <li><a href="/pruebateams/tipo/registrotipo.php">Registrar Tipo</a></li>
        </ul>
    </div>
    <div>
        <p>&nbsp;</p>
        <h4>Registro de Categoría</h4>
        <form action="importcategoria.php" method="post">
            <select name="categoria" required>
                <option value="">Seleccione Categoria</option>
                <option value="DESPACHO">DESPACHO</option>
                <option value="SECRETARIA">SECRETARIA</option>
            </select>

            <h4>Usuario:</h4>
            <input type="text" name="usuario" required>

            <button type="submit" name="registrar">Registrar</button>
        </form>
    </div>
</body>
</html>
