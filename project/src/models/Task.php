<?php

session_start();
ob_start();

include '../views/templates/header.php'; 

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch(PDO::FETCH_ASSOC) para obter um array associativo

// Agora você pode acessar os dados da tarefa
$titulo = $task['title'];
$descricao = $task['description'];
$id = $task['id'];
?>
<body class="index_body">
<form method="post" action="../controllers/TaskController.php">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="title" value="<?php echo htmlspecialchars($titulo); ?>">
<br><br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="description"><?php echo htmlspecialchars($descricao); ?></textarea>
    <br><br>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <button type="submit">Atualizar Tarefa</button>
<br>
<br>
<a href="../views/tasks_view.php">Voltar</a>

</form>

</body>
</html>

<?php
include '../views/templates/footer.php';

ob_end_flush();

?>

