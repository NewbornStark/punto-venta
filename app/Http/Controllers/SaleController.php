<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['text' => 'Ventas'];
        return view('sale.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['link' => route('dashboard'), 'text' => 'Dashboard'];
        $breadcrumbs[] = ['text' => 'Generar venta'];
        return view('sale.create', compact('breadcrumbs'));
    }
}
