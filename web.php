<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TestimonialController;

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

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [FrontendController::class, 'contactUs'])->name('contact-us');
Route::post('contact-us-submit', [ContactController::class, 'contactSave'])->name('contact-us.submit');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetails'])->name('blog-details');
Route::get('/calculators/{slug}', [FrontendController::class, 'calculatorFront'])->name('calculator.front');
Route::get('/services', [FrontendController::class, 'services'])->name('services.front');
Route::get('/service/{slug}', [FrontendController::class, 'serviceDetails'])->name('service.front.slug');
Route::post('/subscriber/add', [SubscriberController::class, 'subscriberAdd'])->name('subscriber-add');

Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
    Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');

    // Route::get('/register', [RegisterController::class, 'create'])->name('register');
    // Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
    // Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
    // Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');

    // service module
    Route::get('/service-category', [ServiceController::class, 'categoryIndex'])->name('category');
    Route::get('/service-category/add', [ServiceController::class, 'categoryAdd'])->name('category-add');
    Route::post('/service-category/save', [ServiceController::class, 'categorySave'])->name('category-save');
    Route::get('/service-category/edit/{id}', [ServiceController::class, 'categoryEdit'])->name('category-edit');
    Route::post('/service-category/update/{id}', [ServiceController::class, 'categoryUpdate'])->name('category-update');
    Route::get('/service-category/status/{id}/{status}', [ServiceController::class, 'categoryStatus'])->name('category-status');
    Route::get('/service-category/delete/{id}', [ServiceController::class, 'categoryDelete'])->name('category-delete');

    Route::get('/service', [ServiceController::class, 'index'])->name('service');
    Route::get('/service/add', [ServiceController::class, 'add'])->name('service-add');
    Route::post('/service/save', [ServiceController::class, 'save'])->name('service-save');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service-edit');
    Route::post('/service/update/{id}', [ServiceController::class, 'update'])->name('service-update');
    Route::get('/service/status/{id}/{status}', [ServiceController::class, 'status'])->name('service-status');
    Route::get('/service/delete/{id}', [ServiceController::class, 'delete'])->name('service-delete');

    // blog module
    Route::get('/blog-category', [BlogController::class, 'categoryIndex'])->name('blog-category');
    Route::get('/blog-category/add', [BlogController::class, 'categoryAdd'])->name('blog-category-add');
    Route::post('/blog-category/save', [BlogController::class, 'categorySave'])->name('blog-category-save');
    Route::get('/blog-category/edit/{id}', [BlogController::class, 'categoryEdit'])->name('blog-category-edit');
    Route::post('/blog-category/update/{id}', [BlogController::class, 'categoryUpdate'])->name('blog-category-update');
    Route::get('/blog-category/status/{id}/{status}', [BlogController::class, 'categoryStatus'])->name('blog-category-status');
    Route::get('/blog-category/delete/{id}', [BlogController::class, 'categoryDelete'])->name('blog-category-delete');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog-add', [BlogController::class, 'add'])->name('blog-add');
    Route::post('/blog-save', [BlogController::class, 'save'])->name('blog-save');
    Route::get('/blog-edit/{id}', [BlogController::class, 'edit'])->name('blog-edit');
    Route::post('/blog-update/{id}', [BlogController::class, 'update'])->name('blog-update');
    Route::get('/blog-status/{id}/{status}', [BlogController::class, 'status'])->name('blog-status');
    Route::get('/blog-delete/{id}', [BlogController::class, 'delete'])->name('blog-delete');

    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
    Route::get('/testimonial-add', [TestimonialController::class, 'add'])->name('testimonial-add');
    Route::post('/testimonial-save', [TestimonialController::class, 'save'])->name('testimonial-save');
    Route::get('/testimonial-edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial-edit');
    Route::post('/testimonial-update/{id}', [TestimonialController::class, 'update'])->name('testimonial-update');
    Route::get('/testimonial-status/{id}/{status}', [TestimonialController::class, 'status'])->name('testimonial-status');
    Route::get('/testimonial-delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial-delete');

    // financial calculators
    Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator');
    Route::get('/calculator/add', [CalculatorController::class, 'add'])->name('calculator-add');
    Route::post('/calculator/save', [CalculatorController::class, 'save'])->name('calculator-save');
    Route::get('/calculator/edit/{id}', [CalculatorController::class, 'edit'])->name('calculator-edit');
    Route::post('/calculator/update/{id}', [CalculatorController::class, 'update'])->name('calculator-update');
    Route::get('/calculator/status/{id}/{status}', [CalculatorController::class, 'status'])->name('calculator-status');
    Route::get('/calculator/delete/{id}', [CalculatorController::class, 'delete'])->name('calculator-delete');

    // subscriber module
    Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber');

    // contact inquiry module
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.show');


    // route for website setting
    Route::post('/setting-update', [SettingController::class, 'update'])->name('setting-update');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');

    // route for editor image upload
    Route::post('/editor-image/upload', [EditorController::class, 'editorImage'])->name('editor.image');

    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile-change-password', [UserProfileController::class, 'passwordUpdate'])->name('profile.change.perform');

    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
