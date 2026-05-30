<?php

use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Article;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// Sitemap
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    $sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    $sitemap->add(Url::create('/projects')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    $sitemap->add(Url::create('/gallery')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    $sitemap->add(Url::create('/articles')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

    Project::all()->each(function (Project $project) use ($sitemap) {
        $sitemap->add(Url::create("/projects/{$project->id}")
            ->setPriority(0.7)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setLastModificationDate($project->updated_at));
        if ($project->file_3d_path) {
            $sitemap->add(Url::create("/projects/{$project->id}/3d-tour")
                ->setPriority(0.4)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        }
    });

    Article::all()->each(function (Article $article) use ($sitemap) {
        $sitemap->add(Url::create("/articles/{$article->id}")
            ->setPriority(0.6)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setLastModificationDate($article->updated_at));
    });

    return $sitemap->render();
});

// Public routes
Route::get('/', [CompanyProfileController::class, 'index']);
Route::get('/gallery', [CompanyProfileController::class, 'allGallery'])->name('public.gallery');
Route::get('/projects', [CompanyProfileController::class, 'allProjects'])->name('public.projects');
Route::get('/projects/{project}', [CompanyProfileController::class, 'projectDetail'])->name('public.projects.detail');
Route::get('/projects/{project}/3d-tour', [CompanyProfileController::class, 'project3DTour'])->name('public.projects.3d');
Route::get('/articles', [CompanyProfileController::class, 'allArticles'])->name('public.articles');
Route::get('/articles/{article}', [CompanyProfileController::class, 'articleDetail'])->name('public.articles.detail');

// Admin Authentication (public)
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);

Route::get('/users/create', [RegisterController::class, 'showRegistrationForm'])->name('users.create');
Route::post('/users', [RegisterController::class, 'register'])->name('users.store');
// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::delete('projects/image/{id}', [ProjectController::class, 'deleteImage'])->name('projects.image.delete');

    // Articles
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);

    // Gallery
    Route::get('/gallery', [SettingController::class, 'gallery'])->name('gallery');
    Route::post('/gallery', [SettingController::class, 'storeGallery'])->name('gallery.store');
    Route::delete('/gallery/{id}', [SettingController::class, 'deleteGallery'])->name('gallery.delete');

    // Settings Group
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/hero', [SettingController::class, 'hero'])->name('hero');
        Route::post('/hero', [SettingController::class, 'updateHero'])->name('hero.update');
        Route::delete('/hero/{id}', [SettingController::class, 'deleteHeroImage'])->name('hero.delete');

        Route::get('/about', [SettingController::class, 'about'])->name('about');
        Route::post('/about', [SettingController::class, 'updateAbout'])->name('about.update');

        Route::get('/contact', [SettingController::class, 'contact'])->name('contact');
        Route::post('/contact', [SettingController::class, 'updateContact'])->name('contact.update');

        Route::get('/maps', [SettingController::class, 'maps'])->name('maps');
        Route::post('/maps', [SettingController::class, 'updateMaps'])->name('maps.update');
    });
});
