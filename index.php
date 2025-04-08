<?php
$filmes = file_exists('filmes.json') ? json_decode(file_get_contents('filmes.json'), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
              <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Filmes</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
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
            <a href="#" class="botao btn btn-dark mt-3">Ver catálogo</a>
          </div>
          <div class="search-box">
            <label class="search-label mb-2">Procure o filme desejado</label>
            <div class="input-group">
              <input type="text" class="form-control form-control-lg search-input" placeholder="Buscar filmes...">
              <button class="btn btn-dark search-btn" type="button">Procurar</button>
            </div>
          </div>
        </div>
      </header>


      <div class="container py-5">
    <h2 class="display-4">Filmes</h2>
    <p class="lead">Ultimos filmes adicionados.</p>

    <?php if (count($filmes) > 0): ?>
      <div id="carouselFilmes" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($filmes as $index => $filme): ?>
            <a href="detalhes.php?id=<?php echo$index; ?>">
            <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
            <div class="d-flex justify-content-center">
              <div class="card-filme p-4">
                <img src="uploads/<?php echo $filme['poster']; ?>" alt="<?php echo $filme['nome']; ?>">
                <div class="info">
                  <h3><?php echo $filme['nome']; ?></h3>
                  <p><strong>Produtora:</strong> <?php echo $filme['produtora']; ?></p>
                  <?php 
                      $resumo = substr($filme['sinopse'], 0, 10); 
                      echo nl2br($resumo) . '...';
                    ?>
                  </p><p><strong>Sinopse:</strong> <?php echo nl2br($resumo); ?>
                  
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
      <p>Nenhum filme cadastrado ainda.</p>
    <?php endif; ?>

    <div class="mt-4">
      <a href="adicionar_filme.php" class="btn botao">Adicionar Filme</a>
    </div>
  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>