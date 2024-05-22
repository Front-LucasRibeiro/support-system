<!-- detalhes do chamado  -->
<x-layout title="Detalhes do Chamado">
  <div class="details">
    <div class="title-called">
      <span class="id">#{{ $called->id }}</span>
      <h3 class="text-secondary">{{ $called->title }}</h3>
    </div>

    <p class="mb-5">{{ $called->description }}</p>
    <p><strong>Status:</strong>
      <span class="status @if($called->status === 'Aberto') text-success @elseif($called->status === 'Em atendimento') text-warning @elseif($called->status === 'Finalizado') text-secondary @endif">{{ $called->status }}</span>
    </p>


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
        @elseif (in_array($extension, ['txt']))
        <li>
          <a href="{{ $url }}" target="_blank" class="btn btn-dark">
            Arquivo
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

  <div class="chat mt-3">
    @if ($called->chat)
    @php
    $chat = json_decode($called->chat, true);
    @endphp
    @if (is_array($chat))
    @foreach ($chat as $message)
    <div class="details mt-3 mb-3">
      @if (isset($message['name']))
      <p class="mb-0">
        <strong>{{ $message['name'] }}:</strong>
      </p>
      @endif

      <p>
        {{ $message['message'] }}
      </p>

      @if (isset($message['attachments']))
      <h4 class="text-secondary attachments">Anexos:</h4>
      <div class="gallery">
        <ul>
          @foreach (json_decode($message['attachments'], true) as $attachment)
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
          @elseif (in_array($extension, ['txt']))
          <li>
            <a href="{{ $url }}" target="_blank" class="btn btn-dark">
              Arquivo
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
      </div>
      @endif
    </div>
    @endforeach
    @endif
    @endif
  </div>

  <div class="response">
    <form action="/chamados/atualizar" method="post" class="form-create" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="called_id" value="{{ $called->id }}">
      <input type="hidden" name="called_finish" id="calledFinish" value="">

      <div class="mb-3 mt-2">
        <textarea type="text" id="message" name="message" class="form-control" placeholder="Mensagem..."></textarea>
      </div>

      <div class="mb-5 actions">
        <div>
          <label for="attachments" class="form-label">Anexos:</label>
          <input type="file" id="attachments" name="attachments[]" class="form-control" multiple />
        </div>

        <div class="btn-actions">
          @if (Auth::check() && Auth::user()->user_type === 'Colaborador')
          <button type="submit" class="btn btn-dark" onclick="setCalledFinish('finish')">Finalizar</button>
          @endif
          <button type="submit" class="btn btn-dark">Enviar</button>
        </div>
      </div>
    </form>

    <script>
      function setCalledFinish(value) {
        document.getElementById('calledFinish').value = value;
      }
    </script>
  </div>
</x-layout>