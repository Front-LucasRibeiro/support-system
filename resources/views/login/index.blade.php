<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <title>Support System - Login</title>
</head>

<body>
  <div class="overlay">
    <form method="post" class="form-login">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input type="text" id="email" name="email" class="form-control" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Senha:</label>
        <input type="password" id="password" name="password" class="form-control" required />
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

      <button class="btn btn-dark">Entrar</button>

      <p class="info">
        Não tem cadastro? <br>
        <a href="/cadastrar" class="text-black">Faça aqui o seu cadastro.</a>
      </p>
    </form>
  </div>

</body>

</html>