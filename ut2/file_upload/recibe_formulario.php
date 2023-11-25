<?php
    $directorio = "./ficheros/";
    $fichero = $_FILES["fichero"]["name"]

    print_r($_FILES);

    /*

    if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $directorio)) {
        echo "El fichero se ha subido correctamente";
    } else {
        echo "Error al subir el fichero al servidor";
    }
    */
}
?>