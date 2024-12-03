<?php
session_start();
ob_start();
include_once __DIR__ . '/../src/views/templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar e executar a consulta para verificar o usuário
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verificar se o usuário existe e se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Nome de usuário ou senha inválidos';
        header('Location: ../src/views/login_view.php');
        exit;

    }
}

ob_end_flush();
?>

