<?php

namespace App\Facades;

use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getAllDialogs()
 * @method static getActiveDialog(array $data, User $user)
 * @method static send(arr $data, User $user)
 */
class MessageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'messagefacade';
    }
}
