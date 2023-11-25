<?php
    // Módulos
    define("MODULO_DSW", "Desarrollo web en entorno servidor");
    define("MODULO_DOR", "Diseño de interfaces web");
    define("MODULO_EMR", "Empresa e iniciativa emprendedora");

    // Docentes
    define("DOCENTE_SERGIO", "Sergio Ramos Suárez");
    define("DOCENTE_LOURDES", "Lourdes Ventura Urbina");
    define("DOCENTE_MARISOL", "María del Sol García Tarajano");

    // Talleres
    define("TALLER_201", "201");

    // Actividades
    define("ACTIVIDAD_DSW", array("modulo"=>MODULO_DSW, "docente"=>DOCENTE_SERGIO, "taller"=>TALLER_201));
    define("ACTIVIDAD_DOR", array("modulo"=>MODULO_DOR, "docente"=>DOCENTE_LOURDES, "taller"=>TALLER_201));
    define("ACTIVIDAD_EMR", array("modulo"=>MODULO_EMR, "docente"=>DOCENTE_MARISOL, "taller"=>TALLER_201));

    // HORARIO
    // Lunes
    $arrayHorario[0][0] = ACTIVIDAD_DSW;
    $arrayHorario[0][1] = $arrayHorario[0][2] = ACTIVIDAD_DOR;
    $arrayHorario[0][3] = $arrayHorario[0][4] = $arrayHorario[0][5] = ACTIVIDAD_EMR;

    // Martes
    $arrayHorario[1][0] = ACTIVIDAD_DOR;
    $arrayHorario[1][1] = ACTIVIDAD_DOR;
    $arrayHorario[1][2] = ACTIVIDAD_DOR;
    $arrayHorario[1][3] = ACTIVIDAD_EMR;
    $arrayHorario[1][4] = ACTIVIDAD_DSW;
    $arrayHorario[1][5] = ACTIVIDAD_DSW;
?>