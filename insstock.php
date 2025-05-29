<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Actualizar Stock</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Actualizar Stock</h1>
            <div class="alert alert-info" role="alert">
                <?php
                require("conexion.php");

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $codigo = $_POST['producto'] ?? '';
                    $cantidad = (int)($_POST['cantidad'] ?? 0);

                    if ($codigo === '') {
                        echo "<p class='text-danger fw-bold'>No se seleccionó ningún producto.</p>";
                    } else {
                        $stmt = $connection->prepare("SELECT Stock, Nombre FROM Producto WHERE codigo = ?");
                        $stmt->bind_param("s", $codigo);
                        $stmt->execute();
                        $stmt->bind_result($stockActual, $nombreProducto);
                        if ($stmt->fetch()) {
                            $stmt->close();

                            $nuevoStock = $stockActual + $cantidad;

                            if ($nuevoStock < 0) {
                                echo "<p class='text-danger fw-bold'>Error: No se puede dejar el stock en negativo. Stock actual: $stockActual</p>";
                            } else {
                                $stmt2 = $connection->prepare("UPDATE Producto SET Stock = ? WHERE codigo = ?");
                                $stmt2->bind_param("is", $nuevoStock, $codigo);
                                if ($stmt2->execute()) {
                                    echo "<p class='text-success fw-bold'>Stock actualizado correctamente para <strong>$nombreProducto</strong>.</p>";
                                    echo "<p>Stock anterior: $stockActual</p>";
                                    echo "<p>Stock actualizado: $nuevoStock</p>";
                                } else {
                                    echo "<p class='text-danger fw-bold'>Error al actualizar el stock.</p>";
                                }
                                $stmt2->close();
                            }
                        } else {
                            echo "<p class='text-danger fw-bold'>Producto no encontrado.</p>";
                        }
                    }
                    $connection->close();
                } else {
                    echo "<p class='text-danger fw-bold'>Acceso no permitido.</p>";
                }
                ?>
            </div>
            <div class="text-center mt-3">
                <a href="stock.php" class="btn btn-primary">Actualizar otro producto</a>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
    </div>
</body>
</html>
