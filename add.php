<?php
require_once 'config.php';

if ($_POST) {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $artist = isset($_POST['artist']) ? trim($_POST['artist']) : '';
    $release_year = isset($_POST['release_year']) ? trim($_POST['release_year']) : '';

    if ($title !== '' && $artist !== '' && $release_year !== '') {
        $stmt = $pdo->prepare("INSERT INTO albums (title, artist, release_year) VALUES (?, ?, ?)");
        $stmt->execute([$title, $artist, $release_year]);
        header('Location: index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Добавить задачу</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h1>Добавить новый альбом</h1>

    <form method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Название альбома *</label>
        <input type="text" class="form-control" id="title" name="title" required maxlength="255">
      </div>

      <div class="mb-3">
        <label for="artist" class="form-label">Исполнитель *</label>
        <input type="text" class="form-control" id="artist" name="artist" required maxlength="255">
      </div>

      <div class="mb-3">
        <label for="release_year" class="form-label">
          Год выпуска <span class="required">*</span>
        </label>
        <input type="number" class="form-control" id="release_year" name="release_year" required min="1900"
          max="<?php echo date('Y') + 1; ?>">
      </div>

      <button type="submit" class="btn btn-primary">Добавить</button>
      <a href="index.php" class="btn btn-secondary">Отмена</a>
    </form>
  </div>
</body>

</html>