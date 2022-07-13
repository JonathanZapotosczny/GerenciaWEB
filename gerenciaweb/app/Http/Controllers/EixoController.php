<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;

class EixoController extends Controller {

    public function index() {

        $dados = Eixo::all();
        return view('eixos.index', compact('dados'));
    }

    public function create() {

        return view('eixos.create');
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|min:10|max:50',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        Eixo::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            
        ]);

        return redirect()->route('eixos.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Eixo::find($id);

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('eixos.edit', compact('dados'));
    }

    public function update (Request $request, $id) {

        $obj = Eixo::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $regras = [
            'nome' => 'required|min:10|max:50',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        ]);

        $obj->save();

        return redirect()->route('eixos.index');
    }

    public function destroy($id) {

        Eixo::destroy($id);

        return redirect()->route('eixos.index');
    }
}
