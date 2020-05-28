<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function todo()
    {
        //$todos = Auth::user()->todos;
        $todos = Auth::user()->todos()->orderBy('due_date', 'ASC')->get();
        return view('todo', ['todos'=>$todos]);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'due_date' => ['date'],
        ]);

        $todo = new ToDo();
        $todo->user_id = Auth::user()->id;
        $todo->fill($data);

        $todo->save();

        return redirect('/todo');
    }
}
