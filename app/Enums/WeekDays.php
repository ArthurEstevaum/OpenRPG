<?php

namespace App\Enums;
use App\Interfaces\ValueReturner;

enum WeekDays : string implements ValueReturner
{
    case SEGUNDA = "Segunda-feira";
    case TERCA = "Terça-feira";
    case QUARTA = "Quarta-feira";
    case QUINTA = "Quinta-feira";
    case SEXTA = "Sexta-feira";
    case SABADO  = "Sábado";
    case DOMINGO = "Domingo";

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