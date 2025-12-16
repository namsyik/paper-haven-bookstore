<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [BookController::class, 'home'])->name('home');

// Shop/Books routes
Route::get('/shop', [BookController::class, 'index'])->name('shop');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/search', [BookController::class, 'search'])->name('books.search');

// E-book and About pages
Route::get('/ebook', [BookController::class, 'ebooks'])->name('ebook');
Route::get('/about', [BookController::class, 'about'])->name('about');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

// Wishlist routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{book}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/toggle/{book}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveAllToCart'])->name('wishlist.moveToCart');
Route::delete('/wishlist', [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::get('/wishlist/count', [WishlistController::class, 'getWishlistCount'])->name('wishlist.count');
Route::get('/wishlist/check/{book}', [WishlistController::class, 'checkBook'])->name('wishlist.check');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/{order}/confirmation', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
