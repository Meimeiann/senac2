<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Evento</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <img src="img/logo.jpg" alt="Logo da Empresa" class="logo">
            <h1>Solicitação de Evento</h1>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <main class="main-container">
        <div class="form-container">
            <h2>Preencha as informações do evento</h2>
            <form action="salvar_evento.php" method="POST" class="evento-form">
                <label for="nome">Nome do Solicitante</label>
                <input type="text" id="nome" name="nome" required>

                <label for="tipo">Tipo de Evento</label>
                <input type="text" id="tipo" name="tipo" required>

                <label for="data">Data do Evento</label>
                <input type="date" id="data" name="data" required>

                <label for="horario">Horário do Evento</label>
                <input type="time" id="horario" name="horario" required>

                <label for="duracao">Tempo de Duração (em horas)</label>
                <input type="number" id="duracao" name="duracao" min="1" required>

                <button type="submit">Salvar Evento</button>
            </form>
        </div>

        <div class="image-container">
            <img src="img/fe.jpg" alt="Imagem da Empresa">
        </div>
    </main>
</body>
</html>
