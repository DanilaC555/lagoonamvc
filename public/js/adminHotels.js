document.addEventListener('DOMContentLoaded', ()=>{
  const SERVER = 'http://lagoona.local';

  loadHotels();

  const tpl   = document.getElementById('hotelCardTpl');
  const cont  = document.getElementById('hotelsContainer');
  const modal = document.getElementById('hotelModal');
  const close = modal.querySelector('.modules__close');
  const form  = document.getElementById('hotelForm');

  let currentId = null;

  // открыть/закрыть modal
  document.getElementById('addHotelBtn').addEventListener('click', ()=>{
    currentId = null; form.reset(); modal.style.display='block';
  });
  close.addEventListener('click', ()=> modal.style.display='none');
  window.addEventListener('click', e=>{ if(e.target===modal) modal.style.display='none'; });

  // загрузить список
  async function loadHotels(){
    const res = await fetch(SERVER+'/admin/hotels/list',{credentials:'include'});
    const list= await res.json();
    cont.innerHTML='';
    list.forEach(h=>{
      const card = tpl.content.cloneNode(true);
      card.querySelector('img').src = h.image_path;
      card.querySelector('.placement-price').textContent = h.price_per_night;
      card.querySelector('.placement-title-item').textContent = h.name;
      card.querySelector('.placement-descr').textContent = `${h.city}, ${h.country}`;
      // звёзды
      const stars = card.querySelector('.svg-stars');
      for(let i=0;i<5;i++){
        const img = document.createElement('img');
        img.src = i< h.rating? '/img/star.svg':'/img/star-white.svg';
        stars.appendChild(img);
      }
      // кнопки
      card.querySelector('.edit-btn').addEventListener('click', ()=>{
        currentId = h.id;
        document.getElementById('hotelId').value       = h.id;
        document.getElementById('hotelName').value     = h.name;
        document.getElementById('hotelCity').value     = h.city;
        document.getElementById('hotelCountry').value  = h.country;
        document.getElementById('hotelPrice').value    = h.price_per_night;
        document.getElementById('hotelRating').value   = h.rating;
        modal.style.display='block';
      });
      card.querySelector('.delete-btn').addEventListener('click', async ()=>{
        await fetch(`${SERVER}/admin/hotels/delete/${h.id}`, { method:'DELETE', credentials:'include' });
        loadHotels();
      });
      cont.appendChild(card);
    });
  }

  // submit формы
  form.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(form);
    // formData теперь содержит поля name, city, country, price_per_night, rating…
    // а также файл из <input name="image">

    const url    = currentId
      ? `${SERVER}/admin/hotels/update/${currentId}`
      : `${SERVER}/admin/hotels/create`;
    // и всегда POST
    await fetch(url, {
      method: 'POST',
      credentials: 'include',
      body: formData    // Браузер автоматически выставит нужный Content-Type
    });

    modal.style.display = 'none';
    loadHotels();
  });
});
