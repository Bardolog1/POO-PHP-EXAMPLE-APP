<!-- hallar_potencia.php -->
<?php
        
        require_once '../interfaces/MathExecutor.php';
        require_once '../model/Arithmetic/MathAbstract.php';
        require_once '../model/Arithmetic/Math.php';
        
        require_once '../interfaces/UIElement.php';
        require_once '../view/Button.php';
        require_once '../view/Input.php';

        use Arithmetic\Math;
        use View\Button;
        use View\Input;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Calcular Potencia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">
    <div class="container text-center p-4 rounded bg-secondary shadow">
        <h1 class="mb-4">Calcular Potencia</h1>
        <form method="post" action="" class="mb-4">
            
            <?php
                 $botonCalcular = new Button("Calcular", null, "success", "submit");

                $inputBase = new Input('base', 'Base (X^y) X: ', true);
                $inputBase->setType('number');
                $inputBase->setPlaceholder('Ingrese la base');
                $inputBase->setStep('0.1');
                $inputBase->setErrorMsg('Ingrese solo números');

                $inputExponente = new Input('exponente', 'Exponente (X^y) y: ', true);
                $inputExponente->setType('number');
                $inputExponente->setStep('0.1');
                $inputExponente->setPlaceholder('Ingrese el exponente');
                $inputExponente->setErrorMsg('Ingrese solo números');

                echo $inputBase->render();
                echo $inputExponente->render();
                echo $botonCalcular->render();

                ?>
            
        </form>

       <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["base"]) && isset($_POST["exponente"])) {
                $base = $_POST["base"];
                $exponente = $_POST["exponente"];
                $math = new Math($base, $exponente, 'pow');
                echo "<p class='fs-4'>" . $math->executeOperation() . "</p>";
            } else {
                echo "<div class='alert alert-warning'>Por favor, ingrese tanto la base como el exponente.</div>";
            }
        }

        $botonRegresar = new Button("Regresar", "../../index.php", "secondary", "link");
        echo $botonRegresar->render();
        ?>
    </div>
</body>

</html>

