<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;
use App\Product;
use App\Partner;
use App\Visit;
use Mail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct()
    {
        Visit::create();
    }

    public function index()
    {
        $services = Service::where('deleted', '=', 'N')->get();
        $categories = Category::where('deleted', '=', 'N')->get();
        $products = Product::where('deleted', '=', 'N')->get();
        $partners = Partner::where('deleted', '=', 'N')->get();

        return view('site.index', compact('services', 'categories', 'products', 'partners'));
    }

    public function postContact(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'bodyMessage' => 'required|between:5,100'
        ]);

        Mail::to('mateusldecastro@gmail.com')->send(new ContactMail($fields));

        return redirect()->route('site');
    }
}
