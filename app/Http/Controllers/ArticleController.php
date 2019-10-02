<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleCategory;
use App\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['text' => 'Articulos'];
        $articles = Article::all();
        return view('articles.index', compact('breadcrumbs', 'articles'));
    }

    public function create()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['link' => route('articles'), 'text' => 'Articulos'];
        $breadcrumbs[] = ['text' => 'Registrar articulo'];
        $article = new Article;
        $selectedCategories = [];
        $categories = Category::all();
        return view('articles.create', 
            compact('breadcrumbs', 'article', 'categories', 'selectedCategories'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'sku' => 'required|max:50',
            'price' => 'required|numeric',
        ]);

        $article = Article::create([
            'name' => request('name'),
            'description' => request('description'),
            'sku' => request('sku'),
            'price' => request('price')
        ]);

        if (request('categories')) {
            $idArticle = $article->id;
            foreach (request('categories') as $idCategory) {
                $articleCategories = new ArticleCategory();
                $articleCategories->id_article = $idArticle;
                $articleCategories->id_category = $idCategory;
                $articleCategories->save();
            }
        }

        return redirect()->route('articles');
    }

    public function edit(Article $article)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['link' => route('articles'), 'text' => 'Articulos'];
        $breadcrumbs[] = ['text' => 'Editar articulo'];
        $categories = Category::all();
        $selectedCategories = $article->categories()->pluck('id_category')->toArray();
        return view('articles.edit', compact('breadcrumbs', 'article', 'categories', 'selectedCategories'));
    }

    public function update(Article $article)
    {
        request()->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'sku' => 'required|max:50',
            'price' => 'required|numeric',
        ]);

        $article->update([
            'name' => request('name'),
            'description' => request('description'),
            'sku' => request('sku'),
            'price' => request('price')
        ]);

        // Se borran las categorias asociadas
        ArticleCategory::where('id_article', $article->id)->delete();
        // Se revisa si hay categorias seleccionadas y se guardan
        $selectedCategories = request('categories');
        if ($selectedCategories) {
            foreach ($selectedCategories as $idCategory) {
                $data = ['id_article' => $article->id, 'id_category' => $idCategory];
                $articleCategory = new ArticleCategory;
                $articleCategory->fill($data);
                $articleCategory->save();
            }
        }

        return redirect()->route('articles');
    }

    public function destroy(Article $article)
    {
        // Se borran primero las categoria asociadas
        ArticleCategory::where('id_article', $article->id)->delete();
        
        // Se borra el articulo
        $article->delete();

        return redirect()->route('articles');
    }
}
