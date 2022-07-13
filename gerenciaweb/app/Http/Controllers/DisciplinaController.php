<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller {
    
    public function index() {

        $dados = Disciplina::all();
        $dadosCurso = Curso::all();
        return view('disciplina.index', compact(['dados', 'dadosCurso']));
    }

    public function create() {

        return view('disciplina.create');
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|min:10|max:100',
            'curso' => 'required',
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
            'curso' => $request->curso,
            'carga' => $request->carga,
        ]);

        return redirect()->route('disciplina.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Disciplina::find($id);

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('disciplina.edit', compact('dados'));
    }

    public function update (Request $request, $id) {

        $obj = Disciplina::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'nome' => 'required|min:10|max:100',
            'curso' => 'required',
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
            'curso' => $request->curso,
            'carga' => $request->carga,
        ]);

        $obj->save();

        return redirect()->route('disciplina.index');
    }

    public function destroy($id) {

        Disciplina::destroy($id);

        return redirect()->route('disciplina.index');
    } 
}
