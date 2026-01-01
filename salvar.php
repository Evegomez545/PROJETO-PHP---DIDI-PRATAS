<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $imagem = $_POST['imagem'];
    $descricacao = $_POST['desc'];
    $tipo = $_POST['tipo'];
    $estilo = $_POST['estilo'];
    $lancamentos = $_POST['lançamentos'];
    $mais_vendidos = $_POST['mais-vendidos'];

    
    $sql = "INSERT INTO produtos (nome, preco, estoque, imagem, descricao, tipo, estilo, lançamentos, `mais-vendidos`) 
            VALUES ('$nome', '$preco', '$estoque', '$imagem', '$descricacao', '$tipo', '$estilo', '$lançamentos', '$mais_vendidos')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='admin.php';</script>";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conn);
    }
}
?>