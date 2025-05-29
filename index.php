<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZonaD20 BDD</title> <!-- Titulo de la página -->
    <link rel="icon" href="zonad20.png"> <!-- Icono de la página, a continuación, enlaces a bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light"> <!-- Todas estas clases funcionan gracias a Bootstrap, hacen que la página quede más bonita sin tener que complicarse con el CSS -->
    <div class="container text-center mt-5">
        <div class="card shadow p-4">
            <h1 class="mb-4 text-primary">Gestion de Base de Datos ZonaD20</h1>
            <img src="zonad20.png" alt="Zona D20" class="img-fluid mx-auto d-block mb-4" style="max-width: 40%;"> <!-- Imagen grande en el centro de la página -->
            <div class="d-flex justify-content-center gap-3"> 
                <a href="./index2.php" class="btn btn-primary">Añadir Datos</a> <!-- Estos Botones llevan a la página index2.php y busquedas.php. Funcionan gracias a bootstrap -->
                <a href="./busquedas.php" class="btn btn-primary">Ver Tablas</a> 
            </div>
        </div>
    </div>
</body>
</html>
