<?php
$arquivo = "eventos.json";
$eventos = [];

// Carrega eventos existentes
if (file_exists($arquivo)) {
    $eventos = json_decode(file_get_contents($arquivo), true);
}

// Função para excluir evento
if (isset($_POST["remover"])) {
    $id = $_POST["remover"];
    if (isset($eventos[$id])) {
        unset($eventos[$id]);
        $eventos = array_values($eventos);
        file_put_contents($arquivo, json_encode($eventos, JSON_PRETTY_PRINT));
    }
    header("Location: agenda.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Eventos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(135deg, #e9f0ff 0%, #ffffff 100%);
            font-family: "Poppins", sans-serif;
            color: #333;
        }

        .navbar {
            background: #004aad;
            color: #fff;
            padding: 20px 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .navbar-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            height: 50px;
            width: auto;
        }

        .agenda-wrapper {
            width: 90%;
            max-width: 1100px;
            margin: 60px auto;
            background-color: #ffffff;
            border-radius: 18px;
            padding: 40px 50px 60px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .agenda-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .agenda-header h2 {
            font-size: 2rem;
            color: #004aad;
            font-weight: 600;
        }

        .linha-azul {
            width: 80px;
            height: 4px;
            background-color: #ffd60a;
            border-radius: 2px;
            margin: 10px auto 0;
        }

        /* Cards de eventos */
        .eventos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            justify-content: center;
        }

        .evento-card {
            background-color: #fdfdfd;
            border-radius: 14px;
            padding: 25px;
            border-left: 8px solid #ffd60a;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .evento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .evento-info {
            margin-bottom: 20px;
        }

        .evento-info strong {
            color: #004aad;
            font-size: 1.2rem;
        }

        .evento-info span {
            display: block;
            color: #555;
            margin-top: 6px;
        }

        .evento-detalhes {
            margin-top: 10px;
            background-color: #f3f7ff;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .evento-detalhes span {
            display: block;
            color: #333;
        }

        /* Botões */
        .botoes {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .btn-remover {
            background-color: transparent;
            border: 2px solid #ff4444;
            color: #ff4444;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-remover:hover {
            background-color: #ff4444;
            color: #fff;
        }

        .btn-voltar {
            display: inline-block;
            background-color: #ffd60a;
            color: #004aad;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-voltar:hover {
            background-color: #ffcd00;
            transform: scale(1.03);
        }

        .no-events {
            text-align: center;
            color: #777;
            font-size: 1.1rem;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            .agenda-wrapper {
                padding: 30px 20px;
            }

            .evento-card {
                padding: 20px;
            }
        }
    </style>
    <script>
        function confirmarExclusao() {
            return confirm("Tem certeza que deseja remover esta solicitação?");
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <img src="img/logo.jpg" alt="Logo da Empresa" class="logo">
            <h1>Agenda de Eventos</h1>
        </div>
    </nav>

    <div class="agenda-wrapper">
        <div class="agenda-header">
            <h2>Eventos Agendados</h2>
            <div class="linha-azul"></div>
        </div>

        <?php if (count($eventos) > 0): ?>
            <div class="eventos-grid">
                <?php foreach ($eventos as $id => $evento): ?>
                    <div class="evento-card">
                        <div class="evento-info">
                            <strong><?= htmlspecialchars($evento["tipo"]) ?></strong>
                            <span>Solicitante: <?= htmlspecialchars($evento["nome"]) ?></span>
                        </div>

                        <div class="evento-detalhes">
                            <span>📅 <?= date('d/m/Y', strtotime($evento["data"])) ?></span>
                            <span>🕒 <?= htmlspecialchars($evento["horario"]) ?> (<?= htmlspecialchars($evento["duracao"]) ?>h)</span>
                        </div>

                        <div class="botoes">
                            <form method="POST" onsubmit="return confirmarExclusao()">
                                <input type="hidden" name="remover" value="<?= $id ?>">
                                <button type="submit" class="btn-remover">Excluir</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-events">Nenhum evento agendado ainda.</p>
        <?php endif; ?>

        <div style="text-align:center; margin-top:40px;">
            <a href="index.php" class="btn-voltar">+ Adicionar Novo Evento</a>
        </div>
    </div>
</body>
</html>

