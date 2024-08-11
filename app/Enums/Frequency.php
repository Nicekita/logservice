<?php

namespace App\Enums;

enum Frequency: string
{
    case SECONDLY = 'SECONDLY';
    case MINUTELY = 'MINUTELY';
    case HOURLY = 'HOURLY';
    case DAILY = 'DAILY';
    case WEEKLY = 'WEEKLY';
    case MONTHLY = 'MONTHLY';
    case YEARLY = 'YEARLY';


    public static function translate(Frequency $frequency): string
    {
        return match ($frequency) {
            Frequency::SECONDLY => 'секунд',
            Frequency::MINUTELY => 'минут',
            Frequency::HOURLY => 'часов',
            Frequency::DAILY => 'дней',
            Frequency::WEEKLY => 'недель',
            Frequency::MONTHLY => 'месяцев',
            Frequency::YEARLY => 'лет',
        };
    }

}
