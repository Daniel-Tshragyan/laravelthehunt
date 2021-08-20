<?php

namespace App\Service;


use App\Http\Requests\CategoryValidator;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryService
{
    public function paginationArguments($arr)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['title' => '', 'jobs_count' => '', 'id' => '', 'sort' => '',];
        if (isset($arr["order_by"])) {
            $order_by = $arr["order_by"];
        }
        if (isset($arr["how"])) {
            $how = $arr["how"];
        }
        foreach ($searched as $key => $value) {
            if (isset($arr[$key]) || isset($arr[$key]) && (!is_null($arr[$key]) && $arr[$key] == 0)) {
                if ($key == 'title') {
                    $where[] = [$key, 'like', "%{$arr[$key]}%"];
                    $withPath .= "&{$key}={$arr[$key]}";
                    $searched[$key] = $arr[$key];
                } else {
                    $where[] = [$key, '=', "{$arr[$key]}"];
                    $withPath .= "&{$key}={$arr[$key]}";
                    $searched[$key] = $arr[$key];
                }
            }
        }
        return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPagination($array)
    {
        if (!empty($array['where'])) {
            $category = Category::where($array['where'])->orderBy($array['order_by'], $array['how'])->paginate(3);
            $category->withPath("city?order_by={$array['order_by']}&how={$array['how']}" . $array['withPath']);

        } else {
            $category = Category::orderBy($array['order_by'], $array['how'])->paginate(3);
            $category->withPath("city?order_by={$array['order_by']}&how={$array['how']}");
        }
        if ($array['how'] == 'asc') {
            $array['how'] = 'desc';
        } else {
            $array['how'] = 'asc';
        }
        $array['sorts'] = ['id' => $array['how'], 'title' => $array['how'], 'jobs_cont' => $array['how'],
            'sort' => $array['how']];
        $newarray = ['categories' => $category, 'sorts' => $array['sorts'], 'searched' => $array['searched']];

        return $newarray;
    }

    public function categoryCreate($arr)
    {
        $random = Str::random(60);
        $imageName = $random . '.' . $arr['image']->extension();
        $category = new Category();
        $category->fill(
            [
                'title' => $arr['title'],
                'sort' => $arr['sort'],
                'image' => $imageName,
            ]
        );
        $category->save();
        return $arr['image']->storeAs('public/categories_images', $imageName);
    }

    public function categoryUpdate($arr, Category $category)
    {
        $categoryInformation = [
            'title' => $arr['title'],
            'sort' => $arr['sort'],
        ];

        if ($arr['image']) {
            $random = Str::random(60);
            Storage::delete('/public/users_images/' . $category->image);
            $imageName = $random . '.' . $arr['image']->extension();
            $categoryInformation['image'] = $imageName;
            $arr['image']->storeAs('public/categories_images', $imageName);
        }
        $category->fill($categoryInformation);
        $category->save();
    }

}
