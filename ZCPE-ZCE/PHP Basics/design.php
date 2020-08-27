<?php

$design = [
    "app" => [
        "Http" => [
            "Controllers" => [
                "Color" => [
                    "ColorController.php",
                    "DOMColor.php"
                ]
            ],
        ],
        "Models" => [
            "Color" => [
                "Color.php",
                "ColorValidator.php"
            ]
        ]
    ],
    "resources" => [
        "views" => [
            "pages" => [
                "colors" => [
                    "create.blade.php",
                    "update.blade.php"
                ]
            ],
            "components" => []
        ]
    ]
];

/**
 * Validator Interface.
 */
interface IValidator{}

/**
 * Validator Class.
 */
abstract class ClassValidator implements IValidator{}

/**
 * StringValidator Class.
 */
final class StringValidator extends ClassValidator{}


PHP_EOL;


class Model {}

class UserValidator {}

final class User extends Model{}


PHP_EOL;


interface IDOM{}

abstract class DOM implements IDOM{}

final class ViewList extends DOM{
    public function __get(){}
    public function __set(){}
    public function render(){}
}

