<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['text' => 'Categorías de productos'];
        $categories = Category::all();
        return view('category.index', compact('breadcrumbs', 'categories'));
    }

    public function create()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['link' => route('category'), 'text' => 'Categorías de productos'];
        $breadcrumbs[] = ['text' => 'Registrar categoría'];
        $category = new Category;
        return view('category.create', compact('breadcrumbs', 'category'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:50'
        ]);

        Category::create([
            'name' => request('name')
        ]);

        return redirect()->route('category');
    }

    public function edit(Category $category)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['link' => route('category'), 'text' => 'Categorías de productos'];
        $breadcrumbs[] = ['text' => 'Editar categoría'];
        return view('category.edit', compact('breadcrumbs', 'category'));
    }

    public function update(Category $category)
    {
        request()->validate([
            'name' => 'required|max:50',
        ]);

        $category->update([
            'name' => request('name'),
        ]);

        return redirect()->route('category');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category');
    }
}
