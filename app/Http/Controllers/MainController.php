<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Первая страница сайта
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // id категории (get-параметр)
        $categoryId = $request->get('category');

        // Требуется получить страницы с их категориями
        $pages = Page::with('category');

        // Если категория указана - ограничим выборку страниц
        if ($categoryId) {
            $pages = $pages->whereCategoryId($categoryId);
        }

        // Запросим страницы из БД
        $pages = $pages->orderByDesc('datetime_post')
            ->get();

        // Все категории для поля формы с предшествующей опцией для выбора всех новостей
        $categories = Category::all(['id', 'name'])
            ->prepend(['id' => 0, 'name' => '- выберите -'])
            ->pluck('name', 'id');

        return view('index', [
            'pages' => $pages,
            'categories' => $categories,
            'categoryId' => $categoryId
        ]);
    }

    /**
     * Отдельная страница (новость)
     *
     * @param $pageId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function page($pageId)
    {
        // Страница или 404, если такой нет
        $page = Page::findOrFail($pageId);

        return view('page', ['page' => $page]);
    }
}
