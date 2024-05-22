<!-- view com a listagem de chamados  -->
<x-layout title="Chamados">

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
      <span class="status text-white bg-success">{{ $called->status }}</span>
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