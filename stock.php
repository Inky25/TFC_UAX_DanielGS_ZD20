<?php
require("conexion.php");

// Obtener lista de productos
$productos = $connection->query("SELECT codigo, Nombre, Stock FROM Producto");

// Construir array para JS con stock actual
$stockPorProducto = [];
while ($prod = $productos->fetch_assoc()) {
    $stockPorProducto[$prod['codigo']] = $prod['Stock'];
}

// Volver a obtener productos para mostrar el select (porque el fetch_assoc avanzó el puntero)
$productos = $connection->query("SELECT codigo, Nombre, Stock FROM Producto");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Actualizar Stock</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h1 class="text-center text-primary mb-4">Actualizar Stock del Producto</h1>
        <form action="insstock.php" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="producto" class="form-label">Selecciona un producto</label>
                <select id="producto" name="producto" class="form-select" required onchange="mostrarStockActual()">
                    <option value="" disabled selected>-- Selecciona un producto --</option>
                    <?php 
                    while ($prod = $productos->fetch_assoc()) {
                        echo "<option value='{$prod['codigo']}'>{$prod['codigo']} - {$prod['Nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad a sumar/restar</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required step="1" value="0" />
                <div class="form-text">Usa números negativos para restar stock.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock actual:</label>
                <p id="stockActual" class="fw-bold fs-5">--</p>
            </div>

            <div class="text-center">
                <button class="btn btn-primary">Actualizar Stock</button>
            </div>
        </form>
    </div>
</div>

<script>
    const stockPorProducto = <?= json_encode($stockPorProducto) ?>;

    function mostrarStockActual() {
        const select = document.getElementById('producto');
        const stockSpan = document.getElementById('stockActual');
        const codigo = select.value;
        if (codigo && stockPorProducto.hasOwnProperty(codigo)) {
            stockSpan.textContent = stockPorProducto[codigo];
        } else {
            stockSpan.textContent = '--';
        }
    }

    // Validación simple Bootstrap
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="text-center mt-3">
    <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
</div>
</body>
</html>
