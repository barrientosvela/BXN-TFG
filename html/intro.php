<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleBasic.css">
    <link rel="stylesheet" href="../css/styleIntro.css">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Inserción</title>
</head>

<body>
    <header class="cabecera">
        <p>BXN</p>
    </header>

    <form action="#" method="post">
        <h1>Inserción de datos en BD</h1>
        <p>Introduzca los datos:</p>
        <p><span>Datos:</span>
            <select class="campo" name="tipo">
                <option value="Beatboxer">Beatboxer</option>
                <option value="Competicion">Competición</option>
            </select>
        </p>
        <p>
            <!-- Común para la tabla beatboxer y competicion -->
            <span>Nombre:</span>
            <input class="campo" name="nombre" type="text" />
        </p>
        <p>
            <!-- Beatboxer -->
            <span>Edad:</span>
            <input class="campo" name="edad" type="number" />
        </p>
        <p>
            <!-- Beatboxer -->
            <span>Nacionalidad:</span>
            <input class="campo" name="nacionalidad" type="text" />
        </p>
        <p>
            <!-- Beatboxer -->
            <span>Apodo:</span>
            <input class="campo" name="apodo" type="text" />
        </p>
        <p>
            <!-- competicion -->
            <span>Organización:</span>
            <input class="campo" name="organizacion" type="text" />
        </p>
        <p>
            <!-- competicion -->
            <span>Descripción:</span>
            <textarea class="campo" name="descripcion" cols="50" rows="5"></textarea>
        </p>
        <input type="submit" value="Insertar" name="insert">
        <input type="reset" value="Limpiar">
    </form>
    <?php
    // Declara variables necesarias
    $errores = "";

    // Obtiene los valores del formulario
    if (isset($_REQUEST['insert'])) {
        $datos = $_REQUEST['tipo'];
        $nombre = $_REQUEST['nombre'];
        if ($datos == "Beatboxer") {
            $edad = $_REQUEST['edad'];
            $nacionalidad = $_REQUEST['nacionalidad'];
            $apodo = $_REQUEST['apodo'];

            if (!is_numeric($edad) || $edad < 0) {
                $errores = $errores . "<li>La edad debe ser un valor numérico mayor a 0\n</li>";
            }
            if (empty($apodo)) {
                $errores = $errores . "<li>Se requiere un apodo\n</li>";
            }
        } else {
            $organizacion = $_REQUEST['organizacion'];
            $descripcion = $_REQUEST['descripcion'];
        }

        // Comprueba valores correctos
        if (empty($nombre)) {
            $errores = $errores . "<li>Se requiere un nombre\n</li>";
        }

        // Si hay errores los muestra sino muestra los datos introducidos
        if ($errores == "") {
            // Segun el tipo crea una consulta u otra
            if ($datos == "Beatboxer") {
                $consulta = "beatboxer (id, nombre, edad, nacionalidad, apodo) VALUES ('','$nombre', '$edad', '$nacionalidad', '$apodo')";
            } else {
                $consulta = "competicion (id, nombre, organizacion, descripcion) VALUES ('','$nombre', '$organizacion', '$descripcion')";
            }
            // Conecta con la BD
            $conect = mysqli_connect("localhost", "root", "", "bxn");
            if (mysqli_connect_errno()) {
                echo "Fallo al conectar con la base de datos" . mysqli_connect_error();
                exit;
            } else {
                // Inserta los datos
                mysqli_query($conect, "INSERT INTO $consulta");
                print("<h1>Datos introducidos correctamente</h1>");
            }
        } else {
            // Muestra errores
            print("<p>No se ha podido realizar la inserción debido a los siguientes errores:</p>\n");
            print("<ul>");
            print($errores);
            print("</ul>");
            // Enlace para volver al formulario con los datos introducidos anteriormente
            print("<p><a href='javascript:history.back()'>Volver</a></p>\n");
        }
    }
    ?>
    <div class="footer">
        <p>Parte del texto contenido en esta web esta generado con GPT-3 un modelo IA aún en fase beta <a href="https://openai.com/api/" target="_blank">Página oficial</a></p>
        <img src="../images/Logo2.0.png" alt="">
    </div>
    <p><a href='busqueda.php'><button>Buscar</button></a></p>
</body>

</html>