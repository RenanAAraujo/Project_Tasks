<?php
session_start();
include '../views/templates/header.php'; 


if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'] === 'true' ? 1 : 0;

    $stmt = $pdo->prepare('UPDATE tasks SET status = ? WHERE id = ? AND id_user = ?');
    if ($stmt->execute([$status, $id, $_SESSION['user_id']])) {
        echo "Status atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o status.";
    }
} else {
    echo "Dados inválidos.";
}
?>