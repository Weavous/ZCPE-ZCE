<?php

/**
 * Constant Class.
 */
class Constant
{
    public const VERSION = '1.7.2';
}

/**
 * InheritanceConstant Class.
 */
class InheritanceConstant extends Constant
{
    /**
     * Constructor Method.
     * 
     * @param void
     */
    public function __construct()
    {
    }

    /**
     * Return an Instance.
     * 
     * @param void
     */
    public static function init(): self
    {
        return new Self();
    }

    /**
     * Returns Version.
     * 
     * @param void
     */
    public function version(): string
    {
        return parent::VERSION;
    }
}


echo InheritanceConstant::init()->version() . PHP_EOL;

echo Constant::VERSION . PHP_EOL;

echo InheritanceConstant::VERSION . PHP_EOL;
