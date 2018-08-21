<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\Category;
use App\Product;
use App\Partner;
use App\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRole(['admin']);

        $serviceQty = Service::count();
        $categoryQty = Category::count();
        $productQty = Product::count();
        $partnerQty = Partner::count();
        $visitQty = Visit::count();

        return view('admin.dashboard', compact('serviceQty', 'categoryQty', 'productQty', 'partnerQty', 'visitQty'));
    }

    public function help()
    {
        $breadcrumbs = [
            ['url' => route('dashboard'), 'title' => 'Dashboard'],
            ['url' => '', 'title' => 'Manual']
        ];

        return view('admin.help', compact('breadcrumbs'));
    }
}


