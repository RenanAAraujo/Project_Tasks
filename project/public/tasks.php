<?php
session_start();
include_once __DIR__ . '/../src/views/templates/header.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: ../src/views/login_view.php');
    exit;
}

// Processar o formulário de criação de tarefas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userId = $_SESSION['user_id'];
    $status = 0;
    // Inserir a nova tarefa no banco de dados
    $stmt = $pdo->prepare('INSERT INTO tasks (id_user, title, description, status) VALUES (?, ?, ?, ?)');
    if ($stmt->execute([$userId, $title, $description, $status])) {
        $_SESSION['update_task'] = "Adicionado com sucesso!";
    header('Location: ../src/views/tasks_view.php');

    } else {
        $_SESSION['message'] =  'Erro ao criar tarefa!';
    }
}

ob_end_flush();

?>