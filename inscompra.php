<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Insertar Compra</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Conexión con Base de Datos Exitosa</h1>
            <p class="text-center">Procesando Compra:</p>
            <div class="alert alert-info" role="alert">
                <?php
                require("conexion.php");

                $IDempleado = $_POST['IDempleado'];
                $IDcliente = $_POST['IDcliente'];
                $Fecha = $_POST['Fecha'];
                $productos = $_POST['producto'];
                $cantidades = $_POST['cantidad'];

                // Validación de stock de cada producto
                for ($i = 0; $i < count($productos); $i++) {
                    $codigo = $productos[$i];
                    $cantidad = $cantidades[$i];

                    // Verificamos que se ha comprado una cantidad positiva
                    if (!is_numeric($cantidad) || $cantidad <= 0) {
                        echo "<div class='alert alert-danger'>Cantidad inválida para el producto <strong>$codigo</strong>.</div>";
                        echo "<div class='text-center mt-3'><a href='compra.php' class='btn btn-secondary'>Volver</a></div>";
                        $connection->close();
                        exit();
                    }

                    // Ver stock disponible
                    $sql = "SELECT Stock FROM Producto WHERE codigo = '$codigo'";
                    $resultado = $connection->query($sql);
                    $fila = $resultado->fetch_assoc();
                    $stockDisponible = $fila['Stock'] ?? null;

                    // Error stock insuficiente
                    if ($cantidad > $stockDisponible) {
                        echo "<div class='alert alert-danger'>No hay suficiente stock para el producto <strong>$codigo</strong>. 
                        Disponible: $stockDisponible, solicitado: $cantidad.</div>";
                        echo "<div class='text-center mt-3'><a href='compra.php' class='btn btn-secondary'>Volver</a></div>";
                        $connection->close();
                        exit();
                    }
                }

                // Insertamos la compra principal
                $sqlCompra = "INSERT INTO Compra (IDempleado, IDcliente, Fecha) VALUES ('$IDempleado', '$IDcliente', '$Fecha')";
                if ($connection->query($sqlCompra) === TRUE) {
                    $IDcompra = $connection->insert_id;

                    for ($i = 0; $i < count($productos); $i++) {
                        $codigo = $productos[$i];
                        $cantidad = $cantidades[$i];

                        // Insertamos en la tabla Contiene
                        $sqlContiene = "INSERT INTO Contiene (IDcompra, IDproducto, Cantidad) VALUES ('$IDcompra', '$codigo', '$cantidad')";
                        $connection->query($sqlContiene);

                        // Actualizamos el stock en la tabla Producto
                        $sqlStock = "UPDATE Producto SET Stock = Stock - $cantidad WHERE codigo = '$codigo'";
                        $connection->query($sqlStock);
                    }

                    echo "<p class='text-success fw-bold'>Compra registrada correctamente.</p>";
                } else {
                    echo "<p class='text-danger fw-bold'>Error al registrar la compra.</p>";
                }

                $connection->close();
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
