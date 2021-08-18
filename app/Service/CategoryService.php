<?php

namespace App\Service;


use Illuminate\Http\Request;

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
        return $returnObject = [ 'withPath' => $withPath,'order_by' => $order_by,'searched' =>$searched,
            'where' => $where,'how' => $how ];
    }
}
