<?php

namespace App\Http\Controllers;

use App\Article;
use App\PaymentMethod;
use App\Sale;
use App\SaleArticles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['text' => 'Ventas'];
        $sales = Sale::all();
        return view('sale.index', compact('breadcrumbs', 'sales'));
    }

    public function create()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['text' => 'Generar venta'];
        $paymentMethods = PaymentMethod::all()->pluck('name', 'id');
        return view('sale.create', compact('breadcrumbs', 'paymentMethods'));
    }

    public function findArticle()
    {
        $noArticle = request('noArticle');
        if ($noArticle) {
            return Article::select('id', 'name', 'description', 'sku', 'price')
                ->where('sku', 'like', $noArticle.'%')->get();
        }
        return [];
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'discount' => 'required|numeric',
            'payment' => 'required',
            'articles' => 'required|min:1'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors->all()]);
        }
        $sale = Sale::create([
            'discount' => request('discount'),
            'payment_method' => request('payment'),
        ]);

        $articles = request('articles');
        $idSale = $sale->id;
        foreach ($articles as $article) {
            $saleArticle = new SaleArticles();
            $saleArticle->id_sale = $idSale;
            $saleArticle->name = $article['name'];
            $saleArticle->description = $article['description'];
            $saleArticle->price = $article['price'];
            $saleArticle->sku = $article['sku'];
            $saleArticle->amount = $article['quantity'];
            $saleArticle->save();
        }
        return response()->json(['success' => true, 'sale' => $idSale]);
    }

    public function ticket(int $idSale = null)
    {
        $sale = Sale::findOrFail($idSale);
        $articles = $sale->articles;
        return view('sale.ticket', compact('sale','articles'));
    }
}
