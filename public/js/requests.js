document.addEventListener("DOMContentLoaded", () => {

  document.getElementById('requestForm').addEventListener('submit', async e => {
    e.preventDefault();
    const form = e.target;
    const data = Object.fromEntries(new FormData(form).entries());
    const res  = await fetch('/requests/create', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      credentials: 'include',
      body: JSON.stringify(data)
    });
    const json = await res.json();
    const msg  = document.getElementById('requestResult');
    if (res.ok) {
      msg.textContent = json.success;
      msg.classList.remove('error');
      msg.classList.add('success');
      form.reset();
    } else {
      msg.textContent = json.error;
      msg.classList.add('error');
    }
  });
});
