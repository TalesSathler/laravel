<?php

namespace App\Http\Controllers\Modules\Library;

use App\Http\Requests\Modules\Library\BookRequest;
use App\Modules\Library\Author;
use App\Modules\Library\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('book_id', 'desc')->paginate(10);

        return view('Modules.Library.Book.index', [
            'books' => $books
        ]);
    }

    public function create(BookRequest $request)
    {
        $data = $request->all();
        if($data){
            DB::beginTransaction();
            try{
                $book = Book::create($data);

                $book->authors()->attach($request['author_id']);
            }catch (\Exception $ex){
                return redirect()->route('library-book-edit')->withError($ex->getMessage());
            }
            DB::commit();
            return redirect()->route('library-book-index')->withSuccess('Book created with success!');
        }

        $authors = Author::all();

        return view('Modules.Library.Book.edit', [
            'authors' => $authors
        ]);
    }

    public function edit(BookRequest $request)
    {
        $data = $request->all();
        if(!$data || !isset($data['book_id']) || !$book = Book::find($data['book_id'])){
            return redirect()->route('library-book-index')->withInfo('Book not found!');
        }

        if($request->isMethod('post') && $data){
            DB::beginTransaction();
            try{
                $book->fill($data);
                $book->save();

                $book->authors()->detach($request['author_id']);
                $book->authors()->attach($request['author_id']);
            }catch (\Exception $ex){
                return redirect()->route('library-book-edit')->withError($ex->getMessage());
            }
            DB::commit();
            return redirect()->route('library-book-index')->withSuccess('Book edited with success!');
        }

        $authors = Author::all();

        return view('Modules.Library.Book.edit', [
            'book' => $book,
            'authors' => $authors
        ]);
    }

    public function delete(BookRequest $request)
    {
        $data = $request->all();
        if($data && isset($data['book_id']) && Book::find($data['book_id'])){
            DB::beginTransaction();

            try{
                Book::destroy($data['book_id']);
            }catch (\Exception $ex){
                return redirect()->route('library-book-index')->withError($ex->getMessage());
            }

            DB::commit();
            return redirect()->route('library-book-index')->withSuccess('Book deleted with success!');
        }
        return redirect()->route('library-book-index')->withInfo('Book not found!');
    }
}
