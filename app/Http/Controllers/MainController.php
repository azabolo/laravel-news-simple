<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->get('category');

        $pages = Page::with('category');

        if ($categoryId) {
            $pages = $pages->whereCategoryId($categoryId);
        }

        $pages = $pages->orderByDesc('datetime_post')
            ->get();

        $categories = Category::all(['id', 'name'])
            ->prepend(['id' => 0, 'name' => '- выберите -'])
            ->pluck('name', 'id');

        return view('index', [
            'pages' => $pages,
            'categories' => $categories,
            'categoryId' => $categoryId
        ]);
    }

    public function page($pageId)
    {
        $page = Page::findOrFail($pageId);

        return view('page', ['page' => $page]);
    }
}
