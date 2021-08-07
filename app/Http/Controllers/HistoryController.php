<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index (){
        $histories = History::orderByDesc('id')->select('id','full_name', 'updated_at')->paginate(8);
        return view('history', compact('histories'));
    }

    public function store(Request $request){
        if ($request->name) {
            History::updateOrCreate(
                ['full_name' => $request->name],
                [
                   'full_name' => $request->name
                ]
            );
        }
    }
}
