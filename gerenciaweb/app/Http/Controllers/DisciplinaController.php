<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller {
    
    public function index() {

        $dados[0] = Disciplina::all();
        $dados[1] = Curso::all();
        return view('disciplinas.index', compact('dados'));
    }

    public function create() {

        $curso = Curso::all();
        return view('disciplinas.create', compact('curso'));
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|min:10|max:100',
            'id_curso' => 'required',
            'carga' => 'required|min:1|max:12',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        Disciplina::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'id_curso' => $request->id_curso,
            'carga' => $request->carga,
        ]);

        return redirect()->route('disciplinas.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Disciplina::find($id);
        $curso = Curso::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('disciplinas.edit', compact('dados', 'curso'));
    }

    public function update (Request $request, $id) {

        $obj = Disciplina::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'nome' => 'required|min:10|max:100',
            'id_curso' => 'required',
            'carga' => 'required|min:1|max:12',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'id_curso' => $request->id_curso,
            'carga' => $request->carga,
        ]);

        $obj->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id) {

        Disciplina::destroy($id);

        return redirect()->route('disciplinas.index');
    } 
}
