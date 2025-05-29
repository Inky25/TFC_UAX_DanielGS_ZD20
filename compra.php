<?php 
require("conexion.php"); //Conexión con las bases de datos para menus
$empleados = $connection->query("SELECT DNI, Nombre, Apellidos FROM empleado");
$clientes = $connection->query("SELECT Email, Nombre FROM cliente");
$productos = $connection->query("SELECT codigo, Nombre FROM Producto");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Compra</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h1 class="text-center text-primary">Registrar Compra</h1>
        <form action="inscompra.php" method="POST">
            <div class="mb-3"> <!-- Menu seleccionar empleado con nombre, apellidos y DNI -->
                <label for="IDempleado" class="form-label">Empleado</label>
                <select name="IDempleado" id="IDempleado" class="form-select" required>
                    <option value="" disabled selected>Selecciona un empleado</option> 
                    <?php 
                    while ($emp = $empleados->fetch_assoc()) {
                        $nombreCompleto = $emp['Nombre'] . " " . $emp['Apellidos'];
                        echo "<option value='{$emp['DNI']}'>{$nombreCompleto} ({$emp['DNI']})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3"> <!-- Menu seleccionar cliente con nombre e Email -->
                <label for="IDcliente" class="form-label">Cliente</label>
                <select name="IDcliente" id="IDcliente" class="form-select" required>
                    <option value="" disabled selected>Selecciona un cliente</option>
                    <?php
                    while ($cli = $clientes->fetch_assoc()) {
                        echo "<option value='{$cli['Email']}'>{$cli['Nombre']} ({$cli['Email']})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3"> <!-- Fecha -->
                <label for="Fecha" class="form-label">Fecha</label>
                <input type="date" name="Fecha" class="form-control" required>
            </div>

            <div id="productos"> <!-- Menu seleccionar productos -->
                <h5>Productos</h5>
                <div class="producto mb-3">
                    <select name="producto[]" class="form-select mb-2" required>
                        <option value="" disabled selected>Selecciona un producto</option>
                        <?php
                        $productos->data_seek(0);
                        while ($prod = $productos->fetch_assoc()) {
                            echo "<option value='{$prod['codigo']}'>{$prod['codigo']} - {$prod['Nombre']}</option>";
                        }
                        ?>
                    </select> <!-- Cantidad -->
                    <input type="number" name="cantidad[]" placeholder="Cantidad" class="form-control" required>
                </div>
            </div>

            <!-- Boton que ejecuta la función para añadir productos -->
            <button type="button" class="btn btn-secondary mb-3" onclick="agregarProducto()">Agregar otro producto</button>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</div>

<script>
function agregarProducto() { //Funcion para poder añadir más de un producto
    const productosOptions = `<?php
        $productos->data_seek(0);
        $options = '';
        while ($prod = $productos->fetch_assoc()) {
            $options .= "<option value='{$prod['codigo']}'>{$prod['codigo']} - {$prod['Nombre']}</option>";
        }
        echo $options;
    ?>`;
    
    const div = document.createElement("div");
    div.classList.add("producto", "mb-3");
    div.innerHTML = `
        <select name="producto[]" class="form-select mb-2" required>
            <option value="" disabled selected>Selecciona un producto</option>
            ${productosOptions}
        </select>
        <input type="number" name="cantidad[]" placeholder="Cantidad" class="form-control" required>
    `;
    document.getElementById("productos").appendChild(div);
}
</script>
<div class="text-center mt-3">
    <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
</div>
</body>
</html>
