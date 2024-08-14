<!-- promedio_notas.php -->
<?php
    require_once '../model/Entities/Persona.php';
    require_once '../model/Entities/Notas.php';
    require_once '../model/Entities/Estudiante.php';
    require_once '../interfaces/UIElement.php';
    require_once '../interfaces/MathExecutor.php';
    require_once '../view/Button.php';
    require_once '../view/Table.php';
    require_once '../model/Arithmetic/MathAbstract.php';
    require_once '../model/Arithmetic/Math.php';
    require_once '../view/Input.php';

    use Model\Estudiante;
    use Model\Notas;
    use View\Button;
    use View\Table;
    use View\Input;

    $botonRegresar = new Button("Regresar", "../../index.php", "secondary", "link");
    $botonNext = new Button("Siguiente", null, "success", "submit");
    $botonCalcular = new Button("Calcular", null, "success", "submit");

    $num_estudiantes = isset($_POST['num_estudiantes']) ? (int) $_POST['num_estudiantes'] : 0;

    $mostrarFormulario = !($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_estudiante1']));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promediar Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">
    <div class="container p-4 rounded bg-secondary shadow">
        <h1 class="text-center mb-4">Promediar Notas</h1>

        <?php if (!isset($_POST['num_estudiantes']) && $mostrarFormulario): ?>
            <form method="post" action="" class="mb-4">
                <?php
                $inputNumEstudiantes = new Input('num_estudiantes', 'Total de Alumnos:');
                $inputNumEstudiantes->setType('number')->setErrorMsg('Este campo es obligatorio.');
                echo $inputNumEstudiantes->render();
                echo $botonNext->render();
                ?>
            </form>
        <?php elseif ($mostrarFormulario): ?>
            <form method="post" action="" class="mb-4">
                <input type="hidden" name="num_estudiantes" value="<?php echo $num_estudiantes; ?>">
                <div id="estudiantes" class="row row-cols-1 row-cols-md-3 g-3 overflow-auto" style="max-height: 60vh;">
                    <?php for ($i = 1; $i <= $num_estudiantes; $i++): ?>
                        <div class="col">
                            <div class="card bg-dark text-white p-3 shadow-sm h-100">
                                <h5 class="card-title">Estudiante <?php echo $i; ?></h5>
                                <?php
                                $inputNombre = new Input("nombre_estudiante$i", 'Nombre:');
                                $inputNombre->setType('text')->setErrorMsg('Este campo es obligatorio.');

                                $inputNota1 = new Input("nota1_estudiante$i", 'Nota 1:');
                                $inputNota1->setType('number')->setMin(0)->setMax(5)->setStep(0.1)->setErrorMsg('Ingrese una nota válida.');

                                $inputNota2 = new Input("nota2_estudiante$i", 'Nota 2:');
                                $inputNota2->setType('number')->setMin(0)->setMax(5)->setStep(0.1)->setErrorMsg('Ingrese una nota válida.');

                                $inputNota3 = new Input("nota3_estudiante$i", 'Nota 3:');
                                $inputNota3->setType('number')->setMin(0)->setMax(5)->setStep(0.1)->setErrorMsg('Ingrese una nota válida.');

                                echo $inputNombre->render();
                                echo $inputNota1->render();
                                echo $inputNota2->render();
                                echo $inputNota3->render();
                                ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <?php echo $botonCalcular->render(); ?>
            </form>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_estudiante1'])): ?>
            <?php
            $estudiantes = [];
            for ($i = 1; $i <= $num_estudiantes; $i++) {
                $nombre = $_POST["nombre_estudiante$i"];
                $nota1 = $_POST["nota1_estudiante$i"];
                $nota2 = $_POST["nota2_estudiante$i"];
                $nota3 = $_POST["nota3_estudiante$i"];

                $notas = new Notas($nota1, $nota2, $nota3);
                $notas->calcularNotaFinal();

                $estudiante = new Estudiante($nombre, $notas);
                $estudiantes[] = $estudiante;
            }

            $tablaNotas = new Table();
            $tablaNotas->setTitles(['Nombre', 'Corte 1 (30%)', 'Corte 2 (30%)', 'Corte 3 (40%)', 'Nota Final', 'Porcentaje Global']);
            $tablaNotas->setData(array_map(function($estudiante) {
                return $estudiante->toArray();
            }, $estudiantes));

            $promedioSalon = number_format(array_sum(array_map(function($estudiante) {
                return $estudiante->getNotas()->getNotaFinal();
            }, $estudiantes)) / count($estudiantes), 1);

            $tablaPromedio = new Table();
            $tablaPromedio->setTitles(['Promedio de Notas del Salon']);
            $tablaPromedio->setData([['Promedio de Notas del Salon' => $promedioSalon]]);
            ?>
            
            <div class="container mt-5">
                <h2 class="text-center">Resultados de Notas</h2>
                <?php echo $tablaNotas->render(); ?>
            </div>

            <div class="container mt-5">
                <h2 class="text-center">Promedio Salon</h2>
                <?php echo $tablaPromedio->render(); ?>
            </div>
        <?php endif; ?>

        <?php echo $botonRegresar->render(); ?>
    </div>
</body>

</html>
