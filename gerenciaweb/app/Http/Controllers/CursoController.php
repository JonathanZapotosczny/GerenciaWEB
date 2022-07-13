<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;

class CursoController extends Controller {

    public function index() {

        $dados[0] = Curso::all();
        $dados[1] = Eixo::all();
        return view('cursos.index', compact(['dados']));
    }

    public function create() {
        
        $eixo = Eixo::all();
        return view('cursos.create', compact('eixo'));
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|min:10|max:50',
            'sigla' => 'required|min:2|max:8',
            'tempo' => 'required|min:1|max:2',
            'id_eixo' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        Curso::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF-8'),
            'tempo' => $request->tempo,
            'id_eixo' => $request->id_eixo,
        ]);

        return redirect()->route('cursos.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Curso::find($id);

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('cursos.edit', compact('dados'));
    }

    public function update (Request $request, $id) {

        $obj = Curso::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'nome' => 'required|min:10|max:50',
            'sigla' => 'required|min:2|max:8',
            'tempo' => 'required|min:1|max:2',
            'id_eixo' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF-8'),
            'tempo' => $request->tempo,
            'id_eixo' => $request->id_eixo,
        ]);

        $obj->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id) {

        Curso::destroy($id);

        return redirect()->route('cursos.index');
    } 
}
