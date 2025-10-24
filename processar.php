<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $evento = [
        "nome" => htmlspecialchars($_POST["nome"]),
        "tipo" => htmlspecialchars($_POST["tipo"]),
        "data" => htmlspecialchars($_POST["data"]),
        "horario" => htmlspecialchars($_POST["horario"]),
        "duracao" => htmlspecialchars($_POST["duracao"])
    ];

    $arquivo = "eventos.json";
    $eventos = [];

    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        $eventos = json_decode($conteudo, true) ?? [];
    }

    $eventos[] = $evento;
    file_put_contents($arquivo, json_encode($eventos, JSON_PRETTY_PRINT));

    header("Location: agenda.php");
    exit;
}
?>
