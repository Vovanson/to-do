<?php

namespace App\Http\Controllers;

use App\Task;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get Categories & Tasks
     *
     * @return array
     */
    public function getAll()
    {
        $categories = Category::all();

        foreach ($categories as $category) {

            $category['tasks'] = Task::where('category_id', $category['id'])->get();
        }

        return $categories;
    }

    /**
     * Add New Category
     *
     * @param  Request $request
     * @return string
     */
    public function addCategory(Request $request)
    {
        $count = Category::where('name', $request->name)->count();

        if (!$count) {
            $category = new Category;
            $category->name = $request->name;
            $category->save();

            return 'OK';

        } else {

            return 'Error';
        }
    }
}
