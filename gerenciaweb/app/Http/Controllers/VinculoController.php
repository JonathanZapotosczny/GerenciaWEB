<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Vinculo;

class VinculoController extends Controller {
    
    public function index() {

        $dados[0] = Vinculo::all();
        $dados[1] = Professor::where('status', '=', true)->get();
        $dados[2] = Disciplina::all();
        return view('vinculos.index', compact('dados'));
    }

    public function create() {
        
        $dados[0] = Vinculo::all();
        $dados[1] = Professor::where('status', '=', 1)->get();
        $dados[2] = Disciplina::all();
        return view('vinculos.create', compact('dados'));
    }

    public function store(Request $request) {

        $profs = $request->profs;

        foreach($profs as $item) {

            $array = explode("_", $item);
            Vinculo::where('id_disciplina', $array[0])->forceDelete();
        }

        foreach($profs as $item) {

            $array = explode("_", $item);
            Vinculo::create([
                'id_disciplina' => $array[0],
                'id_professor' => $array[1],
            ]);
        }

        return redirect()->route('vinculos.index');
    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update (Request $request, $id) {

    }

    public function destroy($id) {

    } 
}