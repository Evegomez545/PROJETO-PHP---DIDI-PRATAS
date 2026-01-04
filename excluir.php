<?php
// INICIA A SESSÃO E VERIFICA A SEGURANÇA
session_start();

if (!isset($_SESSION['logado'])) { 
    header("Location: admin.php"); // Se não estiver logado, manda para o login
    exit; 
}

// CONECTA AO BANCO DE DADOS
require('conexao.php');

// PEGA O ID QUE VEIO PELO BOTÃO DA LIXEIRA NO PAINEL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // COMANDO PARA APAGAR O PRODUTO ESPECÍFICO
    $sql = "DELETE FROM produtos WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
       
        header("Location: painel.php?msg=excluido");
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
} else {
    
    header("Location: painel.php");
}
?>