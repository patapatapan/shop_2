<?php

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::namespace ('App\Http\Controllers')->group(function () {
    Route::get('/', 'SiteController@index');
    Route::get('/shop', 'SiteController@shop');
    Route::get('/about', 'SiteController@about');
    Route::get('/newproducts', 'SiteController@product');
    Route::get('/productintro', 'SiteController@intro');
    Route::get('/contact', 'SiteController@contact');
    Route::get('/items/{item}', 'SiteController@details');
    Route::get('/about', 'SiteController@about');
    Route::get('/blog', 'SiteController@blog');
    Route::get('/blog1', 'SiteController@blog_details');
    Route::get('/login', 'SiteController@login');
    Route::get('/cart', 'SiteController@cart');
    Route::get('/elements', 'SiteController@elements');
    Route::get('/confirmations', 'SiteController@confirmations');
    Route::get('/checkout', 'SiteController@checkout');

});

Route::get('picArray', function () {
    $item = Item::find(1);
    dd($item->picArray);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('getlocale', function () {
    App::getLocale('zh_TW');
    return App::getLocale();
});

Route::get('getpwd', function () {
    App::setLocale('zh_TW');
    return __('Your password has been reset!');
});

Route::view('texting', 'test');

Route::get('additem', function () {
    $item = item::find(16);
    \Cart::session(1)->add([
        'id' => 16,
        'name' => $item->title,
        'price' => $item->price_new,
        'quantity' => 1,
        'arrtibutes' => [],
        'associatedModel' => $item,
    ]);
    return '已加入購物車';
});

Route::get('updateitem', function () {
    $item = item::find(13);
    if (!\Cart::session(1)->isEmpty()) {
        \Cart::session(1)->update(1, [
            'quantity' => -3,
            'arrtibutes' => [],
            'associatedModel' => $item,
        ]);
        return '已更新購物車';
    } else {
        return '購物車為空';
    }

});

Route::get('removeitem', function () {
    $item = item::find(13);
    \Cart::session(1)->remove(16);
    return '已移除商品';
});

Route::get('getcart', function () {
    $items = \Cart::session(1)->getContent();
    dd($items);
});

Route::get('gettotalquantity', function () {
    $cartTotalQuantity = \Cart::session(1)->getTotalQuantity();
    dd($cartTotalQuantity);
// 確認某⽤⼾的購物⾞商品總數
    /*$cartTotalQuantity = \Cart::session($userId)
->getTotalQuantity();*/

});

Route::get('/storesession', function (Request $request) {
    //session({'name'=>'pata' });
    $request->session()->put('name', 'patapan');
    $request->session()->put('msg', 'it is done');
    $request->session()->put('price', 1000);
    $request->session()->put('data', ['name' => 'ps5', 'price' => 15800]);
    return 'Session 已儲存';
});

Route::get('/deletesession', function (Request $request) {
    //$request->session()->forget('msg'); //刪除單筆資料
    $request->session()->flush(); //刪除所有資料
    return $request->session()->all();
});

Route::get('/flashsession', function (Request $request) {
    //session({'name'=>'pata' });
    ;
    $request->session()->flash('status', '更新成功');
    return 'Session 已儲存';
});

Route::get('/getsession', function (Request $request) {
    //$data = session ('name'.pata);
    //$request->session()->get('name','patapan');
    $data = $request->session()->pull('price'); //pull--取用資料並刪除
    $data = $request->session()->get('status', '謀找到');
    //return $data;
    //$request->session()->reflash(); //保留至下次請求
    return $request->session()->all();
});