<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Filme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="p-5">

  <div class="container">
    <h2 class="mb-4">Cadastrar Novo Filme</h2>
    <form action="processa_filme.php" method="POST" enctype="multipart/form-data" class="row g-3">

      <div class="col-md-6">
        <label class="form-label">Nome do Filme</label>
        <input type="text" name="nome" class="form-control search-input" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Produtora</label>
        <input type="text" name="produtora" class="form-control search-input" required>
      </div>

      <div class="col-12">
        <label class="form-label">Sinopse</label>
        <textarea name="sinopse" class="form-control search-input" rows="3" required></textarea>
      </div>

      <div class="col-12">
        <label class="form-label">Pôster (imagem)</label>
        <input type="file" name="poster" accept="image/*" class="form-control search-input" required>
      </div>

      <div class="col-12">
        <button type="submit" class="btn botao">Salvar Filme</button>
        <a href="index.php" class="btn btn-secondary ms-2">Voltar</a>
      </div>

    </form>
  </div>


</body>
</html>
