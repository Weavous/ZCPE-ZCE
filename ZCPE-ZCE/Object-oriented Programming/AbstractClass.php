<?php

/**
 * Animal class.
 */
abstract class Animal
{
    /**
     * Bark Method.
     * 
     * @param void
     * */
    public abstract function Bark(): string;
}

/**
 * Dog class.
 */
final class Dog extends Animal
{
    /**
     * Bark Method.
     * 
     * @param void
     */
    public function Bark(): string
    {
        return "Au, Au";
    }

    /**
     * Get An Instance.
     * 
     * @param void
     */
    public static function init(): self
    {
        return new Self();
    }
}


echo Dog::init()->Bark();
