<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM albums WHERE id = ?");
$stmt->execute([$id]);
$album = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$album) {
    header('Location: index.php');
    exit;
}

if ($_POST) {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $artist = isset($_POST['artist']) ? trim($_POST['artist']) : '';
    $release_year = isset($_POST['release_year']) ? trim($_POST['release_year']) : '';

    if ($title !== '' && $artist !== '' && $release_year !== '') {
        $stmt = $pdo->prepare("UPDATE albums SET title = ?, artist = ?, release_year = ? WHERE id = ?");
        $stmt->execute([$title, $artist, $release_year, $id]);
        header('Location: index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Редактировать альбом</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h1>Редактировать альбом</h1>

    <form method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Название альбома *</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($album['title']) ?>"
          required maxlength="255">
      </div>

      <div class="mb-3">
        <label for="title" class="form-label">Исполнитель *</label>
        <input type="text" class="form-control" id="title" name="artist"
          value="<?= htmlspecialchars($album['artist']) ?>" required maxlength="255">
      </div>

      <div class="mb-3">
        <label for="title" class="form-label">Год выпуска *</label>
        <input type="text" class="form-control" id="title" name="release_year"
          value="<?= htmlspecialchars($album['release_year']) ?>" required maxlength="255">
      </div>

      <button type="submit" class="btn btn-primary">Сохранить</button>
      <a href="index.php" class="btn btn-secondary">Отмена</a>
    </form>
  </div>
</body>

</html>