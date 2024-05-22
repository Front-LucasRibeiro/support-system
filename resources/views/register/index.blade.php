<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <title>Support System - Cadastro</title>
</head>

<body>
  <div class="overlay">
    <form method="post" class="form-login">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Nome completo:</label>
        <input type="text" id="name" name="name" class="form-control"  required/>
      </div>

      <div class="mb-3">
        <label for="cpf" class="form-label">CPF:</label>
        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" class="form-control" required />
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input type="text" id="email" name="email" class="form-control" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Senha:</label>
        <input type="password" id="password" name="password" class="form-control" required/>
      </div>

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="list-erros">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <button class="btn btn-dark">Cadastrar</button>
    </form>
  </div>

</body>

</html>