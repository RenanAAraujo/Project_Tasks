<?php

include '../views/templates/header.php'; 

$id_user = $_GET['id_user'];

$stmt = $pdo->prepare('DELETE FROM users WHERE id_user = ?');
$success = $stmt->execute([$id_user]); // Verifique se a execução foi bem-sucedida

if($success){
    $_SESSION['update_task'] = "Deletado com sucesso!";
    header('Location: ../../public/register.php'); // Corrija a URL
    exit(); // Certifique-se de que o script pare de executar após o redirecionamento
}

?>