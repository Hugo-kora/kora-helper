<?php

use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\UserProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CategorySubCategoryController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth:sanctum','acl'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class,'home'])->name('admin.index');

        Route::get('users/{id}/profile/{idProfile}/detach', [UserProfileController::class,'detachUserProfile'])->name('users.profile.detach');
        Route::post('users/{user}/sync-profile', [UserProfileController::class, 'attachUserProfile'])
        ->name('users.syncProfiles');
        Route::post('users/{id}/profiles', [UserProfileController::class,'attachProfilesUser'])->name('users.profiles.attach');
        Route::any('users/{id}/profiles/create', [UserProfileController::class,'profilesAvailable'])->name('users.profiles.available');
        Route::get('users/{id}/profiles', [UserProfileController::class,'users'])->name('users.profiles');

        Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class,'detachPermissionProfile'])->name('profiles.permission.detach');
        Route::post('profiles/{profile}/sync-permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])
            ->name('profiles.syncPermissions');
        Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class,'permissionsAvailable'])->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', [PermissionProfileController::class,'permissions'])->name('profiles.permissions');
        Route::post('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('/profiles', ProfileController::class);

        Route::any('users/search', [UsersController::class, 'search'])->name('users.search');
        Route::resource('users', UsersController::class);

        Route::post('categories/search', [CategoriesController::class,'search'])->name('categories.search');
        Route::resource('categories', CategoriesController::class);

        Route::get('categories/{categoryId}/index', [SubCategoriesController::class, 'index'])->name('categories.subcategories.index');
        Route::get('categories/{categoryId}/subcategories', [SubCategoriesController::class, 'create'])->name('categories.subcategories.create');
        Route::post('categories/{categoryId}/subcategories', [SubCategoriesController::class, 'store'])->name('categories.subcategories.store');
        Route::get('categories/{id}/subcategories', [CategorySubCategoryController::class,'subcategories'])->name('categories.subcategories');

        Route::get('subcategories/{categoryId}', [SubCategoriesController::class, 'index'])->name('subcategories.index');
        Route::get('subcategories/{id}/show', [SubCategoriesController::class, 'show'])->name('subcategories.show');
        Route::get('subcategories/{id}/edit', [SubCategoriesController::class, 'edit'])->name('subcategories.edit');
        Route::put('subcategories/{id}', [SubCategoriesController::class, 'update'])->name('subcategories.update');
        Route::delete('subcategories/{id}', [SubCategoriesController::class, 'destroy'])->name('subcategories.destroy');
        Route::post('subcategories/search', [SubCategoriesController::class,'search'])->name('subcategories.search');

        Route::get('user/change-password', [UsersController::class, 'showChangePasswordForm'])->name('user.password.change');
        Route::put('user/change-password', [UsersController::class, 'changePassword'])->name('user.password.update');

        Route::get('user/change-temporary-password/{user}', [UsersController::class, 'changeTemporaryPassword'])->name('user.passwordTemporary.update');

    });
});

Route::get('/acessos/{categoria}', [CategoriesController::class,'subcategorias'])->name('subcategorias');
Route::get('/', [SiteController::class,'index'])->name('site.home');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
