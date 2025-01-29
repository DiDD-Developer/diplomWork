<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Вывод шаблона для работы администратора с созданными категориями
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function CategoryView()
    {
        $categories = Category::all();
        return view('Admins.categories.add_category', compact('categories'));
    }

    /**
     * Создание новой категории
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AddCategoryPost(CategoryRequest $request)
    {
        $categoryName = $request['name'];
        Category::create($request->validated());

        return redirect()->route('CategoryView')->with(['categoryName'=>$categoryName]);
    }

    /**
     * Изменение названия созданной категории
     * @param EditCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateCategoryPost(EditCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $validatedName = $validated['name'];
        $OldCategoryName = $category->name;

        $category->name = $validated['name'];

        $category->save();

        return redirect()->route('CategoryView')->with(['OldCategoryName'=>$OldCategoryName, 'validatedName'=>$validatedName]);
    }

    /**
     * Удаление созданной категории
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteCategoryPost(Category $category)
    {
        $DeleteCategoryName = $category->name;

        $category->delete();

        return redirect()->route('CategoryView')->with(['DeleteCategoryName'=>$DeleteCategoryName]);
    }
}
