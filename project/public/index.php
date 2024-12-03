<?php
session_start();
ob_start();
include_once __DIR__ . '/../src/views/templates/header.php';

$stmt = $pdo->prepare('SELECT * FROM users WHERE id_user = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html>
    <head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Sistema de Gerenciamento de Tarefas</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="index_body">
    <h1>Bem-vindo ao Sistema de Gerenciamento de Tarefas</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
    <span>Olá, <a class="title" href="../src/models/User.php?id_user=<?php echo $_SESSION['user_id']; ?>"><?php echo $user['username']; ?></a>! <a class="title" href="../src/views/tasks_view.php">Veja suas tarefas</a> ou <a class="title" href="logout.php">Logout</a></span>
<?php else: ?>
    <span><a class="title" href="src/views/login_view.php">Login</a> ou <a class="title" href="src/views/register_view.php">Registrar</a></span>
<?php endif; ?>
</body>
</html>

<?php
include '../src/views/templates/footer.php';
?>