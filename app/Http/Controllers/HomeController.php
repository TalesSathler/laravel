<?php

namespace App\Http\Controllers;

use App\Modules\Library\Author;
use App\Modules\Library\Book;
use App\Modules\Library\Daily;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qnt_books = Book::count();
        $qnt_authors = Author::count();
        $qnt_dailies = Daily::count();

        return view('home', [
            'qnt_books' => $qnt_books,
            'qnt_authors' => $qnt_authors,
            'qnt_dailies' => $qnt_dailies,
        ]);
    }
}
