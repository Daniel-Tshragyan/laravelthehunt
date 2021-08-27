<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Modles\Plan;


/**
 * @method static paginationArguments(array $data)
 * @method static getPagination(array $data)
 * @method static deletePlan(Plan $plan)
 * @method static fillPlan(array $data)
 * @method static apply(int $id)
 * @method static updatePlan(array $data, Plan $plan)
 */

class PlanFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'planfacade';
    }
}
