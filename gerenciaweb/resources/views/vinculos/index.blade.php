@extends('templates.main', ['titulo' => "Vínculos", 'rota' => "vinculos.create"])

@section('titulo') Vínculos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistVinculo
                :header="['DISCIPLINA', 'PROFESSORES', 'OPÇÕES']" 
                :data="$dados"
                :hide="[true, true, true]" 
            />
        </div>
    </div>
@endsection