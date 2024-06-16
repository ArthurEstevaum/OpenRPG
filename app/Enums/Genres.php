<?php

namespace App\Enums;

use App\Interfaces\ValueReturner;

enum Genres: string implements ValueReturner
{
    case MEDIEVAL_FANTASY = 'Fantasia Medieval';
    case SCI_FI = 'Sci-fi';
    case STEAMPUNK = 'Steampunk';
    case DARK_FANTASY = 'Fantasia Sombria';

    case GENERIC = 'Genérico';

    /**
     * Returns an array with keys equal to each enum case, and the array value
     * equal to enum case corresponding string.
     */
    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Return a string corresponding to a random enum case.
     */
    public static function getRandomValue(): string
    {
        $randomKey = array_rand(self::getAllValues());

        return self::getAllValues()[$randomKey];
    }
}
