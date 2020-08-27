<?php

final class Person
{
    /** @var string */
    private string $name;

    /** @var int */
    static $i = 1;

    public function __construct(string $name)
    {
        $this->name = $name;
        echo self::$i . 'DENTRO DO CONSTRUTOR';
        self::$i++;
    }

    public function __get(string $str)
    {
        return $this->$str;
    }

    public function __toString()
    {
        return $this->name . ' <---';
    }
    public function toXml()
    {
        return <<<XML
            <pessoa>teste</pessoa>
        XML;
    }
}


$john = new Person('John');
echo $john->__get('name');
echo $john::$i;
echo $john;

echo "\n" . "(*-*)" . "\n";

$peter = new Person('Peter');
echo $peter->__get('name');
echo $peter::$i;

echo "\n" . "(*-*)" . "\n";

$marcos = new Person('Marcos');
echo $marcos->__get('name');
echo $marcos::$i;

echo $marcos->toXml();
