<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Nombre Tipo</title>
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
        <h3>Registro Nombre Tipo</h3>
        <form action="importipo.php" method="post">
            <h4>Seleccione Tipo:</h4>
            <select name="nombre_tipo" required>
                <option value="">- Seleccione -</option>
                <option value="IReparto">IReparto</option>
                <option value="IILey1123De2007">IILey1123De2007</option>
                <option value="IVLey1952De2019">IVLey1952De2019</option>
                <option value="VPlanillasDeCorrespondencia">VPlanillasDeCorrespondencia</option>
                <option value="ArchivoDefinitivo">ArchivoDefinitivo</option>
                <option value="ComisionesDiligenciadas">ComisionesDiligenciadas</option>
                <option value="ComisionesParaDiligenciar">ComisionesParaDiligenciar</option>
                <option value="ConflictoDeCompetencias">ConflictoDeCompetencias</option>
                <option value="DevolucionesTelegramasOficios">DevolucionesTelegramasOficios</option>
                <option value="ExpedientesEnviadosCNDJ">ExpedientesEnviadosCNDJ</option>
                <option value="ExpedientesGuisao">ExpedientesGuisao</option>
                <option value="Ley1123De2007">Ley1123De2007</option>
                <option value="Ley1952De2019">Ley1952De2019</option>
                <option value="Salas">Salas</option>
                <option value="Scaneados2daInstancia">Scaneados2daInstancia</option>
            </select>

            <h4>Usuario:</h4>
            <input type="text" name="usuario" required>

            <button type="submit" name="registrar">Registrar</button>
        </form>
    </div>
</body>
</html>
