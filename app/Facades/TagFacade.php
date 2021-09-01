<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Models\Tag;

/**
 * @method static paginationArguments(array $data)
 * @method static getPaginationArguments(array $data)
 * @method static createTag(array $data)
 * @method static updateTag(Tag $tag, array $data)
 * @method static deleteTag(Tag $tag, array $data)
 */
class TagFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tagfacade';
    }
}
