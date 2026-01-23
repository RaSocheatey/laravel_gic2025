
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Keep this
use App\Http\Controllers\TP6Controller; // <--- ADD THIS LINE
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryController::class)->prefix('categories')->group(function() {
    Route::get('/', 'getCategories');
    Route::post('/', 'createCategory');
    Route::get('/{categoryId}', 'getCategory');
    Route::patch('/{categoryId}', 'updateCategory');
    Route::delete('/{categoryId}', 'deleteCategory');
}); 


Route::controller(ProductController::class)->prefix('products')->group(function() {
    Route::get('/', 'getProducts');
    Route::post('/', 'createProduct');
    Route::get('/{productId}', 'getProduct');
    Route::patch('/{productId}', 'updateProduct');
    Route::delete('/{productId}', 'deleteProduct');
});

// Route for products by category
Route::get('/categories/{categoryId}/products', [ProductController::class, 'getByCategory']);

// Task 3.1: Create author and user account
Route::post('/authors', [TP6Controller::class, 'createAuthor']);
Route::post('/audiences', [TP6Controller::class, 'createAudience']);
Route::post('/articles', [TP6Controller::class, 'createArticle']);
Route::post('/comments', [TP6Controller::class, 'addComment']);
