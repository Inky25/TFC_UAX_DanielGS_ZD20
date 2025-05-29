<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Insertar Compra</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h1 class="text-center text-primary mb-4">Conexion con Base de Datos Exitosa</h1>
        <p class="text-center">Procesando Compra:</p>
        <div class="alert alert-info" role="alert">
<?php
require("conexion.php");

$IDempleado = $_POST['IDempleado'];
$IDcliente = $_POST['IDcliente'];
$Fecha = $_POST['Fecha'];
$productos = $_POST['producto'];
$cantidades = $_POST['cantidad'];

$errores = [];

for ($i = 0; $i < count($productos); $i++) {
    $codigo = $productos[$i];
    $cantidad = $cantidades[$i];

    $stmt = $connection->prepare("SELECT Stock FROM Producto WHERE codigo = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $stmt->bind_result($stockDisponible);
    $stmt->fetch();
    $stmt->close();

    if ($stockDisponible === null) {
        $errores[] = "El producto con código <strong>$codigo</strong> no existe.";
    } elseif ($cantidad > $stockDisponible) {
        $errores[] = "No hay suficiente stock para el producto <strong>$codigo</strong>. Disponible: $stockDisponible, solicitado: $cantidad.";
    }
}

if (count($errores) > 0) {
    echo "<div class='alert alert-danger'><h4>Errores al procesar la compra:</h4><ul>";
    foreach ($errores as $e) echo "<li>$e</li>";
    echo "</ul></div>";
    echo "<div class='text-center mt-3'><a href='compra.php' class='btn btn-secondary'>Volver</a></div>";
    $connection->close();
    exit();
}

$sqlCompra = "INSERT INTO Compra (IDempleado, IDcliente, Fecha) VALUES (?, ?, ?)";
$stmt = $connection->prepare($sqlCompra);
$stmt->bind_param("sss", $IDempleado, $IDcliente, $Fecha);
$stmt->execute();
$IDcompra = $stmt->insert_id;
$stmt->close();

for ($i = 0; $i < count($productos); $i++) {
    $codigo = $productos[$i];
    $cantidad = $cantidades[$i];

    $sqlContiene = "INSERT INTO Contiene (IDcompra, IDproducto, Cantidad) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sqlContiene);
    $stmt->bind_param("isi", $IDcompra, $codigo, $cantidad);
    $stmt->execute();
    $stmt->close();

    $sqlStock = "UPDATE Producto SET Stock = Stock - ? WHERE codigo = ?";
    $stmt = $connection->prepare($sqlStock);
    $stmt->bind_param("is", $cantidad, $codigo);
    $stmt->execute();
    $stmt->close();
}

$connection->close();

echo "<p class='text-success fw-bold'>Compra registrada correctamente</p>";;
?>
        </div>

            <div class="text-center mt-3">
                <a href="compra.php" class="btn btn-primary">Añadir otra</a>
            </div>
    </div>
</div>
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
            </div>
</body>
</html>
