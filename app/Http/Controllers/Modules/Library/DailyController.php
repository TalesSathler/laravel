<?php

namespace App\Http\Controllers\Modules\Library;

use App\Http\Requests\Modules\Library\DailyRequest;
use App\Http\Controllers\Controller;
use App\Modules\Library\Book;
use App\Modules\Library\Daily;
use Illuminate\Support\Facades\DB;

class DailyController extends Controller
{
    public function index()
    {
        $dailies = Daily::orderBy('dailies.daily_id', 'desc')->paginate(10);
        return view('Modules.Library.Daily.index',
            [
                'dailies' => $dailies
            ]
        );
    }

    public function create(DailyRequest $request)
    {
        $data = $request->all();
        if($data){
            DB::beginTransaction();
            try{
                Daily::create($data);
            }catch (\Exception $ex){
                return redirect()->route('library-daily-edit')->withError($ex->getMessage());
            }
            DB::commit();
            return redirect()->route('library-daily-index')->withSuccess('Daily created with success!');
        }

        $books = Book::all();

        return view('Modules.Library.Daily.edit', [
            'books' => $books
        ]);
    }

    public function edit(DailyRequest $request)
    {
        $data = $request->all();
        if(!$data || !isset($data['daily_id']) || !$daily = Daily::find($data['daily_id'])){
            return redirect()->route('library-daily-index')->withInfo('Daily not found!');
        }

        if($request->isMethod('post') && $data){
            DB::beginTransaction();
            try{
                $daily->fill($data);
                $daily->save();
            }catch (\Exception $ex){
                return redirect()->route('library-daily-edit')->withError($ex->getMessage());
            }
            DB::commit();
            return redirect()->route('library-daily-index')->withSuccess('Daily edited with success!');
        }

        $books = Book::all();

        return view('Modules.Library.Daily.edit', [
            'daily' => $daily,
            'books' => $books
        ]);
    }

    public function delete(DailyRequest $request)
    {
        $data = $request->all();
        if($data && isset($data['daily_id']) && Daily::find($data['daily_id'])){
            DB::beginTransaction();

            try{
                Daily::destroy($data['daily_id']);
            }catch (\Exception $ex){
                return redirect()->route('library-daily-index')->withError($ex->getMessage());
            }

            DB::commit();
            return redirect()->route('library-daily-index')->withSuccess('Daily deleted with success!');
        }
        return redirect()->route('library-daily-index')->withInfo('Daily not found!');
    }
}
