<?php

require_once 'src/interfaces/UIElement.php';
require_once 'src/view/Button.php';

use View\Button;

$buttonPotencia = new Button("Calcular Potencia", "src/controller/hallar_potencia.php", "primary", "submit");
$buttonPromedio = new Button("Promediar Notas", "src/controller/promedio_notas.php", "primary", "submit");
$buttonTablas = new Button("Tablas de Multiplicar", "src/controller/tablas_multiplicar.php", "primary", "submit");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parcial Final</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container text-center bg-white p-5 rounded shadow">
        <h1 class="mb-4 display-4 text-success fw-bold text-uppercase text-shadow">POO en PHP - Aplicación</h1>
        <div class="d-grid gap-2 col-6 mx-auto">
            <?php
                echo $buttonPotencia->render();
                echo $buttonPromedio->render();
                echo $buttonTablas->render();
            ?>
        </div>
    </div>
</body>
</html>

