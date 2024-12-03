<?php 
session_start();
include 'templates/header.php'; 

if (isset($_SESSION['register_error'])) {
    echo '<p class="error-message">' . $_SESSION['register_error'] . '</p>';
    unset($_SESSION['register_error']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
}
    ?>
<!DOCTYPE html>
<html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar novo Usuário</title>
    <link rel="stylesheet" href="caminho/para/seu/arquivo.css">
</head>
<body class="index_body">
<form action="../../public/register.php" method="post">
        <label for="username">Nome de Usuário</label>
        <input type="text" name="username" id="username">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Enviar</button>
        <a href="login_view.php">Já tem uma conta? Faça Login!</a>
</form>
</body>
</html>
<?php include 'templates/footer.php'; ?>
