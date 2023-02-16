<?php

/**
 * Provides a type hint-able object holding an array of a specific class (or inheritor of specified class).
 * This allows type safety when receiving an array as an argument and ensuring it only contains valid instances of a given class
 */
abstract class ClassArray extends \ArrayObject
{
    /**
     * Return the fully qualified class name that array should contain
     *
     * @return string
     */
    abstract protected function className(): string;

    public function __construct(array $objects)
    {
        array_walk($objects, [$this, 'validateType']);
        parent::__construct($objects);
    }

    public function offsetSet($key, $value): void
    {
        $this->validateType($value);
        parent::offsetSet($key, $value);
    }

    /**
     * @param $value
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateType($value): void
    {
        $type = $this->className();

        if (! is_object($value) || ! ($value instanceof $type)) {
            throw new InvalidArgumentException('Only objects of type ' . $type . ' allowed.');
        }
    }
}
