<?php
session_start();

ob_start();

include '../views/templates/header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $novo_titulo = $_POST['title'];
    $nova_descricao = $_POST['description'];

    $sql = "UPDATE tasks SET title = ?, description = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$novo_titulo, $nova_descricao, $id])) {

        $_SESSION['update_task'] = "Atualizado com sucesso!";
        header('Location: ../views/tasks_view.php');
        exit;
    } else {
        echo "Erro ao atualizar registro: " . $stmt->errorInfo()[2];
    }
}
ob_end_flush();

?>

