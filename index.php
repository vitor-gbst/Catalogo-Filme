<?php
session_start();
$logado = isset($_SESSION['usuario']);

$filmesOriginais = file_exists('filmes.json') ? json_decode(file_get_contents('filmes.json'), true) : [];
$filmes = [];

if (isset($_GET['busca']) && !empty(trim($_GET['busca']))) {
    $termoBusca = mb_strtolower(trim($_GET['busca']));
    foreach ($filmesOriginais as $index => $filme) {
        if (mb_strpos(mb_strtolower($filme['nome']), $termoBusca) !== false) {
            $filmes[$index] = $filme;
        }
    }
} else {
    $filmes = $filmesOriginais;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MovieCatalog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
            <li class="nav-item">
              <?php if ($logado): ?>
                <a class="nav-link" href="logout.php">Sair</a>
              <?php else: ?>
                <a class="nav-link" href="login.php">Login</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
  </nav>

  <header class="hero-section">
    <div class="overlay"></div>
    <div class="hero-content">
      <div class="hero-text">
        <h1 class="display-4">Descubra filmes incríveis</h1>
        <p class="lead">Explore os melhores títulos em um só lugar.</p>
        <a href="#filmes" class="botao btn btn-dark mt-3">Ver catálogo</a>
      </div>
      <div class="search-box">
        <label class="search-label mb-2">Procure o filme desejado</label>
        <div class="input-group">
        <form method="GET" class="input-group">
          <input type="text" name="busca" class="form-control form-control-lg search-input" placeholder="Buscar filmes..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
          <button class="btn btn-dark search-btn" type="submit">Procurar</button>
        </form>
        </div>
      </div>
    </div>
  </header>

  <div style="background-color: #1e1e1e; padding: 30px; margin-top: 50px;" class="container py-5 catalago-filmes" id="filmes">
    <h2 class="display-4">Filmes</h2>
    <p class="lead">Filmes adicionados ao catálogo.</p>

    <?php if (count($filmes) > 0): ?>
      <div id="carouselFilmes" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($filmes as $index => $filme): ?>
            <a href="detalhes.php?id=<?php echo $index; ?>">
              <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
                <div class="d-flex justify-content-center">
                  <div class="card-filme p-4">
                    <img src="uploads/<?php echo $filme['poster']; ?>" alt="<?php echo $filme['nome']; ?>">
                    <div class="info">
                      <h3><?php echo $filme['nome']; ?></h3>
                      <p>Produtora: <?php echo $filme['produtora']; ?></p>
                      <p>Sinopse: 
                        <?php 
                          $resumo = substr($filme['sinopse'], 0, 10); 
                          echo nl2br($resumo);
                        ?>
                        <a style="color: #d97821;" href="detalhes.php?id=<?php echo $index; ?>" class="mostrar-mais">Mostrar mais..</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFilmes" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselFilmes" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    <?php else: ?>  
      <?php if (empty($filmes)): ?>
        <p>Nenhum filme encontrado com esse nome.</p>
      <?php else: ?>
        <p>Nenhum filme cadastrado ainda.</p>
      <?php endif; ?>
    <?php endif; ?>

    <div class="mt-4">
      <?php if ($logado): ?>
        <a href="adicionar_filme.php" class="btn botao">Adicionar Filme</a>
      <?php else: ?>
        <p class="text-light">Faça login para adicionar filmes.</p>
      <?php endif; ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
