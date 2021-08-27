<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Models\User;

/**
 * @method static paginationArguments(array $data)
 * @method static getPaginationArguments(array $data)
 * @method static updateUser(array $data, User $user)
 * @method static updateCandidate(array $data, User $user)
 * @method static updateCompany(array $data, User $user)
 * @method static deleteCompany(User $user)
 * @method static deleteCandidate(User $user)
 * @method static deleteUser(User $user)
 */
class UserServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userfacade';
    }
}
