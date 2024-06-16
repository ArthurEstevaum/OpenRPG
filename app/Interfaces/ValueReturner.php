<?php

namespace App\Interfaces;

interface ValueReturner
{
    /**
     * Returns an array with keys equal to each enum case, and the array value
     * equal to enum case corresponding string.
     */
    public static function getAllValues(): array;

    /**
     * Return a string corresponding to a random enum case.
     */
    public static function getRandomValue(): string;
}
