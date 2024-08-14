<?php
        require_once '../model/Database/DbConfig.php';
        require_once '../interfaces/UIElement.php';
        require_once '../interfaces/MathExecutor.php';
        require_once '../view/Button.php';
        require_once '../view/Table.php';
        require_once '../model/Arithmetic/MathAbstract.php';
        require_once '../model/Arithmetic/TablaMultiplicar.php';
        require_once '../model/Database/Database.php';
        require_once '../view/Input.php';
      

        use View\Button;
        use Database\Database;
        use Arithmetic\TablaMultiplicar;
        use View\Input;
        
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tablas de Multiplicar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">

    <div class="container p-4 rounded bg-secondary shadow">
        <h1 class="text-center mb-4">Tablas de Multiplicar</h1>

        <?php

        $botonRegresar = new Button("Regresar", "../../index.php", "secondary", "link");
        $botonNext = new Button("Siguiente", null, "success", "submit");
        $botonCalcular = new Button("Calcular", null, "success", "submit");

        $numero = 0;
        $multiplicador = 0;
        $showForm = true;
        $tablaMultiplicar = null;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["numero"]) && isset($_POST["multiplicador"]) && is_numeric($_POST["numero"]) && is_numeric($_POST["multiplicador"])) {
                    $numero =  $_POST["numero"];
                    $multiplicador = (int) $_POST["multiplicador"];
    
                    $tablaMultiplicar = new TablaMultiplicar($numero, $multiplicador);
                    $tablaMultiplicar->executeOperation();
    
                    $db = new Database('localhost', 'root', '', 'parcialFinal', 'tablas');
                    for ($i = 0; $i <= $multiplicador; $i++) {
                        $db->guardarTabla($numero, $i, $tablaMultiplicar->getTabla()[$i]);
                    }
    
                    $showForm = false;
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo "<div class='alert alert-info'>Por favor, recuerde ingresar un número y un multiplicador válidos.</div>";
                }
            }
        ?>

        <?php if ($showForm): ?>
            <form action="" method="post" class="mb-4">
                <?php

                $inputNumero = new Input('numero', 'Tabla del');
                $inputNumero->setType('number');
                $inputNumero->setPlaceholder('Ingrese el Número');
                $inputNumero->setErrorMsg('Ingrese solo números');
                $inputNumero->setStep(0.1);

                $inputMultiplicador = new Input('multiplicador', 'Hasta');
                $inputMultiplicador->setType('number');
                $inputMultiplicador->setMin(0);
                $inputMultiplicador->setMax(50);
                $inputMultiplicador->setPlaceholder('Hasta');
                $inputMultiplicador->setErrorMsg('Debe seleccionar hasta donde desea la tabla (Solo Enteros)');

                echo $inputNumero->render();
                echo $inputMultiplicador->render();

                echo $botonCalcular->render(); 
                
                ?>
            </form>
        <?php endif; ?>


        <?php if (!$showForm && $tablaMultiplicar): ?>
            <h2 class="text-center">Tabla del <?php echo $numero; ?> hasta el <?php echo $multiplicador; ?></h2>
            <?php $tablaMultiplicar->render(); ?>

        <?php endif; ?>
        
        
        
        <?php echo $botonRegresar->render(); ?>
    </div>

</body>

</html>