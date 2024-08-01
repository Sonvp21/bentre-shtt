<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ScienceInformationController;
use App\Http\Controllers\Web\SearchController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/thong-tin-khoa-hoc', [ScienceInformationController::class, 'index'])->name('science-information.index');
Route::get('/thong-tin-khoa-hoc/{scienceInformation:slug}', [ScienceInformationController::class, 'show'])->name('science-information.show');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/hoi-dap', [FaqController::class, 'index'])->name('faqs.index');
Route::post('/hoi-dap', [FaqController::class, 'store'])->name('faqs.store');

// Route::get('/gioi-thieu', fn () => view('web.about'))->name('about');

Route::get('/categories/{category:slug}/posts', [CategoryController::class, 'showAllPosts'])->name('categories.posts.index');
Route::get('/categories/{category:slug}/posts/{post:slug}', [CategoryController::class, 'showPost'])->name('categories.posts.show');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

Route::get('/locale/{lang}', [LocalizationController::class, 'setLocale']);

require __DIR__.'/admin.php';
