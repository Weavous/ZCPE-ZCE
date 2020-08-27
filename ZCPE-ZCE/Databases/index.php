<?php

declare(strict_types=1);

require_once("DB.php");
require_once("Query.php");

/** show errors */
ini_set('display_errors', "true");
ini_set('display_startup_errors', "true");

error_reporting(E_ALL);

$stub = \Query::create()
    ->find(
        [
            'fields' => [
                'colors.id',
                'colors.created_on',
                'colors.hexadecimal'
            ],
            'table' => 'colors'
        ]
    );


var_dump($stub);
