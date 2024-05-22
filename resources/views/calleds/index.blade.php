<!-- view com a listagem de chamados  -->
<x-layout title="Chamados">

  <form action="/chamados" method="GET" class="form-search">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Buscar chamados por id ou título..." name="search" value="{{ request('search') }}">
      <button class="btn btn-outline-secondary" type="submit" name="action" value="search">Buscar</button>
      <button class="btn btn-secondary" type="submit" name="action" value="clear">Limpar Busca</button>
    </div>
  </form>

  @isset($messageSuccess)
  <div class="alert alert-success">
    {{ $messageSuccess }}
  </div>
  @endisset

  <ul class="list-group list-called">
    @if (count($calleds ?? []) > 0)
    @foreach ($calleds as $called)
    <li class="list-group-item" data-id="{{ $called->id }}">
      <div class="info">
        <span class="id">#{{ $called->id }}</span>
        {{ $called->title }}
      </div>
      <span class="status text-white @if($called->status === 'Aberto') bg-success @elseif($called->status === 'Em atendimento') bg-warning @elseif($called->status === 'Finalizado') bg-secondary @endif">{{ $called->status }}</span>
    </li>
    @endforeach
    @else
    <div class="alert alert-info" role="alert">
      Não há chamados cadastrados no momento.
    </div>
    @endif
  </ul>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const items = document.querySelectorAll('.list-group-item');
      items.forEach(item => {
        item.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          window.location.href = `/chamados/${id}`;
        });
      });
    });
  </script>
</x-layout>