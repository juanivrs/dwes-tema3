<?php
require "lengua.php";
// alt + shift + f -> Formatter

function formprint($error = array("nombre" => "","fichero" => "","repetido" => ""), $nombre = "")
{
    echo "<h1>" . getCadena('subirh1') . "</h1>";
    echo <<<END
    <div class="formdiv">
    <form action="#" method="POST" enctype="multipart/form-data">
    END;

    echo "<label>" . getCadena('nombrefichero') . "</label>";
    echo "<input type='text' name='text' value='$nombre'  > </input>";
    echo $error["nombre"] === "" ? "" : "<p style='color:orange'>".$error["nombre"]."</p>";
    echo '<label>' . getCadena('seleccionfichero') . '</label>';
    echo $error["fichero"] === "" ? "" : "<p style='color:red'>".$error["fichero"]."</p>";
    echo $error["repetido"] === "" ? "" : "<p style='color:red'>".$error["repetido"]."</p>";
    if ( $error["repetido"] === "" && $error["fichero"] === "" && $error["nombre"] === "" && $_POST ){
        echo "<p style='color:green'>Subido con éxito</p>";
    }
    echo  '<input name="fichero_usuario" type="file">';
    echo "<input type='submit' value=". getCadena('botonenviar').">";
    echo '</form>';
   echo '</div>';
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>

    <?php
    echo printHeader($idioma, "subir");
    $errorfichero = "";
    $nombrefichero = "";
    if (!$_POST) {
        formprint();
    } else {
        $nombre = htmlspecialchars(trim($_POST['text']));
        if (
            $_FILES && isset($_FILES['fichero_usuario']) &&
            $_FILES['fichero_usuario']['error'] === UPLOAD_ERR_OK &&
            $_FILES['fichero_usuario']['size'] > 0
        ) {
            $error= array(
                "nombre" => "",
                "fichero" => "",
                "repetido" => "",
            );
            $allowedext = array('gif', 'png', 'jpg', 'pdf');
            $allowedmime = array('image/gif', 'image/png', 'image/jpg', 'application/pdf', 'image/jpeg');
            $filename = $_FILES['fichero_usuario']['name'];
            $filemime = $_FILES['fichero_usuario']['tmp_name'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_fichero = finfo_file($finfo, $filemime);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowedext) || !in_array($mime_fichero, $allowedmime)) {
                $error["fichero"]="No se pueden subir ficheros con otra extensión.";
            } else {
                if (!empty($nombre)) {
                    $_FILES['fichero_usuario']['name'] = $nombre . "." . "$ext";
                } else {
                    $error["nombre"]="Nombre vacío, se dejará el nombre del archivo subido."; 
                }
                $rutaFicheroDestino = './ficheros/' . basename($_FILES['fichero_usuario']['name']);

                if (file_exists($rutaFicheroDestino)) {
                    $error["repetido"]="ERROR: El archivo ya se encuentra en la base de datos.";
                } else {
                    $seHaSubido = move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $rutaFicheroDestino);
                }
            }
        }
        formprint($error, $nombre);
    }

    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>