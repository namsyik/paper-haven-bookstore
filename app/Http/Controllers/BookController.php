<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display the home page with featured books
     */
    public function home(): View
    {
        // Get featured books (top rated)
        $featuredBooks = Book::where('stock', '>', 0)
            ->orderBy('rating', 'desc')
            ->take(4)
            ->get();

        // Get books by popular authors
        $jamesClearBooks = Book::where('author', 'LIKE', '%James Clear%')
            ->where('stock', '>', 0)
            ->take(3)
            ->get();

        $napoleonHillBooks = Book::where('author', 'LIKE', '%Napoleon Hill%')
            ->where('stock', '>', 0)
            ->take(3)
            ->get();

        $robertKiyosakiBooks = Book::where('author', 'LIKE', '%Robert Kiyosaki%')
            ->where('stock', '>', 0)
            ->take(3)
            ->get();

        $brianTracyBooks = Book::where('author', 'LIKE', '%Brian Tracy%')
            ->where('stock', '>', 0)
            ->take(3)
            ->get();

        // Get recommended books
        $recommendedBooks = Book::where('stock', '>', 0)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('home', compact(
            'featuredBooks',
            'jamesClearBooks',
            'napoleonHillBooks',
            'robertKiyosakiBooks',
            'brianTracyBooks',
            'recommendedBooks'
        ));
    }

    /**
     * Display a listing of all books (shop page)
     */
    public function index(Request $request): View
    {
        $query = Book::where('stock', '>', 0);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('author', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Sort functionality
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $books = $query->paginate(12);
        
        // Get all categories for filter
        $categories = Book::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('shop', compact('books', 'categories'));
    }

    /**
     * Display the specified book details
     */
    public function show(Book $book): View
    {
        // Get related books (same author or category)
        $relatedBooks = Book::where('id', '!=', $book->id)
            ->where(function($query) use ($book) {
                $query->where('author', $book->author)
                      ->orWhere('category', $book->category);
            })
            ->where('stock', '>', 0)
            ->take(4)
            ->get();

        return view('book-detail', compact('book', 'relatedBooks'));
    }

    /**
     * Display e-books page
     */
    public function ebooks(Request $request): View
    {
        $query = Book::where('stock', '>', 0);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('author', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $books = $query->orderBy('rating', 'desc')->paginate(12);

        return view('ebook', compact('books'));
    }

    /**
     * Display about page
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Search books (AJAX endpoint)
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q', '');
        
        $books = Book::where('stock', '>', 0)
            ->where(function($query) use ($searchTerm) {
                $query->where('title', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('author', 'LIKE', "%{$searchTerm}%");
            })
            ->take(5)
            ->get(['id', 'title', 'author', 'image', 'price']);

        return response()->json($books);
    }
}
