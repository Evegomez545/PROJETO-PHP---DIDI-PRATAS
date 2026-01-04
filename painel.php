<?php
session_start();
if (!isset($_SESSION['logado'])) { 
    header("Location: admin.php");
    exit;
}
include('conexao.php');

$sql = "SELECT id, nome, preco, tipo, imagem FROM produtos ORDER BY id DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo | Didi Pratas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif; 
            /* COR ALGODÃO EGÍPCIO MAIS FORTE NO FUNDO */
            background-color: #E8DCCB; 
            margin: 0; 
            padding: 20px; 
            min-height: 100vh;
        }

        .container { 
            max-width: 1100px; 
            margin: auto; 
            background: #FAF9F6; 
            padding: 30px; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px;
            gap: 15px;
            flex-wrap: wrap;
        }

        h2 { color: #5D4037; margin: 0; font-weight: 600; }
        
        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }
        .search-container input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border-radius: 25px;
            border: 2px solid #D7C4B0; 
            outline: none;
            background: white;
        }
        .search-container i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #A69B91;
        }

       
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0 15px; 
        }
        
        th { color: #8D6E63; text-align: left; padding: 0 20px; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
        
    
        tbody tr { 
            background: white;
            transition: 0.3s;
        }

        td { 
            padding: 20px; 
            vertical-align: middle;
            border-top: 2px solid #D7C4B0; 
            border-bottom: 2px solid #D7C4B0; 
        }

        
        td:first-child { 
            border-left: 2px solid #D7C4B0; 
            border-radius: 15px 0 0 15px; 
        }
        td:last-child { 
            border-right: 2px solid #D7C4B0; 
            border-radius: 0 15px 15px 0; 
        }

        .img-prod { 
            width: 75px; 
            height: 75px; 
            object-fit: cover; 
            border-radius: 12px; 
            border: 1px solid #D7C4B0;
        }
        
        .tipo-tag { 
            background: #E8DCCB; 
            padding: 8px 18px; 
            border-radius: 20px; 
            font-size: 14px; 
            color: #5D4037; 
            font-weight: 600;
            border: 1px solid #D7C4B0;
        }

        .nome-produto { font-size: 17px; color: #4E342E; }
        .preco { font-weight: bold; color: #D1155A; font-size: 18px; }

        .btn-edit { color: #F1C40F; font-size: 22px; text-decoration: none; margin-right: 15px; }
        .btn-del { color: #E74C3C; font-size: 22px; text-decoration: none; }

        .btn-add { background: #5a7465ff; color: white; padding: 12px 25px; border-radius: 30px; text-decoration: none; font-weight: bold; }
        .btn-logout { background: #E67E22; color: white; padding: 12px 14px; border-radius: 50%; text-decoration: none; }

        @media (max-width: 600px) {
            th:nth-child(3), td:nth-child(3) { display: none; }
            .search-container { order: 3; max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>Meus Produtos</h2>
        
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" id="inputBusca" onkeyup="buscarProduto()" placeholder="Procurar produtos...">
        </div>

        <div>
            <a href="cadastrar.php" class="btn-add">NOVO</a>
            <a href="logout.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </header>

    <table id="tabelaProdutos">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($prod = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><img src="img/<?php echo $prod['imagem']; ?>" class="img-prod"></td>
                <td class="nome-produto"><strong><?php echo $prod['nome']; ?></strong></td>
                <td><span class="tipo-tag"><?php echo $prod['tipo']; ?></span></td>
                <td class="preco">R$ <?php echo number_format($prod['preco'], 2, ',', '.'); ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $prod['id']; ?>" class="btn-edit"><i class="fas fa-pen"></i></a>
                    <a href="excluir.php?id=<?php echo $prod['id']; ?>" class="btn-del" onclick="return confirm('Deseja excluir?')"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function buscarProduto() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("inputBusca");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelaProdutos");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByClassName("nome-produto")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
    }
  }
}
</script>

</body>
</html>