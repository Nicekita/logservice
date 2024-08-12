<?php

namespace App\Repository;

use Illuminate\Support\Facades\Cache;

class TelegramRepository
{

    public static function getUserId()
    {
        return Cache::get('tg_user_id');
    }

    public static function setUserId($value)
    {
        return Cache::set('tg_user_id', $value);
    }
}
