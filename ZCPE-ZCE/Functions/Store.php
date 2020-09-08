<?php

function fun(string $str, int $n): array
{
    return (strlen($str) === 0 || $n < 0) ? [] : array_fill(0, $n, $str);
};

var_dump('fun'(date("Y/m/d H:i:s"), 5));
