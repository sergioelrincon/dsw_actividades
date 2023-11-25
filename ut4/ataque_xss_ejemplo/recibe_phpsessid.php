<?php

    echo $_GET["phpsessid"];
    file_put_contents("sessid.txt", $_GET["phpsessid"]);

?>