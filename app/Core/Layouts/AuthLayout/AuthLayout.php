<?php /** @var \BIMS\Core\Views\View $this */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Please Sign In') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
  <?php include __DIR__ . '/../Partials/Toast.php'; ?>

  <div class="w-full max-w-md p-6 bg-white rounded-lg shadow">
    <?= $this->yield('content') ?>
  </div>
</body>
</html>
