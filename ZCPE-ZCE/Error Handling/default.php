<?php


/** show errors */
ini_set("display_errors", true);
ini_set("display_startup_errors", true);

error_reporting(E_ALL);

ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);

/** debug function */
function dd(array $data = [], bool $exit = false)
{
    echo "<pre>";

    print_r($data);

    echo "</pre>";

    if ($exit === true) {
        die();
    }
}
