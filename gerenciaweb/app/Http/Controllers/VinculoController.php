<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Vinculo;

class VinculoController extends Controller {
    
    public function index() {

        $dados[0] = Vinculo::all();
        $dados[1] = Professor::all();
        $dados[2] = Disciplina::all();
        return view('vinculos.index', compact(['dados']));
    }

    public function create() {
        
        $dados[0] = Vinculo::all();
        $dados[1] = Professor::all();
        $dados[2] = Disciplina::all();
        return view('vinculos.create', compact('dados'));
    }

    public function store(Request $request) {

        $regras = [
            'id_professor' => 'required',
            'id_disciplina' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msg);

        Vinculo::create([
            'id_professor' => $request->id_professor,
            'id_disciplina' => $request->id_disciplina,
        ]);

        return redirect()->route('vinculos.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados[0] = Vinculo::find($id);
        $dados[1] = Professor::all();
        $dados[2] = Disciplina::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('vinculos.edit', compact('dados'));
    }

    public function update (Request $request, $id) {

        $obj = Vinculo::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'id_professor' => 'required',
            'id_disciplina' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msg);

        $obj->fill([
            'id_professor' => $request->id_professor,
            'id_disciplina' => $request->id_disciplina,
        ]);

        $obj->save();

        return redirect()->route('vinculos.index');
    }

    public function destroy($id) {

        Vinculo::destroy($id);

        return redirect()->route('vinculos.index');
    } 
}
