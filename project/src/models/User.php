<?php
session_start();
ob_start();
include '../views/templates/header.php'; 


$id_user = $_SESSION['user_id'];


$stmt = $pdo->prepare('SELECT * FROM users WHERE id_user = ?');
$stmt->execute([$id_user]);
$user = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch(PDO::FETCH_ASSOC) para obter um array associativo

$username = $user['username'];
$email = $user['email'];
$password = $user['password'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="index_body">
<form action="../controllers/UserController.php" method="post">
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($id_user); ?>">
        
        <label for="username">Nome de usuário</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        
        <label for="password">Senha</label>
        <input type="password" name="password" value="">
        
        <button type="submit">Atualizar Dados</button>
        
        <a href="../../public/index.php">Voltar</a><br><br>
        <a href="../controllers/UsercontrollerDelete.php">Deletar conta</a>
        <?php
?> 
</form>
</body>
</html>

<?php
include '../views/templates/footer.php';

ob_end_flush();
?>