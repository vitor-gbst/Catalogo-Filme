<?php
session_start();

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarios = file_exists('usuarios.json') ? json_decode(file_get_contents('usuarios.json'), true) : [];

    // Cadastro
    if (isset($_POST['cadastro'])) {
        $novoUsuario = trim($_POST['novo_usuario']);
        $novaSenha = trim($_POST['nova_senha']);

        if (!isset($usuarios[$novoUsuario])) {
            $usuarios[$novoUsuario] = password_hash($novaSenha, PASSWORD_DEFAULT);
            file_put_contents('usuarios.json', json_encode($usuarios));
            $_SESSION['usuario'] = $novoUsuario;
            header("Location: index.php");
            exit;
        } else {
            $erro = "Usuário já existe.";
        }
    }

    // Login
    if (isset($_POST['login'])) {
        $usuario = trim($_POST['usuario']);
        $senha = trim($_POST['senha']);

        if (isset($usuarios[$usuario]) && password_verify($senha, $usuarios[$usuario])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit;
        } else {
            $erro = "Usuário ou senha inválidos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - MovieCatalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-white">

<div class="container py-5">
    <h2 class="text-center mb-4">Acesse o MovieCatalog</h2>

    <?php if ($erro): ?>
        <div class="alert alert-danger text-center"><?php echo $erro; ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <!-- Login -->
        <div class="col-md-5">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST">
                    <div class="mb-3">
    <label for="usuario" class="form-label">Usuário</label>
    <input type="text" class="form-control form-control-light bg-light text-dark border border-dark rounded-3" id="usuario" name="usuario" required>
</div>
<div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control form-control-light bg-light text-dark border border-dark rounded-3" id="senha" name="senha" required>
</div>

                        <button type="submit" name="login" class="btn btn-warning w-100">Entrar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cadastro -->
        <div class="col-md-5">
            <div class="card bg-secondary text-white">
                <div class="card-header">Cadastrar-se</div>
                <div class="card-body">
                    <form method="POST">
                    <div class="mb-3">
    <label for="novo_usuario" class="form-label">Novo usuário</label>
    <input type="text" class="form-control form-control-light bg-light text-dark border border-dark rounded-3" id="novo_usuario" name="novo_usuario" required>
</div>
<div class="mb-3">
    <label for="nova_senha" class="form-label">Senha</label>
    <input type="password" class="form-control form-control-light bg-light text-dark border border-dark rounded-3" id="nova_senha" name="nova_senha" required>
</div>

                        <button type="submit" name="cadastro" class="btn btn-warning w-100">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-light">Voltar para o início</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
