const modal = document.getElementById('bookingModal');
const close = modal.querySelector('.modules__close');
const form  = document.getElementById('bookingForm');

// открыть модалку
document.querySelectorAll('.book-btn').forEach(btn=>{
  btn.addEventListener('click',()=>{
    form.reset();
    modal.style.display='block';
    document.getElementById('bookingHotelId').value = btn.dataset.hotelId;
  });
});

close.addEventListener('click', ()=> modal.style.display='none');
window.addEventListener('click', e=> {
  if (e.target === modal) modal.style.display='none';
});

// submit
form.addEventListener('submit', async e=>{
  e.preventDefault();
  const hotelId = form.bookingHotelId.value;
  const formData = new FormData(form);
  const res = await fetch(`/bookings/create/${hotelId}`, {
    method: 'POST',
    credentials: 'include',
    body: formData
  });
  const json = await res.json();
  alert(res.ok ? json.success : json.error);
  if (res.ok) modal.style.display='none';
});
