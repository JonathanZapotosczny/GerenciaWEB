@extends('templates.main', ['titulo' => "Cursos", 'rota' => "cursos.create"])

@section('titulo') Cursos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistCurso
                :header="['ID', 'NOME', 'SIGLA', 'TEMPO', 'EIXO', 'OPÇÕES']" 
                :data="$dados"
                :hide="[false, true, true, false, false, true]" 
            />
        </div>
    </div>
@endsection