@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])

@section('titulo') Professores @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistProfessor
                :header="['NOME', 'EIXO', 'STATUS', 'OPÇÕES']" 
                :data="$dados"
                :hide="[true, false, true, true]" 
            />
        </div>
    </div>
@endsection