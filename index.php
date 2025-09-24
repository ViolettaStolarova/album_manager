<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM albums ORDER BY created_at DESC");
$albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Albums Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h1 class="mb-4">Каталог музыкальных альбомов</h1>

    <a href="add.php" class="btn btn-primary mb-3">Добавить альбом</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Название</th>
          <th>Исполнитель</th>
          <th>Год</th>
          <th>Статус</th>
          <th>Дата создания</th>
          <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($albums as $album): ?>
        <tr>
          <td><?= htmlspecialchars($album['id']) ?></td>
          <td><?= htmlspecialchars($album['title']) ?></td>
          <td><?= htmlspecialchars($album['artist']) ?></td>
          <td><?= htmlspecialchars($album['release_year']) ?></td>
          <td>
            <span class="badge bg-<?= $album['status'] == 'прослушан' ? 'success' : 'warning' ?>">
              <?= htmlspecialchars($album['status']) ?>
            </span>
          </td>
          <td><?= htmlspecialchars($album['created_at']) ?></td>
          <td>
            <div class="btn-group" role="group">
              <a href="edit.php?id=<?= $album['id'] ?>" class="btn btn-sm btn-primary">Редактировать</a>
              <a href="update_status.php?id=<?= $album['id'] ?>" class="btn btn-sm btn-success">Отметить</a>
              <a href="delete.php?id=<?= $album['id'] ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Удалить альбом?')">Удалить</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>