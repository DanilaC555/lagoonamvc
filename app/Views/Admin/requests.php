<section>
  <div class="container">
    <h2>Заявки пользователей</h2>
    <table class="admin-requests">
      <thead>
        <tr>
          <th>ID</th><th>Пользователь</th><th>Сообщение</th><th>Дата</th><th>Статус</th><th>Действия</th>
        </tr>
      </thead>
      <tbody id="requestsTableBody">
      </tbody>
    </table>
  </div>
</section>

<script type="module">
  async function loadRequests() {
    const res = await fetch('/admin/requests/list', { credentials:'include' });
    const data = await res.json();
    const tbody = document.getElementById('requestsTableBody');
    tbody.innerHTML = '';
    data.forEach(r => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${r.id}</td>
        <td>${r.user_name} (${r.user_email})</td>
        <td>${r.message}</td>
        <td>${r.created_at}</td>
        <td>${r.status}</td>
        <td>
          ${r.status === 'pending'
            ? `<button class="approve-btn" data-id="${r.id}">Одобрить</button>`
            : ''}
          <button class="delete-btn" data-id="${r.id}">Удалить</button>
        </td>`;
      tbody.appendChild(tr);
    });
    // навешиваем события
    document.querySelectorAll('.approve-btn').forEach(btn => {
  btn.onclick = async () => {
    const requestId = btn.dataset.id;
    await fetch(`/admin/requests/approve/${requestId}`, {
      method: 'PUT',           // а у вас в маршрутах стоит PUT, не POST
      credentials: 'include'
    });
    loadRequests();
  };
});
document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.onclick = async () => {
    const requestId = btn.dataset.id;
    await fetch(`/admin/requests/delete/${requestId}`, {
      method: 'DELETE',
      credentials: 'include'
    });
    loadRequests();
  };
});
  }

  loadRequests();
</script>
