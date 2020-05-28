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

    public function updatePage($id) {
        $todo = Auth::user()->todos()->where('id', $id)->first();
        if (!$todo) {
            return redirect('/todo');
        }

        return view('todo_edit', [
           'todo' => $todo
        ]);
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

    public function delete($id) {
        ToDo::find($id)->delete();
        return redirect('/todo');
    }

    public function update(Request $request, $id) {
        $todo = Auth::user()->todos()->where('id', $id)->first();
        if(!$todo) {
            return redirect('/todo');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'due_date' => ['date'],
        ]);

        $todo->update($data);
        return redirect('/todo');
    }
}
