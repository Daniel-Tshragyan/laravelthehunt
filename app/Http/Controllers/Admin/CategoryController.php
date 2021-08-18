<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryService = new CategoryService();
        $paginationArguments = $categoryService->paginationArguments($request);
        $withPath = $paginationArguments['withPath'];
        $order_by = $paginationArguments['order_by'];
        $how = $paginationArguments['how'];
        $where = $paginationArguments['where'];
        $searched = $paginationArguments['searched'];

        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }
        if (!empty($where)) {
            $categories = Category::where($where)->orderBy($order_by, $how)->paginate(3);
            $categories->withPath("user?order_by={$order_by}&how={$how}" . $withPath);
        } else {
            $categories = Category::orderBy($order_by, $how)->paginate(3);
            $categories->withPath("user?order_by={$order_by}&how={$how}");
        }

        if ($how == 'asc') {
            $how = 'desc';
        } else {
            $how = 'asc';
        }
        $sorts = ['id' => $how, 'title' => $how, 'jobs_cont' => $how, 'sort' => $how];
        return view('admin.category.index', ['searched' => $searched, 'categories' => $categories,
            'sorts' => $sorts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'unique:App\Models\Category,title'],
            'sort' => ['required', 'numeric'],
            'image' => ['required', 'image'],
        ]);
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
        $request->file('image')->storeAs('public/categories_images', $imageName);
        Session::flash('message', 'Category Added');
        return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.update', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $categoryInformation = [
            'title' => $request->input('title'),
            'sort' => $request->input('sort'),
        ];

        $validationArray = [
            'sort' => ['required', 'numeric'],
        ];

        if ($request->input('title') != $category->title) {
            $validationArray['title'] = ['required', 'string', 'unique:App\Models\Category,title'];
         }

        if ($request->input('image')) {
            $validationArray['image'] = ['required', 'image'];
            $random = Str::random(60);
            $imageName = $random . '.' . $request->file('image')->extension();
            $categoryInformation['image'] = $imageName;
        }

        $request->validate($validationArray);
        $category->fill($categoryInformation);
        $category->save();
        Session::flash('message', 'Categoey Updated');
        return redirect('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete('/public/categories_images/' . $category->image);
        $category->delete();
        Session::flash('message', 'Categoey Deleted');
        return redirect('admin/category');
    }
}
