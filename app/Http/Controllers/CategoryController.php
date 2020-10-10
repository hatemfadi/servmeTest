<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = Category::where("user_id", $this->getUserId());

        return $this->success($categories->paginate(), 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];
        $this->validate($request, $rules);

        $category = Category::create([
            'name' => $request->get('name'),
            'user_id' => $this->getUserId()
        ]);

        return $this->success($category, 200);
    }

    public function show($category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return $this->error("The category with {$category_id} doesn't exist", 404);
        }
        $category["tasks"] = $category->tasks;

        return $this->success($category, 200);
    }

    public function update(Request $request, $category_id)
    {
        $category = Category::find($category_id);

        if (!$category) {
            return $this->error("The category with {$category_id} doesn't exist", 404);
        }
        $rules = [
            'name' => 'string',
        ];
        $this->validate($request, $rules);

        if ($request->get("name")) {
            $category->name = $request->get("name");
        }
        $category->save();

        return $this->success($category, 200);
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);

        if (!$category) {
            return $this->error("The category with {$category_id} doesn't exist", 404);
        }

        $category->delete();

        return $this->success("The category with with id {$category_id} has been deleted", 200);
    }
}
