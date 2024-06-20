<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Subir Archivo Excel</title>
</head>
<body>
  <form action="carguepro.php" method="post" enctype="multipart/form-data">
    <label for="documento">Selecciona un documento (máximo 24 caracteres):</label><br>
    <input type="file" id="documento" name="documento" maxlength="24" required><br><br>
    <button type="submit" name="submit">Cargar Registro</button>
  </form>
</body>
</html>
