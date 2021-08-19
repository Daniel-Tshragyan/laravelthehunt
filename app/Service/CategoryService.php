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
    public function paginationArguments(Request $request)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['title' => '', 'jobs_count' => '', 'id' => '', 'sort' => '',];
        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }
        if ($request->input("how")) {
            $how = $request->input('how');
        }
        foreach ($searched as $key => $value) {
            if ($request->input($key) || (!is_null($request->input($key)) && $request->input($key) == 0)) {
                if ($key == 'title') {
                    $where[] = [$key, 'like', "%{$request->input($key)}%"];
                    $withPath .= "&{$key}={$request->input($key)}";
                    $searched[$key] = $request->input($key);
                } else {
                    $where[] = [$key, '=', "{$request->input($key)}"];
                    $withPath .= "&{$key}={$request->input($key)}";
                    $searched[$key] = $request->input($key);
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

    public function categoryCreate(CategoryValidator $request)
    {
        $random = Str::random(60);
        $imageName = $random . '.' . $request->file('image')->extension();
        $category = new Category();
        $category->fill(
            [
                'title' => $request->input('title'),
                'sort' => $request->input('sort'),
                'image' => $imageName,
            ]
        );
        $category->save();
        return $request->file('image')->storeAs('public/categories_images', $imageName);
    }

    public function categoryUpdate(CategoryValidator $request, Category $category)
    {
        $categoryInformation = [
            'title' => $request->input('title'),
            'sort' => $request->input('sort'),
        ];

        if ($request->input('image')) {
            $random = Str::random(60);
            Storage::delete('/public/users_images/' . $category->image);
            $imageName = $random . '.' . $request->file('image')->extension();
            $categoryInformation['image'] = $imageName;
            $request->file('image')->storeAs('public/categories_images', $imageName);
        }
        $category->fill($categoryInformation);
        $category->save();
    }

}
