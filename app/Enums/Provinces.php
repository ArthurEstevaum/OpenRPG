<?php

namespace App\Enums;
use App\Interfaces\ValueReturner;
enum Provinces : string implements ValueReturner
{
    case AC = "Acre";
    case AL = "Alagoas";
    case AP = "Amapá";
    case AM = "Amazonas";
    case BA = "Bahia";
    case CE = "Ceará";
    case ES = "Espírito santo";
    case GO = "Goiás";
    case MA = "Maranhão";
    case MT = "Mato grosso";
    case MS = "Mato grosso do sul";
    case MG = "Minas gerais";
    case PA= "Pará";
    case PB = "Paraíba";
    case PR = "Paraná";
    case PE = "Pernambuco";
    case PI = "Piauí";
    case RJ = "Rio de janeiro";
    case RN = "Rio grande do norte";
    case RS = "Rio grande do sul";
    case RO = "Rondônia";
    case RR = "Roraima";
    case SC = "Santa catarina";
    case SP = "São paulo";
    case SE = "Sergipe";
    case TO  = "Tocantins";

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