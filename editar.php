<?php
session_start();

if (!isset($_SESSION['logado'])) { 
    header("Location: admin.php"); 
    exit; 
}

include('conexao.php');

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id");
$produto = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $tipo = $_POST['tipo'];
    $estilo = $_POST['estilo'];
    $lancamento = $_POST['lancamento'];
    $mais_vendido = $_POST['mais_vendido'];
    $descricao = $_POST['descricao'];

    $imagemNome = $produto['imagem']; 
    if ($_FILES['imagem']['name']) {
        $imagemNome = $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], "img/" . $imagemNome);
    }

    $sql = "UPDATE produtos SET 
        nome='$nome', 
        preco='$preco', 
        estoque='$estoque', 
        tipo='$tipo', 
        estilo='$estilo', 
        `mais-vendidos`='$mais_vendido', 
        lançamentos='$lancamento', 
        descricao='$descricao', 
        imagem='$imagemNome' 
        WHERE id=$id";
    
    mysqli_query($conn, $sql);
    header("Location: painel.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Joia | Didi Pratas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif; 
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
            border: 2px solid #D7C4B0; 
            border-radius: 12px; 
            box-sizing: border-box; 
            background: white;
            font-size: 16px;
            outline: none;
            color: #4E342E;
        }

        .flex-row { 
            display: flex; 
            gap: 15px; 
        }

        .foto-preview { 
            width: 100px; 
            height: 100px; 
            object-fit: cover; 
            margin: 10px 0; 
            border: 2px solid #D7C4B0; 
            border-radius: 10px; 
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
        }

      
        @media (max-width: 600px) {
            .flex-row { flex-direction: column; gap: 0; }
            .form-container { padding: 20px; }
        }
    </style>
</head>
<body>
    <a href="painel.php" style="position: absolute; top: 20px; left: 20px; text-decoration: none; color: #5D4037; background: white; padding: 10px 18px; border-radius: 30px; border: 2px solid #D7C4B0; font-weight: bold; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); z-index: 1000;">
        <i class="fas fa-arrow-left"></i> VOLTAR
    </a>

<div class="form-container">
    <h2><i class="fas fa-edit"></i> Editar: <?php echo $produto['nome']; ?></h2>
    
    <form method="POST" enctype="multipart/form-data">
        <label>Nome da Peça</label>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>

        <div class="flex-row">
            <div style="flex: 1;">
                <label>Preço (R$)</label>
                <input type="number" step="0.01" name="preco" value="<?php echo $produto['preco']; ?>" required>
            </div>
            <div style="flex: 1;">
                <label>Estoque</label>
                <input type="number" name="estoque" value="<?php echo $produto['estoque']; ?>" required>
            </div>
        </div>

        <label>Tipo de Peça</label>
        <select name="tipo">
            <option value="anéis" <?php if($produto['tipo'] == 'anéis') echo 'selected'; ?>>Anéis</option>
            <option value="brincos" <?php if($produto['tipo'] == 'brincos') echo 'selected'; ?>>Brincos</option>
            <option value="cordões e colares" <?php if($produto['tipo'] == 'cordões e colares') echo 'selected'; ?>>Cordões e Colares</option>
            <option value="pulseiras" <?php if($produto['tipo'] == 'pulseiras') echo 'selected'; ?>>Pulseiras</option>
            <option value="tornozeleiras" <?php if($produto['tipo'] == 'tornozeleiras') echo 'selected'; ?>>Tornozeleiras</option>
        </select>

        <label>Estilo</label>
        <select name="estilo">
            <option value="Nenhum" <?php if($produto['estilo'] == 'Nenhum') echo 'selected'; ?>>Nenhum</option>
            <option value="Religiosos" <?php if($produto['estilo'] == 'Religiosos') echo 'selected'; ?>>Religiosos</option>
            <option value="Cristais" <?php if($produto['estilo'] == 'Cristais') echo 'selected'; ?>>Cristais</option>
            <option value="Minimalistas" <?php if($produto['estilo'] == 'Minimalistas') echo 'selected'; ?>>Minimalistas</option>
            <option value="Pedrarias" <?php echo ($produto['estilo'] == 'Pedrarias') ? 'selected' : ''; ?>>Pedrarias</option> </select>
        </select>

        <div class="flex-row">
            <div style="flex: 1;">
                <label>Lançamento?</label>
                <select name="lancamento">
                    <option value="nao" <?php if($produto['lançamentos'] == 'nao') echo 'selected'; ?>>Não</option>
                    <option value="sim" <?php if($produto['lançamentos'] == 'sim') echo 'selected'; ?>>Sim</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label>Mais Vendido?</label>
                <select name="mais_vendido">
                    <option value="nao" <?php if($produto['mais-vendidos'] == 'nao') echo 'selected'; ?>>Não</option>
                    <option value="sim" <?php if($produto['mais-vendidos'] == 'sim') echo 'selected'; ?>>Sim</option>
                </select>
            </div>
        </div>

        <label>Descrição</label>
        <textarea name="descricao" rows="3"><?php echo $produto['descricao']; ?></textarea>

        <label>Foto Atual:</label><br>
        <div style="text-align: center;">
            <img src="img/<?php echo $produto['imagem']; ?>" class="foto-preview"><br>
            <label style="margin-top: 10px;">Alterar Imagem:</label>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <button type="submit">SALVAR ALTERAÇÕES</button>
        <a href="painel.php" class="btn-voltar"><i class="fas fa-times"></i> Cancelar e Voltar</a>
    </form>
</div>

</body>
</html>