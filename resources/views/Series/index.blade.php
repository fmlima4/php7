    @extends('layout')

    @section('header')
        Séries
    @endsection


    @section('content')
    @include('mensagem', ['mensagem' => $mensagem])

        <a href="{{ route('criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a> 

        <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            Salvar
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    <button class="btn btn-warning btn-sm" style="height: 40px;" onclick="toggleInput({{ $serie->id }})">
                        Editar
                    </button>
                    <a href="/series/{{ $serie->id }}/temporadas" style="height: 40px;" class="btn btn-success btn-sm">
                        Visualizar                   
                    </a>
                    <form method="post" action="/series/remove/{{ $serie->id }}"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-" style="height: 40px;">
                            Deletar
                        </button>
                    </form>
                </span>
            </li>
        @endforeach
        </ul>
    @endsection

    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieId) {
            let formData = new FormData();
            
            const nome = document
                .querySelector(`#input-nome-serie-${serieId} > input`)
                .value;
            const token = document
                .querySelector(`input[name="_token"]`)
                .value;
            formData.append('nome', nome);
            formData.append('_token', token);

            const url = `/series/${serieId}/editaNome`;
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;
            });
        }
    </script> 