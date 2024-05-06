<?php
    $file_globals = parse_ini_file('globals.ini');
    foreach ($file_globals as $key => $value) {
        $GLOBALS[$key] = $value;
    }

