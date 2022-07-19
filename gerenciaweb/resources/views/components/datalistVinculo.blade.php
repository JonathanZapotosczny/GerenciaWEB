<div>
    
    <table class="table align-middle caption-top table-striped">
        <caption>Tabela de <b>Vínculos</b></caption>
        <thead>
        <tr>
            @php $cont=0; @endphp
            @foreach ($header as $item)

                @if($hide[$cont])
                    <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                @else
                    <th scope="col">{{ $item }}</th>
                @endif
                @php $cont++; @endphp

            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach ($data[0] as $item)
                <tr>
                    @foreach ($data[2] as $dis)
                        @if($dis['id'] == $item['id_disciplina'])
                        <td class="d-none d-md-table-cell">{{ $dis['nome'] }}</td>
                    @endif
                    @endforeach

                    @foreach ($data[1] as $prof)
                        @if($prof['id'] == $item['id_professor'])
                        <td class="d-none d-md-table-cell">{{ $prof['nome'] }}</td>
                    @endif
                    @endforeach

                    <td>
                        <a href= "{{ route('vinculos.edit', $item['id']) }}" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                            </svg>
                        </a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

</div>