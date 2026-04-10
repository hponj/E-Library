<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Book";
        $books = Book::latest()->paginate(9);

        return view('dashboard.book.index', compact('title', 'books'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Book";

        $categories = Category::all();
        $authors = Author::all();
        return view('dashboard.book.create', compact('title', 'categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:books',
            'cover' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'body' => 'required',
            'published_at' => 'date',
            'category_id' => 'required',
            'author_id' => 'required',
        ]);

        // return dd($request->all());

        if ($request->file('cover')){
            $validation['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Book::create($validation);
        return redirect('/dashboard/book')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
            
            $categories = Category::all();
            $authors = Author::all();

        $title = 'Edit Book';
        return view('dashboard.book.edit', compact('title', 'book', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:books',
            'cover' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'body' => 'required',
            'published_at' => 'date',
            'category_id' => 'required',
            'author_id' => 'required',
        ];

        if ($request->slug != $book->slug){
            $rules['slug'] = 'required|unique:books';
        }

        $validation = $request->validate($rules);

        if ($request->hasFile('cover')){
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
            $validation['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Book::where('id', $book->id)->update($validation);
        return redirect('/dashboard/book')->with('success', 'Book updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->destroy($book->id);
        return redirect('/dashboard/book')->with('success', 'Book deleted successfully.');
    }
}
