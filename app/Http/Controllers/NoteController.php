<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function dashboard() {
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return view('dashboard', ['notes' => $notes]);
    }

    public function store(Request $request) {
        $dados = $request->validate([
            'title' => ['required', 'max:160'],
            'content' => ['required'],
            'color' => ['required', 'max:20'],
        ],[
            'title.required' => 'O campo título é obrigatório!',
            'title.max' => 'O campo título não pode conter mais que 160 caracteres!',
            'content.required' => 'O campo conteúdo é obrigatório!',
            'color.required' => 'O campo cor é obrigatório!',
            'color.max' => 'O campo cor não pode conter mais que 20 caracteres!',
        ]);

        $dados['user_id'] = Auth::user()->id;

        Note::create($dados);

        return back()->with('success', 'Anotação criada com sucesso!');
    }
}
