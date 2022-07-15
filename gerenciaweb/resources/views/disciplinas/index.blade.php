@extends('templates.main', ['titulo' => "Disciplinas", 'rota' => "disciplinas.create"])

@section('titulo') Disciplinas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistDisciplinas
                :header="['ID', 'NOME', 'CURSO', 'OPÇÕES']" 
                :data="$dados"
                :hide="[false, true, true, true]" 
            />
        </div>
    </div>
@endsection