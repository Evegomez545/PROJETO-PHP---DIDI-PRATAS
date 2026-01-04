<?php
session_start();

include('conexao.php'); 

if (!isset($_SESSION['logado'])) { 
    header("Location: admin.php");
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $tipo = $_POST['tipo'];
    $estilo = $_POST['estilo'];
    $lancamento = $_POST['lancamento'];
    $mais_vendido = $_POST['mais_vendido'];
    $descricao = $_POST['descricao'];

    // Upload da Imagem
    $imagemNome = $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], "img/" . $imagemNome);

   
    $sql = "INSERT INTO produtos (nome, preco, estoque, tipo, estilo, `mais-vendidos`, lançamentos, descricao, imagem) 
            VALUES ('$nome', '$preco', '$quantidade', '$tipo', '$estilo', '$mais_vendido', '$lancamento', '$descricao', '$imagemNome')";
    
    mysqli_query($conn, $sql);
    header("Location: painel.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto | Didi Pratas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif; 
            /* FUNDO ALGODÃO EGÍPCIO */
            background-color: #E8DCCB; 
            margin: 0; 
            padding: 20px; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container { 
            width: 100%;
            max-width: 600px; 
            background: #FAF9F6; 
            padding: 30px; 
            border-radius: 20px; 
            border: 2px solid #D7C4B0;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }

        h2 { 
            text-align: center; 
            color: #5D4037; 
            margin-bottom: 25px;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #8D6E63;
            font-size: 14px;
            font-weight: 600;
            margin-left: 5px;
        }

        input, select, textarea { 
            width: 100%; 
            padding: 12px; 
            margin-bottom: 15px; 
            border: 2px solid #D7C4B0; /* Linhas mais fortes */
            border-radius: 12px; 
            box-sizing: border-box; 
            background: white;
            font-size: 16px;
            outline: none;
            color: #4E342E;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #A69B91;
            box-shadow: 0 0 8px rgba(215, 196, 176, 0.4);
        }

        .flex-row { 
            display: flex; 
            gap: 15px; 
        }

       
        button { 
            width: 100%; 
            padding: 15px; 
            background: #D1155A; 
            color: white; 
            border: none; 
            border-radius: 30px; 
            cursor: pointer; 
            font-weight: bold; 
            font-size: 16px;
            margin-top: 10px;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(209, 21, 90, 0.2);
        }

        button:hover {
            background: #B0124C;
            transform: translateY(-2px);
        }

        .btn-voltar { 
            display: block; 
            text-align: center; 
            margin-top: 20px; 
            color: #A69B91; 
            text-decoration: none; 
            font-size: 14px;
            font-weight: 500;
        }

        
        @media (max-width: 600px) {
            .flex-row { flex-direction: column; gap: 0; }
            .form-container { padding: 20px; border-radius: 15px; }
        }
    </style>
</head>
<body>
    <a href="painel.php" style="position: absolute; top: 20px; left: 20px; text-decoration: none; color: #5D4037; background: white; padding: 10px 18px; border-radius: 30px; border: 2px solid #D7C4B0; font-weight: bold; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); z-index: 1000;">
        <i class="fas fa-arrow-left"></i> VOLTAR
    </a>

<div class="form-container">
    <h2><i class="fas fa-plus-circle"></i> Novo Produto</h2>
    
    <form method="POST" enctype="multipart/form-data">
        <label>Nome da Prata</label>
        <input type="text" name="nome" placeholder="Ex: Tornozeleira Marítima" required>

        <div class="flex-row">
            <div style="flex: 1;">
                <label>Preço (R$)</label>
                <input type="number" step="0.01" name="preco" placeholder="0.00" required>
            </div>
            <div style="flex: 1;">
                <label>Estoque</label>
                <input type="number" name="quantidade" placeholder="Qtd" required>
            </div>
        </div>
        
        <label>Foto da Joia</label>
        <input type="file" name="imagem" accept="image/*" required>

        <label>Categoria</label>
        <select name="tipo" required>
            <option value="">Escolha o Tipo</option>
            <option value="Aneis">Anéis</option>
            <option value="Colares">Colares</option>
            <option value="Pulseiras">Pulseiras</option>
            <option value="Tornozeleiras">Tornozeleiras</option>
            <option value="Brincos">Brincos</option>
        </select>

        <label>Estilo</label>
        <select name="estilo">
            <option value="Nenhum">Nenhum Estilo Especial</option>
            <option value="Religiosos">Religiosos</option>
            <option value="Cristais">Cristais</option>
            <option value="Minimalistas">Minimalistas</option>
            <option value="Pedrarias">Pedrarias</option>
        </select>

        <div class="flex-row">
            <select name="lancamento">
                <option value="nao">Lançamento? Não</option>
                <option value="sim">Lançamento? Sim</option>
            </select>
            <select name="mais_vendido">
                <option value="nao">Mais Vendido? Não</option>
                <option value="sim">Mais Vendido? Sim</option>
            </select>
        </div>

        <label>Descrição Detalhada</label>
        <textarea name="descricao" rows="3" placeholder="Conte os detalhes da peça..."></textarea>

        <button type="submit">SALVAR PRODUTO</button>
        <a href="painel.php" class="btn-voltar"><i class="fas fa-arrow-left"></i> Voltar ao Painel</a>
    </form>
</div>

</body>
</html>