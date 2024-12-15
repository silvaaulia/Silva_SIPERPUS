<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Support\Facades\Route;


Route::get('/books/search', function () {
    // Ambil query pencarian dari input
    $query = request('query');

    // Cari buku berdasarkan judul, penulis, atau rak buku (code atau name)
    $books = Book::with('bookshelf')
        ->where('title', 'like', "%{$query}%")
        ->orWhere('author', 'like', "%{$query}%")
        ->orWhereHas('bookshelf', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%{$query}%")
                         ->orWhere('code', 'like', "%{$query}%");
        })
        ->get(); // Dapatkan hasil pencarian

    // Persiapkan data hasil pencarian untuk dikirim ke view
    $books_filter = [];
    $no = 1;
    foreach ($books as $book) {
        $books_filter[] = [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'year' => $book->year,
            'publisher' => $book->publisher,
            'city' => $book->city,
            'cover' => asset('storage/cover_buku/' . $book->cover),
            'bookshelf' => $book->bookshelf->code . '-' . $book->bookshelf->name
        ];
    }

    return response()->json($books_filter);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('book');
    Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/books', [BookController::class, 'store'])->name('book.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::match(['put', 'patch'], '/books/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/books/print', [BookController::class, 'print'])->name('book.print');
    Route::get('/books/export', [BookController::class, 'export'])->name('book.export');
    Route::post('/books/import', [BookController::class, 'import'])->name('book.import');
});


require __DIR__ . '/auth.php';
