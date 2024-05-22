<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <title>Support System - Página não encontrada</title>
</head>

<body>
  <header class="header">
    <nav class="nav-menu navbar navbar-light bg-light px-4 d-flex justify-content-between">
      <a href="/chamados">
        <h1 class="navbar-brand" href="#">Support System</h1>
      </a>

      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/chamados">Chamados</a>
        </li>
        @if (Auth::check() && Auth::user()->user_type === 'Cliente')
        <li class="nav-item">
          <a class="nav-link" href="/chamados/criar">Criar</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Sair</a>
        </li>
      </ul>
    </nav>
  </header>

  <section class="notFound container">
    <h1 class="title">Página Não Encontrada</h1>
    <br>
    <p class="notFound__error">4<span>0</span>4</p>

    <p class="notFound__text">A página que você tentou acessar não foi encontrada. Talvez nosso menu no topo possa ajudar a encontrar o que procura!</p>
  </section>

  <footer class="footer bg-dark py-3 px-4">
    <p class="text-light text-center m-0">
      Support System - Todos os direitos reservados
    </p>
  </footer>
</body>

</html>