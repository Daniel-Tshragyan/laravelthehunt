<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Modles\Job;

/**
 * @method static paginationArguments(array $data)
 * @method static getPagination(array $data)
 * @method static frontJobGetPagination(array $data)
 * @method static deleteJob(Job $job)
 * @method static jobFill(array $data, Job $job)
 * @method static JobUpdate(array $data, Job $job)
 * @method static jobFrontFill(array $data)
 * @method static changeCategoryJobCount(int $id)
 * @method static apply(int $id)
 */
class JobFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jobfacade';
    }
}
