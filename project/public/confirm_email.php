<?php
include_once __DIR__ . '/../src/views/templates/header.php';
session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar o token no banco de dados
    $stmt = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Atualizar o status do e-mail para verificado
        $stmt = $pdo->prepare('UPDATE users SET email_verified = TRUE, token = NULL WHERE id = ?');
        if ($stmt->execute([$user['id']])) {
            $_SESSION['email_verified'] = "E-mail confirmado com sucesso!";
            header('Location: ../src/views/login_view.php');
        } else {
            $_SESSION['email_verification_error'] = "Erro ao confirmar o e-mail!";
            header('Location: ../src/views/register_view.php');
        }
    } else {
        $_SESSION['email_verification_error'] = "Token inválido!";
        header('Location: ../src/views/register_view.php');
    }
} else {
    $_SESSION['email_verification_error'] = "Token não fornecido!";
    header('Location: ../src/views/register_view.php');
}
?>