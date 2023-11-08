<?php 

namespace App\Enums;
use App\Interfaces\ValueReturner;

enum SubGenres : string implements ValueReturner
{
    case ACAO = "Ação";
    case AVENTURA = "Aventura";
    case COMEDIA = "Comédia";
    case MISTERIO = "Mistério";
    case INVESTIGACAO = "Investigação";
    case HORROR = "Horror";
    case GUERRA = "Guerra";
    case PIRATARIA = "Pirataria";

    case EXPLORACAO = "Exploração";

    /**
     * Returns an array with keys equal to each enum case, and the array value
     * equal to enum case corresponding string.
     * @return array
     */
    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Return a string corresponding to a random enum case.
     * @return string
     */
    public static function getRandomValue(): string
    {
        $randomKey = array_rand(self::getAllValues());
        return self::getAllValues()[$randomKey];
    }
}