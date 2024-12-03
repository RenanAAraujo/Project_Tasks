<?php
session_start();
ob_start();
include 'templates/header.php'; 
    
if (isset($_SESSION['update_task'])) {
    echo '<p class="success-message">' . $_SESSION['update_task'] . '</p>';
    unset($_SESSION['update_task']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
}

if (isset($_SESSION['update_task_error'])) {
    echo '<p class="error-message">' . $_SESSION['update_task_error'] . '</p>';
    unset($_SESSION['update_task_error']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="caminho/para/seu/arquivo.css">
</head>
<body class="task-body">
    <h2>Minhas Tarefas</h2>
    
    <form class="task-form" method="post" action="../../public/tasks.php">
        <label for="title" class="task-label">Título:</label>
        <input type="text" id="title" name="title" class="task-input" required>
        
        <label for="description" class="task-label">Descrição:</label>
        <textarea id="description" name="description" class="task-textarea" required></textarea>
        
        <button type="submit" class="task-button">Adicionar Tarefa</button>
        <br>
        <br>
        <a href="../../public/index.php" class="task-link">Voltar</a>
        <a href="../../public/logout.php" class="task-link">Logout</a>
    </form>
  
    <ul class="task-lista">
        <?php
        // Defina o número de resultados por página
        $results_per_page = 5;

        // Descubra o número total de tarefas
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM tasks WHERE id_user = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $total_tasks = $stmt->fetchColumn();

        // Calcule o número total de páginas
        $total_pages = ceil($total_tasks / $results_per_page);

        // Descubra qual página o usuário está
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        if ($page > $total_pages) $page = $total_pages;

        // Calcule o OFFSET para a consulta SQL
        $offset = ($page - 1) * $results_per_page;

        // Modifique a consulta para incluir LIMIT e OFFSET
        $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id_user = ? LIMIT ? OFFSET ?');
        $stmt->execute([$_SESSION['user_id'], $results_per_page, $offset]);
        $tasks = $stmt->fetchAll();

        foreach ($tasks as $task): ?>
            <li class="task-item">
                <input type="checkbox" name="status" id="status-<?php echo $task['id']; ?>" <?php echo $task['status'] ? 'checked' : ''; ?> onchange="updateTaskStatus(<?php echo $task['id']; ?>, this.checked)">
                <span class="task-title <?php echo $task['status'] ? 'completed' : ''; ?>"><?php echo htmlspecialchars($task['title']); ?></span>
                <button class="task-detalhes-btn" onclick="toggleDescricao(<?php echo $task['id']; ?>)">Detalhes</button>
                <div id="descricao-<?php echo $task['id']; ?>" class="task-descricao">
                    <?php echo htmlspecialchars($task['description']); ?>
                    <br><br>
                </div>
                <a href="../models/Task.php?id=<?php echo $task['id']; ?>" class="task-link">Editar</a>
                <a href="../controllers/TaskControllerDelete.php?id=<?php echo $task['id']; ?>" class="task-link">Deletar</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="pagination-item"><a href="?page=<?php echo $page - 1; ?>" class="pagination-link">Anterior</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="pagination-item">
                <a href="?page=<?php echo $i; ?>" class="pagination-link" <?php if ($i == $page) echo 'aria-current="page"'; ?>><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <li class="pagination-item"><a href="?page=<?php echo $page + 1; ?>" class="pagination-link">Próxima</a></li>
        <?php endif; ?>
    </ul>
</body>
</html>

<?php
// Incluir o rodapé
include 'templates/footer.php';

?>