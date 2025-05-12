<?php /** @var \BIMS\Core\View\View $this */ ?>
<?php $flashes = $this->getFlashes(); ?>
<?php if (!empty($flashes)): ?>
  <div id="toast-container" class="fixed top-5 right-5 space-y-2 z-50">
    <?php foreach ($flashes as $type => $msgs): ?>
      <?php foreach ($msgs as $msg): ?>
        <div class="px-4 py-2 rounded shadow
                    <?= $type==='success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' ?>">
          <?= htmlspecialchars($msg) ?>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
  <script>
    setTimeout(() => document.getElementById('toast-container')?.remove(), 4000);
  </script>
<?php endif; ?>
