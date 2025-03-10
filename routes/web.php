<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Home\HomeController;
use App\Livewire\Admin\AddAdmins;
use App\Livewire\Admin\AddPost;
use App\Livewire\Admin\AddPostCategory;
use App\Livewire\Admin\AddProduct;
use App\Livewire\Admin\AddUser;
use App\Livewire\Admin\AdminHome;
use App\Livewire\Admin\EditAdmins;
use App\Livewire\Admin\EditPost;
use App\Livewire\Admin\EditProduct;
use App\Livewire\Admin\EditUser;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\PostCategory;
use App\Livewire\Admin\PostCategoryComponent;
use App\Livewire\Admin\ViewAdmins;
use App\Livewire\Admin\ViewCategory;
use App\Livewire\Admin\ViewPosts;
use App\Livewire\Admin\ViewProduct;
use App\Livewire\Admin\ViewUsers;
use App\Livewire\PaymentForm;
use App\Livewire\User\Blog;
use App\Livewire\User\Cart;
use App\Livewire\User\CartPage;
use App\Livewire\User\HomePage;
use App\Livewire\User\OrderPage;
use App\Livewire\User\Shop;
use App\Livewire\User\SinglePost;
use App\Livewire\User\SingleProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });


    Route::get('/', HomePage::class);

    Route::get('/shop', Shop::class);

    Route::get('/blog', Blog::class)->name('blog.page');

    Route::get('/cart', CartPage::class)->name('cart.page');

    Route::get('/orders', OrderPage::class)->name('orders.page');

    Route::get('/stripe/{total}', PaymentForm::class);

    Route::get('/product/{productId}', SingleProduct::class)->name('product.show');

    Route::get('/post/{slug}', SinglePost::class)->name('post.show');








    /*
    |--------------------------------------------------------------------------
    | Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['admin'])->group(function () {

        ##------------------------------------------------------- ADMIN INDEX PAGE
        Route::get('/', AdminHome::class)->name('index');

        Route::get('/categories', ViewCategory::class)->name('view.category');

        Route::get("/view_product", ViewProduct::class)->name('view.product');

        Route::get("/add_product", AddProduct::class)->name('add.product');

        Route::get("/edit_product/{productId}", EditProduct::class)->name('edit.product');

        Route::get("/post_categories", AddPostCategory::class)->name('post.category');

        Route::get("/posts", ViewPosts::class)->name('view.posts');

        Route::get("/add_post", AddPost::class)->name('add.posts');

        Route::get("/edit_post/{postId}", EditPost::class)->name('edit.post');

        Route::get('/users', ViewUsers::class)->name('users');

        Route::get('/add_user', AddUser::class)->name('add-user');

        Route::get('/edit_user/{userId}', EditUser::class)->name('edit.user');

        Route::get('/admins', ViewAdmins::class)->name('users');

        Route::get('/add_admin', AddAdmins::class)->name('add-admin');

        Route::get('/edit_admin/{adminId}', EditAdmins::class)->name('edit.admin');

        Route::get('/orders', Orders::class)->name('orders');

        Route::get('/notification/markAsRead', function(){
            Auth::guard('admin')->user()->notifications->markAsRead();
        })->name('notifications.read');

        Route::get('/notification/clear', function(){
            Auth::guard('admin')->user()->notifications()->delete();
        })->name('notifications.clear');


    });

    require __DIR__ . '/adminAuth.php';
});



