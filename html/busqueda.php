<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleBasic.css">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Busqueda</title>
</head>

<body>
    <header class="cabecera">
        <p>BXN</p>
    </header>
    <!-- Barra de busqueda -->
    <form action="#" method="post">
        <p><span>Tipo:</span>
            <select class="campo" name="tipo">
                <option value="Cualquiera">Cualquiera</option>
                <option value="Betaboxer">Betaboxer</option>
                <option value="Competicion">Competición</option>
            </select>
        </p>
        <input type="text" name="busqueda">
        <input class="btn-buscar" type="submit" name="buscar">
    </form>
    <p><a href='intro.php'><button>Insertar datos</button></a></p>
    <?php
    // Declara variables necesarias
    $resultado = $extrasCadena = "";
    // Cuando pulsa el boton de buscar recoje los datos
    if (isset($_REQUEST['buscar'])) {
        $tipo = $_REQUEST['tipo'];
        $busqueda = $_REQUEST['busqueda'];

        // Conecta a la BD
        $conect = mysqli_connect("localhost", "root", "", "bxn");
        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos" . mysqli_connect_error();
            exit;
        } else {
            // Envia consulta
            if (empty($_REQUEST['busqueda']) && $tipo == 'Betaboxer') {
                $resultado = mysqli_query($conect, "SELECT * FROM beatboxer");
            } else {
                if (empty($_REQUEST['busqueda']) && $tipo == 'Competicion') {
                    $resultado = mysqli_query($conect, "SELECT * FROM competicion");
                } else {
                    $resultado = mysqli_query($conect, "SELECT * FROM beatboxer, competicion, user");
                }
            }
        }
    ?>
        <!-- Muestra tabla con resultados -->
        <table>
            <tr>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Nacionalidad</th>
                <th>Apodo</th>
                <th>Organización</th>
                <th>Descripción</th>
            </tr>
            <?php
            // Mientras haya resultado de la consulta muestra otra fila en la tabla
            while ($arrayCunsulta = mysqli_fetch_array($resultado)) {
            ?>
                <tr>
                    <td><?php echo $arrayCunsulta['nombre'] ?></td>
                    <td><?php echo $arrayCunsulta['nombre'] ?></td>
                    <td><?php if (empty($arrayCunsulta['edad'])) {
                            echo '        - ';
                        } else {
                            echo $arrayCunsulta['edad'];
                        } ?></td>
                    <td><?php if (empty($arrayCunsulta['nacionalidad'])) {
                            echo '        - ';
                        } else {
                            echo $arrayCunsulta['nacionalidad'];
                        } ?></td>
                    <td><?php if (empty($arrayCunsulta['apodo'])) {
                            echo '        - ';
                        } else {
                            echo $arrayCunsulta['apodo'];
                        } ?></td>
                    <td><?php if (empty($arrayCunsulta['organizacion'])) {
                            echo '        - ';
                        } else {
                            echo $arrayCunsulta['organizacion'];
                        } ?></td>
                    <td><?php if (empty($arrayCunsulta['descripcion'])) {
                            echo '        - ';
                        } else {
                            echo $arrayCunsulta['descripcion'];
                        } ?></td>
                </tr>
        <?php
            }
        }
        ?>
        </table>
        <div class="footer">
            <p>Parte del texto contenido en esta web esta generado con GPT-3 un modelo IA aún en fase beta <a href="https://openai.com/api/" target="_blank">Página oficial</a></p>
            <img src="../images/Logo2.0.png" alt="">
        </div>
        <script src="#"></script>
</body>

</html>