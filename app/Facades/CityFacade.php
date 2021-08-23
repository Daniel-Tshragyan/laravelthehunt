<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Models\City;

/**
 * @method static paginationArguments(array $data)
 * @method static getPagination(array $data)
 * @method static fillCity(array $data, City $city)
 * @method static deleteCity(City $city)
 */
class CityFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cityfacade';
    }
}
