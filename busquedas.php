<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Tablas</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Tabla Cliente</h1>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require("conexion.php");
                    $sql="SELECT * FROM cliente";
                    $resultadoAl=$connection->query($sql);
                    
                    if($resultadoAl->num_rows>0){
                        while ($fila = $resultadoAl -> fetch_assoc()){
                            echo "
                            <tr>
                                <td>".$fila["Email"]."</td>
                                <td>".$fila["Nombre"]."</td>
                                <td>".$fila["Apellidos"]."</td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card shadow p-4 mt-4">
            <h1 class="text-center text-primary">Tabla Empleado</h1>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Trabajo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fnac</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql="SELECT * FROM empleado";
                    $resultadoAl=$connection->query($sql);
                    
                    if($resultadoAl->num_rows>0){
                        while ($fila = $resultadoAl -> fetch_assoc()){
                            echo "
                            <tr>
                                <td>".$fila["DNI"]."</td>
                                <td>".$fila["Nombre"]."</td>
                                <td>".$fila["Apellidos"]."</td>
                                <td>".$fila["Email"]."</td>
                                <td>".$fila["Direccion"]."</td>
                                <td>".$fila["Trabajo"]."</td>
                                <td>".$fila["Telefono"]."</td>
                                <td>".$fila["Fnac"]."</td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>



        <div class="card shadow p-4 mt-4">
    <h1 class="text-center text-primary">Tabla Categorias</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM categoria";
        $resultado = $connection->query($sql);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['ID']}</td>
                        <td>{$fila['Nombre']}</td>
                      </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div class="card shadow p-4 mt-4">
    <h1 class="text-center text-primary">Tabla Compra</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>ID Empleado</th>
                <th>ID Cliente</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM compra";
        $resultado = $connection->query($sql);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['ID']}</td>
                        <td>{$fila['Fecha']}</td>
                        <td>{$fila['IDempleado']}</td>
                        <td>{$fila['IDcliente']}</td>
                      </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

    <div class="card shadow p-4 mt-4">
            <h1 class="text-center text-primary">Tabla Contiene</h1>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
            <tr>
                <th>ID Compra</th>
                <th>ID Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM contiene";
        $resultado = $connection->query($sql);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['IDcompra']}</td>
                        <td>{$fila['IDproducto']}</td>
                        <td>{$fila['Cantidad']}</td>
                      </tr>";
            }
        }
        ?>
        </tbody>
    </table>
    </div>

    <div class="card shadow p-4 mt-4">
            <h1 class="text-center text-primary">Tabla Fabricante</h1>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM fabricante";
        $resultado = $connection->query($sql);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['ID']}</td>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Descripcion']}</td>
                      </tr>";
            }
        }
        ?>
        </tbody>
    </table>
    </div>

    <div class="card shadow p-4 mt-4">
            <h1 class="text-center text-primary">Tabla Producto</h1>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>ID Categoría</th>
                <th>ID Fabricante</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM producto";
        $resultado = $connection->query($sql);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['codigo']}</td>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Descripcion']}</td>
                        <td>{$fila['Stock']}</td>
                        <td>{$fila['Precio']}</td>
                        <td>{$fila['IDcategoria']}</td>
                        <td>{$fila['IDfabricante']}</td>
                      </tr>";
            }
        }
        $connection->close();
        ?>
        </tbody>
    </table>
    </div>
    <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </div>
</div>
</body>
</html>