<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

class ProfessorController extends Controller {

    public function index() {

        $dados = Professor::all();
        $dadosEixo = Eixo::all();
        return view('professores.index', compact(['dados', 'dadosEixo']));
    }

    public function create() {

        return view('professores.index');
    }

    public function store(Request $request) {

        $regras = [
            'ativo' => 'required',
            'nome' => 'required|min:10|max:100',
            'email' => 'required|min:10|max:100',
            'siape' => 'required|min:7|max:7',
            'eixo' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        Professor::create([
            'ativo' => $request->ativo,
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => mb_strtoupper($request->email, 'UTF-8'),
            'siape' => $request->siape,
            'eixo' => mb_strtoupper($request->eixo, 'UTF-8'),
        ]);

        return redirect()->route(professores.index);
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Professor::find($id);

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('Professores.edit', compact('dados'));
    }

    public function update (Request $request, $id) {

        $obj = Professor::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'ativo' => 'required',
            'nome' => 'required|min:10|max:100',
            'email' => 'required|min:10|max:100',
            'siape' => 'required|min:7|max:7',
            'eixo' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj->fill([
            'ativo' => $request->ativo,
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => mb_strtoupper($request->email, 'UTF-8'),
            'siape' => $request->siape,
            'eixo' => mb_strtoupper($request->eixo, 'UTF-8'),
        ]);

        $obj->save();

        return redirect()->route('professores.index');
    }

    public function destroy($id) {

        Professor::destroy($id);

        return redirect()->route('professores.index');
    }
}
