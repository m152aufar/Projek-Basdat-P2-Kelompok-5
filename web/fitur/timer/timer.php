<?php include("inc_header.php"); ?>
<?php

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

if (isset($_POST['add_task'])) {
    $taskName = $_POST['task_name'];

    if ($taskName) {
        $_SESSION['tasks'][] = ['name' => $taskName, 'completed' => false];
    }
}

if (isset($_POST['delete_task'])) {
    if (isset($_POST['index'])) {
        $index = $_POST['index'];
        if (isset($_SESSION['tasks'][$index])) {
            unset($_SESSION['tasks'][$index]);
        }
    }
}

if (isset($_POST['toggle_task'])) {
    if (isset($_POST['index'])) {
        $index = $_POST['index'];
        if (isset($_SESSION['tasks'][$index])) {
            $_SESSION['tasks'][$index]['completed'] = !$_SESSION['tasks'][$index]['completed'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podomoro Timer</title>
    <link rel="icon" type="web/image/png" href="image/logo12.png" sizes="32x32" />
    <link rel="stylesheet" href="taim.css">
</head>
<body>
    <div class="container">
    <h1 class="text-center mt-4">Timer</h1>

        <div id="timer-container">
            <div id="timer">25:00</div>
            <button id="start-btn">Start</button>
            <button id="reset-btn">Reset</button>
        </div>

        <div id="task-container">
            <h2>Task List</h2>
            <ul>
                <?php if (isset($_SESSION['tasks']) && is_array($_SESSION['tasks'])) : ?>
                    <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                        <li>
                            <form method="post" style="display: inline;">
                                <input type="checkbox" name="toggle_task" <?= $task['completed'] ? 'checked' : '' ?>>
                                <input type="hidden" name="index" value="<?= $index; ?>">
                                <button type="submit" name="toggle_task"><?= $task['name']; ?></button>
                            </form>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="index" value="<?= $index; ?>">
                                <button type="submit" name="delete_task">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <form method="post">
                <label for="task_name">Task Name:</label>
                <input type="text" id="task_name" name="task_name" required>
                <button type="submit" name="add_task" id="add-task-btn">Add Task</button>
            </form>
        </div>
    </div>

    <script>
        let timer;
        let timeLeft = 1500;
        let isRunning = false;

        document.getElementById('start-btn').addEventListener('click', function() {
            if (!isRunning) {
                isRunning = true;
                timer = setInterval(function() {
                    timeLeft--;
                    document.getElementById('timer').textContent = new Date(timeLeft * 1000).toISOString().substr(14, 5);
                }, 1000);
            }
        });

        document.getElementById('reset-btn').addEventListener('click', function() {
            clearInterval(timer);
            timeLeft = 1500;
            isRunning = false;
            document.getElementById('timer').textContent = new Date(timeLeft * 1000).toISOString().substr(14, 5);
        });
    </script>
</body>
</html>
