<!-- detalhes do chamado  -->
<x-layout title="Detalhes do Chamado">
  <div class="details">
    <div class="title-called">
      <span class="id">#{{ $called->id }}</span>
      <h3 class="text-secondary">{{ $called->title }}</h3>
    </div>

    <p class="mb-5">{{ $called->description }}</p>
    <p><strong>Status:</strong> {{ $called->status }}</p>

    <h4 class="text-secondary attachments">Anexos:</h4>

    <div class="gallery">
      @if ($called->attachments)
      <ul>
        @foreach (json_decode($called->attachments, true) as $attachment)
        @php
        $url = Storage::url($attachment);
        $extension = pathinfo($attachment, PATHINFO_EXTENSION);
        @endphp

        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
        <li>
          <a href="{{ $url }}" target="_blank">
            <img src="{{ $url }}" alt="Anexo">
          </a>
        </li>
        @elseif (in_array($extension, ['pdf']))
        <li>
          <a href="{{ $url }}" target="_blank">
            <iframe src="{{ $url }}" frameborder="0"></iframe>
          </a>
        </li>
        @endif
        @endforeach
      </ul>
      @else
      <p>Não há anexos.</p>
      @endif
    </div>
  </div>
</x-layout>