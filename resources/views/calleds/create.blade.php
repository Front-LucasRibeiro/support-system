<x-layout title="Novo chamado">
  <form action="/chamados/salvar" method="post" class="form-create" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Título:</label>
      <input type="text" id="title" name="title" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Descrição:</label>
      <textarea type="text" id="description" name="description" class="form-control" required></textarea>
    </div>

    <div class="mb-5">
      <label for="attachments" class="form-label">Anexos:</label>
      <input type="file" id="attachments" name="attachments[]" class="form-control" multiple />
    </div>

    <button type="submit" class="btn btn-dark">Criar</button>
  </form>
</x-layout>