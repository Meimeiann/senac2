<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $tipo = htmlspecialchars($_POST["tipo"]);
    $data = htmlspecialchars($_POST["data"]);
    $horario = htmlspecialchars($_POST["horario"]);
    $duracao = htmlspecialchars($_POST["duracao"]);

    $evento = [
        "nome" => $nome,
        "tipo" => $tipo,
        "data" => $data,
        "horario" => $horario,
        "duracao" => $duracao
    ];

    // Caminho do arquivo JSON
    $arquivo = "eventos.json";

    // Se o arquivo já existir, lê e adiciona o novo evento
    if (file_exists($arquivo)) {
        $dados = json_decode(file_get_contents($arquivo), true);
    } else {
        $dados = [];
    }

    $dados[] = $evento;
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));

    // Redireciona para a página da agenda
    header("Location: agenda.php");
    exit;
}
?>
