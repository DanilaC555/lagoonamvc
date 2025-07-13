<section>
  <div class="container">
    <h2 class="title">Мои брони:</h2>
    <ul>
    <?php foreach($bookings as $b): ?>
      <li class="booking-item">
        <img src="<?= htmlspecialchars($b['image_path'])?>" alt="" width="80">
        <strong><?= htmlspecialchars($b['name']) ?></strong>
        с <?= $b['start_date'] ?> по <?= $b['end_date'] ?>
        — туристов: <?= $b['guests'] ?>
        <button class="cancel-btn" data-id="<?= $b['id'] ?>">Отменить</button>
      </li>
    <?php endforeach; ?>
    </ul>
  </div>
</section>
<script>
  document.querySelectorAll('.cancel-btn').forEach(btn=>{
    btn.addEventListener('click', async ()=>{
      const res = await fetch(`/bookings/cancel/${btn.dataset.id}`, {
        method:'DELETE', credentials:'include'
      });
      const json = await res.json();
      alert(res.ok?json.success:json.error);
      if(res.ok) location.reload();
    });
  });
</script>
