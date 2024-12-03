<?php
session_start();
include 'templates/header.php'; 

if (isset($_SESSION['login_error'])) {
    echo '<p class="error-message">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
}
?>
<?php if (isset($_SESSION['register_success'])): ?>
    <div class="success-message"><?php echo $_SESSION['register_success']; unset($_SESSION['register_success']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['register_error'])): ?>
    <div class="error-message"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['email_verified'])): ?>
    <div class="success-message"><?php echo $_SESSION['email_verified']; unset($_SESSION['email_verified']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['email_verification_error'])): ?>
    <div class="error-message"><?php echo $_SESSION['email_verification_error']; unset($_SESSION['email_verification_error']); ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="caminho/para/seu/arquivo.css">
</head>
<body class="index_body">
 <form action="../../public/login.php" method="post">
        <label for="username">Nome de Usuário</label>
        <input type="text" name="username" id="username">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Enviar</button>
        <a href="register_view.php">É novo? Registre-se!</a>
  </form>
</body>
</html>
<?php include 'templates/footer.php'; ?>


