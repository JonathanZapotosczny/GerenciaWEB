<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

class ProfessorController extends Controller {

    public function index() {

        $dados[0] = Professor::all();
        $dados[1] = Eixo::all();
        return view('professores.index', compact('dados'));
    }

    public function create() {

        $eixo = Eixo::all();
        return view('professores.create', compact('eixo'));
    }

    public function store(Request $request) {

        $regras = [
            'status' => 'required',
            'nome' => 'required|min:10|max:100',
            'email' => 'required|min:15|max:250',
            'siape' => 'required|min:7|max:9',
            'id_eixo' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        Professor::create([
            'status' => $request->status,
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => mb_strtoupper($request->email, 'UTF-8'),
            'siape' => $request->siape,
            'id_eixo' => $request->id_eixo,
        ]);

        return redirect()->route('professores.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Professor::find($id);
        $eixo = Eixo::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('professores.edit', compact('dados', 'eixo'));
    }

    public function update (Request $request, $id) {

        $obj = Professor::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'status' => 'required',
            'nome' => 'required|min:10|max:100',
            'email' => 'required|min:15|max:250',
            'siape' => 'required|min:7|max:9',
            'id_eixo' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj->fill([
            'status' => $request->status,
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => mb_strtoupper($request->email, 'UTF-8'),
            'siape' => $request->siape,
            'id_eixo' => $request->id_eixo,
        ]);

        $obj->save();

        return redirect()->route('professores.index');
    }

    public function destroy($id) {

        Professor::destroy($id);

        return redirect()->route('professores.index');
    }
}
