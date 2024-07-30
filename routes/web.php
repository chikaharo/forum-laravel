<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'categories' => Category::with(['forums', 'forums.topics'])->get(),
        'forumCount' => count(Forum::all()),
        'topicCount' => count(Topic::all()),
        'memeberCount' => count(User::all()),
        'newestMember' => User::latest()->first(),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class, [
        'index' => 'categories.index',
        'create' => 'categories.create',
        'edit' => 'categories.edit'
    ]);
    Route::get('/forum/{forum:slug}/new-topic', [TopicController::class, 'create'])->name('topic.create');
    Route::post('/topics', [TopicController::class, 'store'])->name('topic.store');
    Route::resource('posts', PostController::class, [
        'store' => 'posts.store',
        'edit' => 'posts.edit',
        'update' => 'posts.update'
    ]);
    
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/categories', [AdminController::class, 'categoriesIndex'])->name('admin.categories');

    Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name("admin.users");
    Route::get('/admin/user/{user}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
    Route::put('/admin/user/{user}', [AdminController::class, 'usersUpdate'])->name("admin.users.update");

    Route::get('/admin/forums', [AdminController::class, 'forumsIndex'])->name("admin.forums");
    Route::get('/admin/forum/{forum}/edit', [AdminController::class, 'forumsEdit'])->name("admin.forums.edit");
    Route::put('/admin/forum/{forum}', [AdminController::class, 'forumsUpdate'])->name("admin.forums.update");




    // Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    
});

Route::get('/forum/{forum:slug}', [ForumController::class, 'show'])->name('forum.show');
Route::get('/topic/{topic:slug}', [TopicController::class, 'show'])->name('topic.show');

// Route::resource('forum', ForumController::class)->middleware('auth');

Route::resource('orders', OrderController::class);


require __DIR__.'/auth.php';
