<?php

require_once "default.php";

function FooString(string $string, int $n = 3): array
{
    if (
        (bool) ((int) strlen($string) === 0) === true ||
        (bool) ((int) $n <= 0) === true
    ) {
        return [];
    }

    return array_fill(0, $n, $string);
}

/**
 * Chamada de uma função a partir de uma string
 */
dd('FooString'('Hello!', 5));
