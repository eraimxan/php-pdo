<?php
$pdo = include_once __DIR__ . '/connection.php';

$message = "";

// Обработка добавления пользователя
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($name && $email && $password) {
        // Проверка уникальности email
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            $message = "❗ Пользователь с таким email уже существует!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password]);
            $message = "✅ Пользователь успешно добавлен!";
        }
    } else {
        $message = "❗ Заполните все поля!";
    }
}

// Обработка удаления пользователя
if (isset($_POST['delete'])) {
    $userId = (int)$_POST['delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $message = "✅ Пользователь удалён!";
}

// Обработка обновления пароля
if (isset($_POST['update'])) {
    $userId = (int)$_POST['user_id'];
    $newPassword = trim($_POST['new_password']);

    if ($newPassword) {
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            'password' => $newPassword,
            'id' => $userId
        ]);
        $message = "✅ Пароль обновлён!";
    } else {
        $message = "❗ Новый пароль не может быть пустым!";
    }
}

// Получение всех пользователей
$stmt = $pdo->query("SELECT * FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление пользователями</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form.inline { display: inline; }
        .message { padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; background: #fafafa; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 6px; }
        input[type="submit"] { padding: 6px 12px; }
        .form-section { max-width: 400px; margin-top: 30px; }
    </style>
</head>
<body>
    <h1>Управление пользователями</h1>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Список пользователей</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <!-- Удалить -->
                    <form method="post" class="inline">
                        <input type="hidden" name="delete" value="<?php echo $user['id']; ?>">
                        <input type="submit" value="Удалить">
                    </form>
                    <!-- Обновить пароль -->
                    <form method="post" class="inline">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="password" name="new_password" placeholder="Новый пароль" required>
                        <input type="submit" name="update" value="Сменить пароль">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="form-section">
        <h2>Добавить нового пользователя</h2>
        <form method="post">
            <label>Имя:
                <input type="text" name="name" required>
            </label>
            <label>Email:
                <input type="email" name="email" required>
            </label>
            <label>Пароль:
                <input type="password" name="password" required>
            </label>
            <input type="submit" name="add" value="Добавить">
        </form>
    </div>
</body>
</html>
