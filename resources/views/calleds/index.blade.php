<x-layout title="Chamados">
  
  
  <ul class="list-group">
    @foreach ($calleds as $called)
    <li class="list-group-item">{{ $called }}</li>
    @endforeach
  </ul>
</x-layout>