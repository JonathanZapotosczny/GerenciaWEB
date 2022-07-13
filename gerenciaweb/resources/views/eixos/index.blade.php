@extends('templates.main', ['titulo' => "Eixos", 'rota' => "eixos.create"])

@section('titulo') Eixos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistEixo
                :header="['ID', 'NOME', 'OPÇÕES']" 
                :data="$dados"
                :hide="[true, true, true]" 
            />
        </div>
    </div>
@endsection