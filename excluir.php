<?php
// 1. INICIA A SESSÃO E VERIFICA A SEGURANÇA
session_start();

if (!isset($_SESSION['logado'])) { 
    header("Location: admin.php"); // Se não estiver logado, manda para o login
    exit; 
}

// 2. CONECTA AO BANCO DE DADOS
require('conexao.php');

// 3. PEGA O ID QUE VEIO PELO BOTÃO DA LIXEIRA NO PAINEL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 4. COMANDO PARA APAGAR O PRODUTO ESPECÍFICO
    $sql = "DELETE FROM produtos WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        // Se deu certo, volta para o painel com uma mensagem de sucesso
        header("Location: painel.php?msg=excluido");
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
} else {
    // Se tentarem acessar o arquivo sem um ID, volta para o painel
    header("Location: painel.php");
}
?>