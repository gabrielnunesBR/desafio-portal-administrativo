<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro no Servidor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            text-align: left;
            max-width: 600px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .error-container h1 {
            margin: 0;
            font-size: 24px;
            color: #dc3545;
        }
        .error-container pre {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Oops! Algo deu errado</h1>
        <p><strong>Mensagem:</strong> <?= htmlspecialchars($message) ?></p>
        <p><strong>Arquivo:</strong> <?= htmlspecialchars($file) ?></p>
        <p><strong>Linha:</strong> <?= htmlspecialchars($line) ?></p>
        <?php if (!empty($trace)): ?>
            <p><strong>Trace:</strong></p>
            <pre><?= htmlspecialchars($trace) ?></pre>
        <?php endif; ?>
    </div>
</body>
</html>
