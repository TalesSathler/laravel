<?php

namespace App\Http\Controllers\Modules\Library;

use App\Http\Requests\Modules\Library\AuthorRequest;
use App\Modules\Library\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderBy('authors.author_id', 'desc')->paginate(10);
        return view('Modules.Library.Author.index',
            [
                'authors' => $authors
            ]
        );
    }

    public function create(AuthorRequest $request)
    {
        $data = $request->all();
        if($data){
            DB::beginTransaction();
            try{
                Author::create($data);
            }catch (\Exception $ex){
                return redirect()->route('library-author-create')->withError($ex->getMessage());
            }
            DB::commit();
            return redirect()->route('library-author-index')->withSuccess('Author created with success!');
        }
        return view('Modules.Library.Author.edit');
    }

    public function edit(AuthorRequest $request)
    {
        $data = $request->all();
        if(!$data || !isset($data['author_id']) || !$author = Author::find($data['author_id'])){
            return redirect()->route('library-author-index')->withInfo('Author not found!');
        }

        if($request->isMethod('post') && $data){
            DB::beginTransaction();
            try{
                $author->fill($data);
                $author->save();
            }catch (\Exception $ex){
                return redirect()->route('library-author-edit')->withError($ex->getMessage());
            }
            DB::commit();
            return redirect()->route('library-author-index')->withSuccess('Author edited with success!');
        }

        return view('Modules.Library.Author.edit', [
            'author' => $author
        ]);
    }

    public function delete(AuthorRequest $request)
    {
        $data = $request->all();
        if($data && isset($data['author_id']) && $author = Author::find($data['author_id'])){
            if($author->books()->count()){
                return redirect()->route('library-author-index')->withError('You can not delete the author because he owns a book.');
            }

            DB::beginTransaction();

            try{
                Author::destroy($data['author_id']);
            }catch (\Exception $ex){
                return redirect()->route('library-author-index')->withError($ex->getMessage());
            }

            DB::commit();
            return redirect()->route('library-author-index')->withSuccess('Author deleted with success!');
        }
        return redirect()->route('library-author-index')->withInfo('Author not found!');
    }
}
