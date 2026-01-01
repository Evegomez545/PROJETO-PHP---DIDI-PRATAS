<?php
// Inicia a sessão para poder manipulá-la
session_start();

// Limpa todas as variáveis da sessão (como o status 'logado')
session_unset();

// Destrói a sessão completamente
session_destroy();

// Redireciona o usuário de volta para a tela de login correta (admin.php)
header("Location: admin.php");
exit;
?>