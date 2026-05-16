<?php

use App\Http\Controllers\Admin\CarouselSlideController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContentBlockController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController as PublicServiceController;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

/*
|--------------------------------------------------------------------------
| Public marketing site (Bootstrap 5 + Font Awesome)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/services', [PublicServiceController::class, 'index'])->name('services.index');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:8,1')
    ->name('contact.store');

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    $sitemap->add(Url::create(route('home'))->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
    $sitemap->add(Url::create(route('services.index'))->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    $sitemap->add(Url::create(route('gallery.index'))->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    $sitemap->add(Url::create(route('posts.index'))->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
    $sitemap->add(Url::create(route('contact.create'))->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

    Post::published()->get()->each(function ($post) use ($sitemap) {
        $sitemap->add(Url::create(route('posts.show', $post))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    });

    $sitemap->add(Url::create(route('services.index'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

    return response($sitemap->render(), 200)
        ->header('Content-Type', 'application/xml');
})->name('sitemap.index');

/*
|--------------------------------------------------------------------------
| Authenticated staff area (CMS)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');

        Route::resource('content-blocks', ContentBlockController::class)->only(['index', 'edit', 'update']);

        Route::resource('carousel-slides', CarouselSlideController::class)
            ->except(['show'])
            ->parameters(['carousel-slides' => 'carousel_slide']);

        Route::resource('gallery-categories', GalleryCategoryController::class)->except(['show']);
        Route::resource('gallery-images', GalleryImageController::class)->except(['show']);
        Route::resource('posts', AdminPostController::class)->except(['show']);

        Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::get('contact-messages/{contact_message}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
        Route::patch('contact-messages/{contact_message}/unread', [ContactMessageController::class, 'markUnread'])->name('contact-messages.unread');
        Route::delete('contact-messages/{contact_message}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

        Route::resource('social-links', SocialLinkController::class)->except(['show']);

        Route::delete('services/{service}/images/{service_image}', [AdminServiceController::class, 'destroyImage'])
            ->name('services.images.destroy');
        Route::resource('services', AdminServiceController::class)->except(['show']);
    });

require __DIR__.'/auth.php';
