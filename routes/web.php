<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TyperTitleController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\SectionSettingController;
use App\Http\Controllers\Admin\PortfolioSectionSettingController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('portfolio-detail/{id}', [HomeController::class, 'showPortfolio'])->name('show.portfolio');

// Admin Router
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function() {

    //Hero
    Route::resource('hero', HeroController::class);
    Route::resource('typer-title', TyperTitleController::class);

    // Service Route
    Route::resource('service', ServiceController::class);

    /** About Route */
    Route::get('resume/download', [AboutController::class, 'resumeDownload'])->name('resume.download');
    Route::resource('about', AboutController::class);

    /** Category Route */
    Route::resource('category', CategoryController::class);

    /** Portfolio Item Route */
    Route::resource('portfolio-item', PortfolioItemController::class);

    Route::resource('section-setting', PortfolioSectionSettingController::class);
});