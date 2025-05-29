<?php
require("conexion.php");

//Obtener productos de la base de datos para el array
$productos = $connection->query("SELECT codigo, Nombre, Stock FROM Producto");

//Crear array de stock por producto para JS
$stockPorProducto = [];
while ($prod = $productos->fetch_assoc()) {
    $stockPorProducto[$prod['codigo']] = $prod['Stock'];
}

//Volver a obtener productos para el select
$productos = $connection->query("SELECT codigo, Nombre FROM Producto");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Actualizar Stock</title>
    <link rel="icon" href="zonad20.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary mb-4">Actualizar Stock de Productos</h1>
            <form action="insstock.php" method="POST">
                <div class="mb-3"> <!-- Menu desplegable con los productos -->
                    <label for="producto" class="form-label">Producto</label>
                    <select name="producto" class="form-select" onchange="mostrarStockActual()">
                        <option disabled selected value="">Selecciona un producto</option>
                        <?php while ($prod = $productos->fetch_assoc()): ?>
                            <option value="<?= $prod['codigo'] ?>">
                                <?= $prod['codigo'] ?> - <?= $prod['Nombre'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3"> <!-- Cantidad -->
                    <label for="cantidad" class="form-label">Cantidad a ajustar</label>
                    <input type="number" name="cantidad" class="form-control" step="1" value="0" />
                    <div class="form-text">Puedes introducir números negativos para restar stock.</div>
                </div>

                <div class="mb-3"> <!-- Muestra stock actual -->
                    <label class="form-label">Stock actual</label>
                    <p id="stockActual" class="fs-5 fw-bold">--</p>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </form>
        </div>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </div>
    </div>

    <script>
        const stockPorProducto = <?= json_encode($stockPorProducto) ?>;

        function mostrarStockActual() { //Script para obtener el stock actual 
            const select = document.querySelector('select[name="producto"]');
            const stockSpan = document.getElementById('stockActual');
            const codigo = select.value;
            stockSpan.textContent = stockPorProducto[codigo] ?? '--';
        }
    </script>
</body>
</html>
