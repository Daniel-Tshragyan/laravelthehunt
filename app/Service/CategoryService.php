<?php

namespace App\Service;


use App\Http\Requests\CategoryValidator;
use App\Models\Category;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryService
{
    public function paginationArguments($data)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['title' => '', 'jobs_count' => '', 'id' => '', 'sort' => '',];
        if (isset($data["order_by"])) {
            $order_by = $data["order_by"];
        }
        if (isset($data["how"])) {
            $how = $data["how"];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'title') {
                    $where[] = [$key, 'like', "%{$data[$key]}%"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                } else {
                    $where[] = [$key, '=', "{$data[$key]}"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                }
            }
        }
        return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPagination($data)
    {
        if (!empty($data['where'])) {
            $category = Category::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $category->withPath("city?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);

        } else {
            $category = Category::orderBy($data['order_by'], $data['how'])->paginate(3);
            $category->withPath("city?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }

        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how'], 'jobs_cont' => $data['how'],
            'sort' => $data['how']];
        $newarray = ['categories' => $category, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

        return $newarray;
    }

    public function categoryCreate($data)
    {
        $random = Str::random(60);
        $imageName = $random . '.' . $data['image']->extension();
        $category = new Category();
        $category->fill(
            [
                'title' => $data['title'],
                'sort' => $data['sort'],
                'image' => $imageName,
            ]
        );
        $category->save();
        return $data['image']->storeAs('public/categories_images', $imageName);
    }

    public function categoryUpdate($data, Category $category)
    {
        $categoryInformation = [
            'title' => $data['title'],
            'sort' => $data['sort'],
        ];

        if ($data['image']) {
            $random = Str::random(60);
            Storage::delete('/public/users_images/' . $category->image);
            $imageName = $random . '.' . $data['image']->extension();
            $categoryInformation['image'] = $imageName;
            $data['image']->storeAs('public/categories_images', $imageName);
        }
        $category->fill($categoryInformation);
        $category->update();
    }

    public function deleteCategory(Category $category)
    {
        Storage::delete('/public/categories_images/' . $category->image);
        foreach ($category->job as $job) {
            $job->fill(['category_id' => null]);
            $job->update();
        }
        return $category->delete();
    }

}
