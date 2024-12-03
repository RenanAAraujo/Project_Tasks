<?php
session_start();

ob_start();

include '../views/templates/header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash da senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id_user = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$username, $email, $hashedPassword, $id_user])) {
        $_SESSION['update_task'] = "Atualizado com sucesso!";
        header('Location: ../../public/index.php');
        exit;
    } else {
        echo "Erro ao atualizar registro: " . $stmt->errorInfo()[2];
    }
}
ob_end_flush();
?>
