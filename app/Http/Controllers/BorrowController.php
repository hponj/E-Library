<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{

    public function index(){
        $title = 'Borrow';
        $borrows = Borrow::latest()->paginate(10);
        return view('dashboard.borrow.index', compact('title','borrows'));
    }


    public function store(Request $request){
        // return dd($request->all());  

        $borrow_date = Carbon::today();
        $due_date = $borrow_date->copy()->addDays(7);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrowed_at' => $borrow_date,
            'due_date' => $due_date,
            'status' => 'borrowed'
        ]);

        $book = Book::find($request->book_id);
        $book -> status = 1;
        $book -> save();

        return redirect('/');
    }

    public function edit(Borrow $borrow){
        $title = 'Edit Borrow';
        $test = 'test';

        return view('dashboard.borrow.edit', compact('title', 'test', 'borrow'));
    }

    public function update(Request $request, Borrow $borrow){
        $borrow->status = $request->status;
        $borrow->save();
        $book = Book::find($borrow->book->id);

        if($request->status == 'panding' || $request->status == 'borrowed'){
            $book->status = 1;
            $book->save();
        } elseif($request->status == 'returned' || $request->status == 'rejected'){
            $book->status = 0;
            $book->save();
        }

        return redirect('/dashboard/borrow')->with('success', 'Status peminjaman berhasil diperbarui');
    }

    public function destroy(Borrow $borrow){
        Borrow::destroy($borrow->id);
        return redirect('/dashboard/borrow')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
