<?php

$callable = function (string $str): string {
    return $str;
};

/* Closure (class) must be an anonymous function, where callable (type) also can be a normal function. */

$fn = function (Closure $callable, $str) {
    return $callable($str);
};

echo $fn($callable, "John Doe");

$fun = array_map(function (int $n) {
    return 2 * $n;
}, [1, 2, 3, 4, 5]);

$fun = array_map(fn (int $n) => 2 * $n, [1, 2, 3, 4, 5]);

var_dump($fun);
