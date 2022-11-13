<?php
require "lengua.php";
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
    echo printHeader($idioma, "cloud");
    $todosFicheros = scandir('./ficheros');
    $ficherosTxt = [];
    if ($todosFicheros !== false) {
        foreach ($todosFicheros as $fic) {
            if (pathinfo($fic, PATHINFO_EXTENSION) == 'pdf') {
                $ficherosPdf[] = "./ficheros/$fic";
            } else if (pathinfo($fic, PATHINFO_EXTENSION) == 'gif') {
                $ficherosGif[] = "./ficheros/$fic";
            } else if (pathinfo($fic, PATHINFO_EXTENSION) == 'png') {
                $ficherosPng[] = "./ficheros/$fic";
            } else if (pathinfo($fic, PATHINFO_EXTENSION) == 'jpg') {
                $ficherosJpg[] = "./ficheros/$fic";
            }
        }
    }

    echo  "<h1 class='pdfhead'>PDF</h1>";
    echo "<table class='pdftable'>";
    for ($i = 0; $i < sizeof($ficherosPdf); $i++) {
        $nombre = mb_substr($ficherosPdf[$i], 11);
        echo "<tr> <td> <a href='{$ficherosPdf[$i]}' download='true'>$nombre </a> </td> </tr>";
    }
    echo '</table>';

    echo  "<h1 class='pdfhead'>PNG,JPG,GIF</h1>";
    echo "<div class='flexbox'>";
    for ($i = 0; $i < sizeof($todosFicheros); $i++) {
        // $nombre=mb_substr($ficherosPdf[$i],11);
        if (pathinfo($todosFicheros[$i], PATHINFO_EXTENSION) == 'gif' || pathinfo($todosFicheros[$i], PATHINFO_EXTENSION) == 'png' || pathinfo($todosFicheros[$i], PATHINFO_EXTENSION) == 'jpg')
            echo "<div class='caja'> <a href='/ficheros/{$todosFicheros[$i]}' target='_BLANK'><img src='/ficheros/{$todosFicheros[$i]}'></a></div>";
    }
    echo "</div>";
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>