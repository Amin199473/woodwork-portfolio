<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category as Cat;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin:admin-api',['except' => ['index']]);
    }
    public function index()
    {
        $categories = Cat::with(["projects","posts"])->latest()->get();
        return response()->json(["categories" => $categories, "success" => "ok"], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Cat();
        $category->parent_id = $request->parent_id;
        $category->parent_name = $request->parent_name;
        $category->name = $request->name;
        $category->model_type = $request->model_type;
        $category->save();

        return response()->json(["status" => "success", 'message' => 'دسته بندی با موفقیت اضافه شد'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Cat $category)
    {
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->parent_name = $request->parent_name;
        $category->model_type = $request->model_type;
        $category->save();

        return response()->json(["message" => "ویرایش با موفقیت انجام شد"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $category)
    {
        $category->delete();
        return response()->json(["message" => "حذف با موفقیت انجام شد"], 200);

    }
}
