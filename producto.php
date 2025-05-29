<?php
require("conexion.php"); //obtiene de la base de datos los fabricantes y las categorias para el menu desplegable
$fabricante = $connection->query("SELECT ID, Nombre FROM Fabricante");
$categoria = $connection->query("SELECT ID, Nombre FROM Categoria");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Producto</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Inserta los datos del Producto</h1>
            <form action="./insproducto.php" method="POST" class="mt-3">
                <div class="mb-3">
                    <input type="text" placeholder="Nombre" class="form-control" name="Nombre" required maxlength="50"/>
                </div>
                <div class="mb-3">
                    <textarea placeholder="Descripción" class="form-control" name="Descripcion" maxlength="200"></textarea>
                </div>
                <div class="mb-3">
                    <input type="number" placeholder="Stock" class="form-control" name="Stock" required min="0"/>
                </div>
                <div class="mb-3">
                    <input type="number" placeholder="Precio" class="form-control" name="Precio" required min="0" step="0.01"/>
                </div>

                <div class="mb-3"> <!-- Menu desplegable para seleccionar categoría -->
                    <select name="IDcategoria" class="form-select" required>
                        <option value="" disabled selected>Selecciona una categoría</option>
                        <?php while ($cat = $categoria->fetch_assoc()) {
                            echo "<option value='{$cat['ID']}'>{$cat['ID']} - {$cat['Nombre']}</option>";
                        } ?>
                    </select>
                </div>

                <div class="mb-3"> <!-- Menu desplegable para seleccionar fabricante -->
                    <select name="IDfabricante" class="form-select" required>
                        <option value="" disabled selected>Selecciona un fabricante</option>
                        <?php while ($fab = $fabricante->fetch_assoc()) {
                            echo "<option value='{$fab['ID']}'>{$fab['ID']} - {$fab['Nombre']}</option>";
                        } ?>
                    </select>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </div>
    </div>
</body>
</html>