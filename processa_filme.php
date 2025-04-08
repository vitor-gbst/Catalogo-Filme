<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $produtora = $_POST['produtora'];
    $sinopse = $_POST['sinopse'];

    $arquivoPoster = $_FILES['poster'];

    if ($arquivoPoster['error'] === 0) {
        $nomePoster = uniqid() . "_" . basename($arquivoPoster['name']);
        $caminhoPoster = "uploads/" . $nomePoster;

        if (move_uploaded_file($arquivoPoster['tmp_name'], $caminhoPoster)) {
            $novoFilme = [
                "nome" => $nome,
                "produtora" => $produtora,
                "sinopse" => $sinopse,
                "poster" => $nomePoster
            ];

            $caminhoJSON = 'filmes.json';
            $dadosAtuais = file_exists($caminhoJSON) ? json_decode(file_get_contents($caminhoJSON), true) : [];
            $dadosAtuais[] = $novoFilme;

            file_put_contents($caminhoJSON, json_encode($dadosAtuais, JSON_PRETTY_PRINT));

            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Erro no upload do pôster.";
    }
}
?>
