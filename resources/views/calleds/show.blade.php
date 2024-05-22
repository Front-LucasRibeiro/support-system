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
  <div class="response">
    <form action="/chamados/salvar" method="post" class="form-create" enctype="multipart/form-data">
      @csrf

      <div class="mb-3 mt-2">
        <textarea type="text" id="message" name="message" class="form-control" placeholder="Mensagem..." required></textarea>
      </div>

      <div class="mb-5 actions">
        <div>
          <label for="attachments" class="form-label">Anexos:</label>
          <input type="file" id="attachments" name="attachments[]" class="form-control" multiple />
        </div>

        <div class="btn-actions">
          <button type="submit" class="btn btn-dark">Finalizar</button>
          <button type="submit" class="btn btn-dark">Enviar</button>
        </div>
      </div>
    </form>
  </div>
</x-layout>