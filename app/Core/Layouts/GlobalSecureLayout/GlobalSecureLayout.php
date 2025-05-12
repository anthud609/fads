<?php
// views/layout.php
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'My App') ?></title>
  <!-- Tailwind CDN for quick styling (optional) -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col">
  <header class="bg-blue-600 text-white p-4">
    <h1 class="text-xl">My BPO App</h1>
  </header>

  <main class="flex-1 p-6">
    <?= $content ?>
  </main>

  <footer class="bg-gray-100 text-gray-700 p-4 text-sm text-center">
    &copy; <?= date('Y') ?> Acme Corp.
  </footer>
</body>
</html>
