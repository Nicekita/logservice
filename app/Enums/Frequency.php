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

}
