<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function dashboard(Request $request) {
        if ($request->search) {
            $notes = Note::where('user_id', Auth::user()->id)
                ->where('title', 'LIKE', '%'.$request->search.'%')
                ->orWhere('content', 'LIKE', '%'.$request->search.'%')
                ->paginate(1);
        } else {
            $notes = Note::where('user_id', Auth::user()->id)->paginate(1);
        }

        return view('dashboard', ['notes' => $notes]);
    }

    private function rule($request) {
        return $request->validate([
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
    }

    public function store(Request $request) {
        $dados = $this->rule($request);
        $dados['user_id'] = Auth::user()->id;
        Note::create($dados);
        return back()->with('success', 'Anotação criada com sucesso!');
    }

    public function update(Request $request) {
        $dados = $this->rule($request);
        $dados['user_id'] = Auth::user()->id;
        Note::find($request->id)->update($dados);
        return back()->with('success', 'Anotação editada com sucesso!');
    }

    public function delete(Request $request) {
        Note::find($request->id)->delete();
        return back()->with('success', 'Anotação excluída com sucesso!');
    }

    public function uploadFile(Request $request) {
        $request->validate([
            'note_id' => 'required',
            'file' => ['required', 'file', 'max:4096'],
        ]);

        $file = $request->file->store('files');

        File::create([
            'note_id' => $request->note_id,
            'directory' => $file
        ]);

        return back();
    }

    public function deleteFile(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        if (Storage::exists($request->directory))
            Storage::delete($request->directory); // Exclusão de arquivo

        File::find($request->id)->delete();

        return back();
    }
}
