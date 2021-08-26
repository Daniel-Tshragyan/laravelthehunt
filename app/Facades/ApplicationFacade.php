<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getApplications(array $data,int $id)
 */
class ApplicationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'applicationfacade';
    }
}
