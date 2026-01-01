<?php
session_start();


$usuario_mestre = "didi";
$senha_mestre = "271188"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['usuario'];
    $pass = $_POST['senha'];

    if ($user === $usuario_mestre && $pass === $senha_mestre) {
        $_SESSION['logado'] = true;
        header("Location: painel.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - Didi Pratas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #360d34ff 0%, #940439ff 100%);
        }

        .container {
            width: 100%;
            max-width: 380px;
            padding: 20px;
            text-align: center;
            color: white;
        }

        
        .user-icon {
            font-size: 50px;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 50%;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            background: rgba(255,255,255,0.1);
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 18px;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 50px; /* Espaço para o ícone */
            border: none;
            border-radius: 8px; 
            background: #e0e0e0;
            font-size: 16px;
            outline: none;
            display: block;
        }

        button {
            width: 100%;
            background-color: #ff2d55; 
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: 0.3s;
        }

        button:hover {
            background-color: #e61b45;
            transform: scale(1.02);
        }

        .msg-erro {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="user-icon"><i class="fas fa-user"></i></div>

        <h2>Acesso Restrito</h2>
        
        <?php if (isset($erro)): ?>
            <p class="msg-erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="usuario" placeholder="Usuário" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha" placeholder="Sua Senha" required>
            </div>

            <button type="submit">LOGIN</button>
        </form>
    </div>

</body>
</html>