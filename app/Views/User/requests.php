<section>
  <div class="container">
    <h2 class="title">Мои заявки</h2>
    <ul class="requests-list">
      <?php if (empty($requests)): ?>
        <li>У вас пока нет заявок.</li>
      <?php else: ?>
        <?php foreach($requests as $r): ?>
          <li class="request-item">
            <strong><?= htmlspecialchars($r['name']) ?></strong>
            — <?= htmlspecialchars($r['message']) ?><br>
            <em><?= htmlspecialchars($r['created_at']) ?></em>
            <span class="status status-<?= $r['status'] ?>">
              <?= $r['status'] === 'pending' ? 'Обрабатывается' : 'Одобрена' ?>
            </span>
          </li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>
  </div>
</section>
