<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Categoria</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Inserta los datos de la categoría</h1>
            <form action="./inscategoria.php" method="POST" class="mt-3">
                <div class="mb-3">
                    <input type="text" placeholder="Nombre" class="form-control" name="Nombre" required maxlength="50"/>
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