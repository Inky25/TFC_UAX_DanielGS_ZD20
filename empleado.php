<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Empleado</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Inserta los datos del Empleado</h1>
            <form action="./insempleado.php" method="POST" class="mt-3">
                <div class="mb-3">
                    <input type="text" placeholder="DNI" class="form-control" name="DNI" required maxlength="9" minlength="9"/>
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Nombre" class="form-control" name="Nombre" required maxlength="50"/>
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Apellidos" class="form-control" name="Apellidos" maxlength="100"/>
                </div>
                 <div class="mb-3">
                    <input type="email" placeholder="Email" class="form-control" name="Email" required maxlength="50"/>
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Direccion" class="form-control" name="Direccion" required maxlength="50"/>
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Trabajo" class="form-control" name="Trabajo" required maxlength="50"/>
                </div>
                <div class="mb-3">
                    <input type="tel" placeholder="Telefono" class="form-control" name="Telefono" required maxlength="9" minlength="9"/>
                </div>
                <div class="mb-3">
                    <input type="date" placeholder="Fecha de nacimiento" class="form-control" name="Fnac"/>
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