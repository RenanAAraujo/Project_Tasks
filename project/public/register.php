<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

include_once __DIR__ . '/../src/views/templates/header.php';
session_start();
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha
    $token = bin2hex(random_bytes(50)); // Gerar um token de verificação

    // Verificar se o nome de usuário já existe
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['register_error'] = "Usuário existente!";
        header('Location: ../src/views/register_view.php');
    } else {
        // Inserir novo usuário no banco de dados
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password, token) VALUES (?, ?, ?, ?)');
        if ($stmt->execute([$username, $email, $password, $token])) {
            // Configurar o PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Configurações do servidor
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io'; // Substitua pelo seu servidor SMTP
                $mail->SMTPAuth = true;
                $mail->Username = '#'; // Substitua pelo seu e-mail
                $mail->Password = '#'; // Substitua pela sua senha
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configurações do e-mail
                $mail->setFrom('seu-email@dominio.com', 'Seu Nome');
                $mail->addAddress($email, $username);
                $mail->Subject = 'Confirme seu e-mail';
                $mail->Body = "Clique no link para confirmar seu e-mail: http://seusite.com/confirm_email.php?token=$token";

                // Enviar o e-mail
                $mail->send();
                $_SESSION['register_success'] = "Cadastro realizado com sucesso! Verifique seu e-mail para confirmar.";
                header('Location: ../src/views/login_view.php');
            } catch (Exception $e) {
                $_SESSION['register_error'] = "Erro ao enviar e-mail de confirmação: {$mail->ErrorInfo}";
                header('Location: ../src/views/register_view.php');
            }
        } else {
            $_SESSION['register_error'] = "Erro ao registrar o usuário!";
            header('Location: ../src/views/register_view.php');
        }
    }
}

ob_end_flush();
?>

