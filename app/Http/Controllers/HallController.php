<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class HallController extends Controller
{
    public function index(){
        $title = 'Hall';
        $books = Book::paginate(10);
        return view('hall', compact('title', 'books'));  
        

    }

    public function singleBook(Book $book){
        $title = $book->name;
        return dd($book);
    }

    public function getByCategory(Category $category){
        $books = Book::where('category_id', $category->id)->paginate(10);
        $title = 'Books of category: ' . $category->name;
        return view('hall', compact('title', 'books'));
    }

    public function getByAuthor(Author $author){
        $books = Book::where('author_id', $author->id)->paginate(10);
        $title = 'Books By: ' . $author->name;
        return view('hall', compact('title', 'books'));

        
    }
}
