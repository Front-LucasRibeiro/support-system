<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <title>{{ $title }}</title>
</head>

<body>
  <header class="header">
    <nav class="nav-menu navbar navbar-light bg-light px-4 d-flex justify-content-between">
      <h1 class="navbar-brand" href="#">Support System</h1>

      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/chamados">Chamados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/chamados/criar">Criar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Sair</a>
        </li>
      </ul>
    </nav>
  </header>



  <div class="container mt-5 content">
    <h2 class="mb-4">{{ $title }}</h2>

    {{ $slot }}
  </div>

  <footer class="footer bg-dark py-3 px-4">
    <p class="text-light text-center m-0">
      Support System - Todos os direitos reservados
    </p>
  </footer>
</body>

</html>