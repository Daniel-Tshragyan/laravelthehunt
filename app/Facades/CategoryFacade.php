<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Models\Category;

/**
 * @method static paginationArguments(array $data)
 * @method static getPagination(array $data)
 * @method static categoryCreate(array $data)
 * @method static categoryUpdate(array $data, Category $category)
 * @method static deleteCategory(Category $category)
 */
class CategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'categoryfacade';
    }
}
