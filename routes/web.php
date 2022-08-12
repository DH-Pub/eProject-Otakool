<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OtakoolController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;


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

// FRONT END
// Route::get('/', function () {
//     return view('fe.app.');
// });

Route::controller(OtakoolController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('product/{id}/details', 'details')->name('details');
    Route::get('product/{productType}/list', 'productShow')->name('productShow');
    Route::get('product/promotions', 'promotion')->name('promotion');

    Route::get('/product', 'searchProduct')->name('search');
});

// customer page -----------------------------------------------------
Route::prefix('customer')->controller(CustomerController::class)->group(function () {
    Route::get('/register', 'register')->name('customer.register'); // register form
    Route::post('/postRegister', 'postRegister')->name('customer.postRegister');

    Route::get('/login', 'login')->name('customer.login'); //login form
    Route::post('/loggedIn', 'loggedIn')->name('customer.loggedIn'); // logged in

    //require authentication
    Route::middleware('customer')->group(function () {
        Route::get('/account', 'CustomerAccount')->name('customer.account');

        Route::get('/edit/account/{id}', 'CustomerEditAccount')->name('customer.edit.account');
        Route::post('/update/account/{id}', 'CustomerUpdateAccount')->name('customer.update.account');

        Route::get('/change/password', 'CustomerChangePassword')->name('customer.change.password');
        Route::post('/update/password', 'CustomerUpdatePassword')->name('customer.update.password');

        Route::get('/logout', 'CustomerLogout')->name('customer.logout');

        Route::get('/my/orders', 'MyOrders')->name('my.orders');
    });
});

// my cart -----------------------------------------------------
Route::controller(CartController::class)->group(function () {
    Route::post('/cart/{pId}/add', 'addToCart')->name('addToCart');
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/cart/{id}/remove', 'itemRemove')->name('cart.item.remove');

    //require authentication
    Route::middleware('customer')->group(function () {
        Route::get('/checkout/{id}', 'Checkout')->name('checkout');
        Route::post('/chekout/{id}/complete', 'CheckoutComplete')->name('checkout.complete');
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/comment/{id}', 'commentPost')->name('comment');
    Route::get('/comment/{id}/delete', 'commentDelete')->name('commentDelete');
    Route::post('/comment/{id}/edit', 'commentEdit')->name('comment.edit');
});

Route::controller(FeedbackController::class)->group(function () {
    Route::post('/postFeedback', 'postFeedback')->name('customer.postFeedback');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/postContact', 'postContact')->name('customer.postContact');
});

Route::controller(QAController::class)->group(function () {
    Route::get('/qa', 'qa')->name('qa');
});

Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'news')->name('news');
    Route::get('/category/news/{id}', 'categoryNews')->name('category.news');
    Route::get('/news/details/{id}', 'detailsNewsPage')->name('news.details');
});

// BACK END #############################################################
// login
Route::prefix('admin')->controller(AdminController::class)->group(function () {
    Route::get('/login', 'login')->name('admin.login'); // login form
    Route::post('/loggedIn', 'loggedIn')->name('admin.loggedIn'); // logged in
});
// required login
Route::middleware('admin')->group(function () {
    Route::get('be/', [BackEndController::class, 'index'])->name('be');

    // admin -----------------------------------------------
    Route::prefix('admin')->controller(AdminController::class)->group(function () {
        Route::get('/register', 'register')->name('admin.register');
        Route::post('/postRegister', 'postRegister')->name('admin.postRegister');
        Route::get('/delete/{id}', 'delete')->name('admin.delete');

        Route::get('/index', 'index')->name('admin.index');

        Route::get('/logout', 'logout')->name('admin.logout');
        Route::get('/profile/{id}', 'profile')->name('admin.profile');
        Route::get('/edit/profile/{id}', 'editProfile')->name('edit.profile');
        Route::post('/update/profile/{id}', 'updateProfile')->name('update.profile');
        Route::get('/change/password', 'changePassword')->name('change.password');
        Route::post('/update/password', 'updatePassword')->name('update.password');
    });

    // customer ----------------------------------------------------
    Route::prefix('be/customer')->controller(CustomerController::class)->group(function () {
        Route::get('/index', 'index')->name('customer.index');
        Route::get('/delete/{id}', 'delete')->name('customer.delete');
        Route::get('/profile/{id}', 'profile')->name('customer.profile');

        Route::get('/edit/profile/{id}', 'editProfile')->name('edit.customer.profile');
        Route::post('/update/profile/{id}', 'updateProfile')->name('update.customer.profile');
    });

    // product ----------------------------------------------------
    Route::controller(ProductController::class)->prefix('be/product')->group(function () {
        Route::get('/', 'product')->name('be.product');
        Route::get('/create', 'create')->name('be.product.create');
        Route::post('/postCreate', 'postCreate')->name('be.product.postCreate');
        Route::get('{id}/details', 'details')->name('be.product.details');
        Route::get('/{id}/update', 'update')->name('be.product.update');
        Route::post('/{id}/postUpdate', 'postUpdate')->name('be.product.postUpdate');
        Route::get('/{id}/delete', 'delete')->name('be.product.delete');

        Route::get('/hidden', 'hidden')->name('be.product.hidden');
    });

    // comment -----------------------------------------------------
    Route::controller(CommentController::class)->prefix('be/comment')->group(function () {
        Route::get('/', 'comment')->name('be.comment');
        Route::get('/{id}/delete', 'delete')->name('be.comment.delete');
    });

    // feedback -------------------------------------------------
    Route::controller(FeedbackController::class)->prefix('be/feedback')->group(function () {
        Route::get('/', 'feedback')->name('be.feedback');
        Route::get('/approval/{id}', 'ApprovalFeedback')->name('approval.feedback');
    });

    // contact -------------------------------------------------
    Route::controller(ContactController::class)->prefix('be/contact')->group(function () {
        Route::get('/', 'index')->name('be.contact');
    });

    // Q&A -------------------------------------------------
    Route::controller(QAController::class)->prefix('be/qa')->group(function () {
        Route::get('/', 'index')->name('be.qa');
        Route::get('/create', 'createQA')->name('be.qa.create');
        Route::post('/postCreate', 'postQA')->name('be.qa.postQA');
        Route::get('/details/{id}', 'detailsQA')->name('be.details.qa');
        Route::get('/edit/{id}', 'editQA')->name('be.edit.qa');
        Route::post('/update/{id}', 'updateQA')->name('be.update.qa');
        Route::get('/delete/{id}', 'delete')->name('be.qa.delete');
    });

    // News Category -------------------------------------------------
    Route::controller(NewsCategoryController::class)->prefix('be/news/category')->group(function () {
        Route::get('/', 'index')->name('be.news.category');
        Route::get('/create', 'createNewsCategory')->name('be.news.category.create');
        Route::get('/details/{id}', 'detailsNewsCategory')->name('be.details.news.category');
        Route::post('/postCreate', 'postNewsCategory')->name('be.postNewsCategory');
        Route::get('/edit/{id}', 'editNewsCategory')->name('be.edit.news.category');
        Route::post('/update/{id}', 'updateNewsCategory')->name('be.update.news.category');
        Route::get('/delete/{id}', 'deleteNewsCategory')->name('be.news.category.delete');
    });

    // News -------------------------------------------------
    Route::controller(NewsController::class)->prefix('be/news')->group(function () {
        Route::get('/', 'index')->name('be.news');
        Route::get('/create', 'createNews')->name('be.news.create');
        Route::get('/details/{id}', 'detailsNews')->name('be.details.news');
        Route::post('/postCreate', 'postNews')->name('be.postNews');
        Route::get('/edit/{id}', 'editNews')->name('be.edit.news');
        Route::post('/update/{id}', 'updateNews')->name('be.update.news');
        Route::get('/delete/{id}', 'deleteNews')->name('be.delete.news');
    });

    // order  -------------------------------------------
    Route::controller(OrderController::class)->prefix('be/order')->group(function () {
        Route::get('/', 'order')->name('be.order');
        Route::get('/{id}/details', 'details')->name('be.order.details');
        Route::get('/{id}/edit', 'edit')->name('be.order.edit');
        Route::post('/{id}/edit/post', 'editPost')->name('be.order.editPost');
        Route::get('/{id}/cancel', 'cancel')->name('be.order.cancel');
        Route::get('/canceled', 'canceled')->name('be.order.canceled');
        Route::get('/income', 'income')->name('be.order.income');

        Route::get('/print/invoice/{id}', 'PrintInvoice')->name('be.order.print.invoice');
    });

    // Promotion ---------------------------------------
    Route::controller(PromotionController::class)->prefix('be/promotion')->group(function () {
        Route::get('/', 'promotion')->name('be.promotion');
        Route::get('/create', 'create')->name('be.promotion.create');
        Route::post('/createPost', 'createPost')->name('be.promotion.createPost');
        Route::get('/{id}/details', 'details')->name('be.promotion.details');
        Route::get('/{id}/edit', 'edit')->name('be.promotion.edit');
        Route::post('/{id}/editPost', 'editPost')->name('be.promotion.editPost');
        Route::get('/{id}/delete', 'delete')->name('be.promotion.delete');
    });
});



require __DIR__ . '/auth.php';
