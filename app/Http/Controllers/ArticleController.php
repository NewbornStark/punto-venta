<?php

namespace App\Http\Controllers;

use App\Article;
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
        return view('articles.create', compact('breadcrumbs', 'article'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:100',
            'sku' => 'required|max:50',
            'price' => 'required|numeric',
        ]);

        Article::create([
            'name' => request('name'),
            'sku' => request('sku'),
            'price' => request('price')
        ]);

        return redirect()->route('articles');
    }

    public function edit(Article $article)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['link' => route('articles'), 'text' => 'Articulos'];
        $breadcrumbs[] = ['text' => 'Editar articulo'];
        return view('articles.edit', compact('breadcrumbs', 'article'));
    }

    public function update(Article $article)
    {
        request()->validate([
            'name' => 'required|max:100',
            'sku' => 'required|max:50',
            'price' => 'required|numeric',
        ]);

        $article->update([
            'name' => request('name'),
            'sku' => request('sku'),
            'price' => request('price')
        ]);

        return redirect()->route('articles');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles');
    }
}
