<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\GhtkController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ThemesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Themes\CartController;
use App\Http\Controllers\Themes\IndexController;
use App\Http\Livewire\ShowGHTK;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::middleware(['auth:sanctum', 'verified'])->name('admin.')->prefix('admin/control')->group(function(){
    
    
    
    Route::prefix('form')->name('form.')->group(function(){
        Route::get('/',[FormController::class, 'index'])->name('index');
        Route::get('cart/',[FormController::class,'cartIndex'])->name('cart.index');
        Route::get('bill/{id}',[FormController::class,'printBill'])->name('bill.print');
        Route::get('show-ghtk/{id}',ShowGHTK::class)->name('bill.showGHTK');
        Route::get('check-transfer-ghtk/{id}',[FormController::class,'checkTransferGHTK'])->name('bill.checkTransferGHTK');
        Route::post('check-xfast/{id}',[FormController::class,'checkXfast'])->name('bill.checkXfast');
        Route::post('send-ghtk/{id}',[FormController::class,'sendGHTK'])->name('bill.sendGHTK');

    });

    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    
    
    Route::prefix('themes')->name('themes.')->group(function () {
        Route::get('/',[ThemesController::class, 'index'])->name('index');
        Route::get('contact',[ThemesController::class, 'contact'])->name('contact');
        Route::post('/',[ThemesController::class, 'update'])->name('update');
        Route::post('contact-update',[ThemesController::class, 'contactUpdate'])->name('contactUpdate');
    });

    Route::prefix('footer')->name('footer.')->group(function () {
        Route::get('/',[FooterController::class, 'index'])->name('index');
        Route::post('/',[FooterController::class, 'update'])->name('update');
    });

    Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('/',[BannerController::class, 'index'])->name('index');
        Route::post('/create',[BannerController::class, 'store'])->name('store');
        Route::post('/update/{id}',[BannerController::class, 'update'])->name('update');
        Route::POST('/update/inline',[BannerController::class, 'inline'])->name('inline');
        Route::delete('/delete/{id}',[BannerController::class, 'destroy'])->name('destroy');
        Route::get('ajax-get-banner-by/{id}',[BannerController::class, 'ajax'])->name('ajax');
    });

    Route::prefix('partner')->name('partner.')->group(function () {
        Route::get('/',[PartnerController::class,'index'])->name('index');
        Route::post('/create',[PartnerController::class,'store'])->name('store');
        Route::post('/update/{id}',[PartnerController::class,'update'])->name('update');
        Route::POST('/update/inline',[PartnerController::class,'inline'])->name('inline');
        Route::delete('/delete/{id}',[PartnerController::class, 'destroy'])->name('destroy');
        Route::get('ajax-get-partner-by/{id}',[PartnerController::class,'ajax'])->name('ajax');
    });

    Route::prefix('ghtk-option')->name('ghtk-option.')->group(function (){
        Route::get('/',[GhtkController::class,'index'])->name('index');
        Route::post('/',[GhtkController::class,'update'])->name('update');
    });

    Route::get('/file-manager',[FileManagerController::class, 'index'])->name('filemanager.index');

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/',[CategoriesController::class,'index'])->name('index');
        Route::post('/create',[CategoriesController::class,'store'])->name('store');
        Route::POST('/update/{id}',[CategoriesController::class,'update'])->name('update');
        Route::get('/update/{id}',[CategoriesController::class,'updateParent'])->name('updateParent');
        Route::post('/update-inline',[CategoriesController::class,'inline'])->name('inline');
        Route::delete('/delete/{id}',[CategoriesController::class,'destroy'])->name('destroy');
        Route::get('/ajax/{id}',[CategoriesController::class,'ajaxGetById'])->name('ajax');
        //sort
        Route::get('/sort-categories',[CategoriesController::class,'sortIndex'])->name('sort.index');
        Route::post('/categories-list/sort',[CategoriesController::class,'sortUpdate'])->name('sort.update');
    });

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/',[PostsController::class, 'index'])->name('index');
        Route::get('/create',[PostsController::class, 'create'])->name('create');
        Route::post('/store',[PostsController::class, 'store'])->name('store');
        Route::get('/show/{id}',[PostsController::class, 'show'])->name('show');
        Route::post('/update/{id}',[PostsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}',[PostsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',[ProductsController::class,'index'])->name('index');
        Route::get('/create',[ProductsController::class,'create'])->name('create');
        Route::post('/store',[ProductsController::class,'store'])->name('store');
        Route::get('/show/{id}',[ProductsController::class,'show'])->name('show');
        Route::post('/update/{id}',[ProductsController::class,'update'])->name('update');
        Route::delete('/destroy/{id}',[ProductsController::class,'destroy'])->name('destroy');

        Route::prefix('options')->name('options.')->group(function(){
            Route::get('categories',[ProductsController::class,'optionCategories'])->name('categories');
            Route::post('categories',[ProductsController::class,'optionCategoriesStore'])->name('categories.store');
            Route::delete('categories/destroy/{id}',[ProductsController::class,'optionCategoriesDelete'])->name('categories.destroy');
            Route::get('list',[ProductsController::class,'optionList'])->name('list');
            Route::post('store',[ProductsController::class,'optionStore'])->name('store');
            Route::delete('delete/{id}',[ProductsController::class,'optionDelete'])->name('delete');
        });
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::post('store',[UserController::class,'store'])->name('store');
        Route::post('update/{id}',[UserController::class,'update'])->name('update');
        Route::delete('delete/{id}',[UserController::class,'destroy'])->name('destroy');
    });

    Route::prefix('customer')->name('customer.')->group(function(){
        Route::get('/',[CustomerController::class,'index'])->name('index');
        Route::get('store',[CustomerController::class,'store'])->name('store');
        Route::post('update/{id}',[CustomerController::class,'update'])->name('update');
        Route::post('import',[CustomerController::class,'import'])->name('import');
        Route::get('export',[CustomerController::class,'export'])->name('export');
        Route::delete("delete/{id}",[CustomerController::class,'destroy'])->name('destroy');
    });
});

Route::get('/',[IndexController::class, 'index'])->name('index');
Route::get('/{slug}',[IndexController::class, 'view'])->name('view');
Route::get('/flash-sale')->name('flashSale');
Route::get('/{slug}/{name}',[IndexController::class, 'show'])->name('show');
Route::get('lien-he/cua-ga-bao-song')->name('contact');
Route::post('/form',[IndexController::class,'form'])->name('form');

Route::prefix('gio-hang')->name('cart.')->group(function () {
    Route::get('hoa-don',[CartController::class, 'index'])->name('index');
    Route::post('store/cart',[CartController::class,'store'])->name('storeCart');
    Route::post('add/cart/{id}',[CartController::class,'addCart'])->name('addCart');
    Route::post('buy-now/{id}',[CartController::class,'buyNow'])->name('buyNow');
    Route::get('delete/row',[CartController::class,'deleteRow'])->name('deleteRow');
    Route::get('delete/all',[CartController::class,'deleteAll'])->name('deleteAll');
    Route::post('update/cart/{rowId}',[CartController::class,'updateRow'])->name('updateRow');
});

Route::prefix('ajax')->name('ajax.')->group(function(){
    Route::get('provice',[AjaxController::class,'AjaxGetAllProvince'])->name('AjaxGetAllProvince');
    Route::get('ajax-get-provice-by/{id}',[AjaxController::class,'AjaxGetProvinceId'])->name('AjaxGetProvinceId');
    Route::post('get-district-by/{id}',[AjaxController::class,'AjaxGetDistrictByprovice'])->name('AjaxGetDistrictByprovice');
    Route::post('get-ward-by-province-district',[AjaxController::class,'AjaxGetWardByProvinceDistrict'])->name('AjaxGetWardByProvinceDistrict');
    Route::post('get-street-by-province-district',[AjaxController::class,'AjaxGetStreetByProvinceDistrict'])->name('AjaxGetStreetByProvinceDistrict');
});
Route::get('cli/artisan/clear-cache', function() {
    Artisan::call('optimize');
    return redirect()->route('index')->with('success','Cache clear');
});
Route::get('cli/artisan/migrate', function() {
    Artisan::call('migrate');
    return redirect()->route('index')->with('success','Migrated !');
});
