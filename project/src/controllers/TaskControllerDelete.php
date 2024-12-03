<?php
session_start();

ob_start();

include '../views/templates/header.php'; 

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
$success = $stmt->execute([$id]); // Verifique se a execução foi bem-sucedida

if($success){
    $_SESSION['update_task'] = "Deletado com sucesso!";
    header('Location: ../views/tasks_view.php'); // Corrija a URL
    exit(); // Certifique-se de que o script pare de executar após o redirecionamento
}
ob_end_flush();

?>