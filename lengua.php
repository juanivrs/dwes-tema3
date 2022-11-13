<?php


$idioma = 'es';


if ($_GET && isset($_GET['idioma'])) {
    if (in_array($_GET['idioma'], ['es', 'en'])) {
        $idioma = in_array($_GET['idioma'], ['es', 'en']) ? $_GET['idioma'] : 'es';
    }
}



$cadenas = [

    'bienvenida' => [

        'es' => 'Bienvenid@ a mi sitio web',

        'en' => 'Welcome to my website'

    ],

    'saludo' => [

        'es' => 'Hola',

        'en' => 'Hello'

    ],

    'despedida' => [

        'es' => 'Adiós',

        'en' => 'Bye'

    ],
    'botonsubir' => [
        'es' => 'Empieza a subir tus archivos',

        'en' => 'Start uploading your files'
    ],
    'subirh1' => [
        'es' => 'Sube ficheros PDF o imágenes GIF,PNG y JPEG',

        'en' => 'Upload PDF files or GIF,PNG and JPEG images'
    ],
    'nombrefichero' => [
        'es' => 'Nombre del fichero:',

        'en' => 'Filename:'
    ],
    'seleccionfichero' => [
        'es' => 'Selecciona un fichero:',

        'en' => 'Select a file:'
    ],
    'principal' => [
        'es' => 'Principal',

        'en' => 'Home'
    ],
    'subir' => [
        'es' => 'Subir',

        'en' => 'Upload'
    ],
    'nube' => [
        'es' => 'Nube',

        'en' => 'Cloud'
    ]

];


function getCadena(string $id): string

{

    global $idioma, $cadenas;


    if (isset($cadenas[$id])) {

        return $cadenas[$id][$idioma];
    } else {

        return "Error interno: la cadena identificada con $id no existe";
    }
}
function printHeader($id, $actual)
{


    echo <<<"END"
            <header>
            <nav class="navbar navbar-dark bg-dark">
            <ul>
         END;
    echo $actual == "index" ? "<li><a class='active' href='index.php?idioma=$id'>" . getCadena("principal") . "</a></li>" : "<li><a href='index.php?idioma=$id'>" . getCadena("principal") . "</a></li>";
    echo $actual == "subir" ? "<li><a class='active' href='subir.php?idioma=$id'>" . getCadena("subir") . "</a></li>"  : "<li><a href='subir.php?idioma=$id'>" . getCadena("subir") . "</a></li>";
    echo $actual == "cloud" ?  "<li><a class='active' href='cloud.php?idioma=$id'>" . getCadena("nube") . "</a></li>" : "<li><a href='cloud.php?idioma=$id'>" . getCadena("nube") . "</a></li>";
    echo  <<<"END"
            </ul>
            <form class="lang" action="#" method="get">
            <p>
                <select class="langbutton" name="idioma">
            END;
    echo $id == "es" ? '<option value="es" selected="true">Es</option>' :  '<option value="es">Es</option>';
    echo $id == "en" ? '<option value="en" selected="true">En</option>' : ' <option value="en">En</option>';

    echo <<<"END"
        </select>
        </p>
            <input class="langok" type="submit" value="Ok"> 
        </form>
        </nav>
        </header>
    END;
}
