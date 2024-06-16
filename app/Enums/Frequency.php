<?php

namespace App\Enums;

use App\Interfaces\ValueReturner;

enum Frequency: string implements ValueReturner
{
    case DIARIO = 'Diário';
    case SEMANAL = 'Semanal';
    case MENSAL = 'Mensal';
    case BIMESTRAL = 'Bimestral';
    case TRIMESTRAL = 'Trimestral';
    case SEMESTRAL = 'Semestral';
    case ANUAL = 'Anual';

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
