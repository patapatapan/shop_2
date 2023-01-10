<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Item;

class SiteController extends Controller
{
    public function index()
    {
        $sliders = Element::where('page', 'index')->where('position', 'slider')->orderBy('sort', 'asc')->get();
        $arrivals = Item::where('cgy_id', 2)->where('enabled', true)->orderBy('sort', 'asc')->get();
        $images = Element::where('page', 'index')->where('position', 'images')->orderBy('sort', 'asc')->get();
        $products = Item::where('cgy_id', 1)->where('enabled', true)->orderBy('sort', 'asc')->get();
        $new_product_top = Element::where('page', 'index')->where('position', 'new_product_top')->orderBy('sort', 'asc')->first();
        $reds = Element::where('page', 'index')->where('position', 'row3')->orderBy('sort', 'asc')->get();
        return view('index', compact('sliders', 'arrivals', 'images', 'products', 'new_product_top', 'reds'));

    }

    public function shop()
    {
        $items_new_product = ['PS5', 'Xbox'];
        return view('shop', compact('items_new_product'));
    }
    public function about()
    {
        return view('about');
    }
    public function blog()
    {
        return view('blog');
    }
    public function blog_details()
    {
        return view('blog_details');
    }

    public function contact()
    {
        return view('contact');
    }
    public function details()
    {
        return view('products_details');
    }
    public function login()
    {
        return view('login');
    }
    public function cart()
    {
        return view('cart');
    }
    public function elements()
    {
        return view('elements');
    }
    public function confirmations()
    {
        return view('confirmations');
    }
    public function checkout()
    {
        return view('checkout');
    }
}