<x-layout title="Novo chamado">
  <form action="" method="post" class="form-create">
    <div class="mb-3">
      <label for="name" class="form-label">Título:</label>
      <input type="text" id="name" name="name" class="form-control">
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Descrição:</label>
      <textarea type="text" id="description" name="description" class="form-control"></textarea>
    </div>

    <div class="mb-5">
      <label for="attachments" class="form-label">Anexos:</label>
      <input type="file" id="attachments" name="attachments" class="form-control" />
    </div>

    <button type="submit" class="btn btn-dark">Criar</button>
  </form>
</x-layout>