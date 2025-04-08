<?php
if (!isset($_GET['id'])) {
  echo "Filme não encontrado.";
  exit;
}

$index = $_GET['id'];
$filmes = json_decode(file_get_contents('filmes.json'), true);

if (!isset($filmes[$index])) {
  echo "Filme inválido.";
  exit;
}

$filme = $filmes[$index];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?php echo $filme['nome']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="mt-5">
  <div class="container py-5">
    <a href="index.php" class="btn botao btn-outline-dark mb-4">← Voltar</a>
    <div class="row">
      <div class="col-md-4">
        <img src="uploads/<?php echo $filme['poster']; ?>" class="img-fluid rounded shadow" alt="Poster">
      </div>
      <div class="col-md-8">
        <h1 style="color: #d97821;"><?php echo $filme['nome']; ?></h1>
        <h5 class="text-white">Produtora: <?php echo $filme['produtora']; ?></h5>
        <hr>
        <p class="mt-4 sinopse"><?php echo nl2br($filme['sinopse']); ?></p>
      </div>
    </div>
  </div>
</body>
</html>
