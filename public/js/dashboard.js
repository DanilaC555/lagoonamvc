document.addEventListener("DOMContentLoaded", () => {
  const SERVER_URL = "http://lagoona.local";

    // Вывод имени и роли
    async function loadCurrentUser() {
      const userName = document.getElementById("user");
      const userRole = document.getElementById("role");

      if (!userName && !userRole) return;

      try {
          const response = await fetch(SERVER_URL + "/user/me", {
              credentials: "include"
          });

          if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
          }

          const data = await response.json();

          if (data.error) {
              userName.textContent = "Гость";
          } else {
              userName.textContent = data.name;
              userRole.textContent = '[ '+ data.role +' ]';
              userName.addEventListener("click", () => {
                  window.location.href = "/dashboard";
              });
              userRole.addEventListener("click", () => {
                  window.location.href = "/dashboard";
              });
          }
      } catch (error) {
          console.error("Ошибка загрузки пользователя:", error);
          userName.textContent = "Гость";
      }
  }

    // Выход
    async function logout() {
      const logoutBtn = document.getElementById("logoutBtn");

      if(!logoutBtn) return;

      logoutBtn.addEventListener("click", async (e) => {
          e.preventDefault();
          try{
              const response = await fetch(SERVER_URL + "/logout", {
                  method: "GET",
                  credentials: "include"
              })
              const data = await response.json();
              if(data.success) {
                  window.location.href = "/";
              } else {
                  alert("Ошибка при выходе");
              }
          } catch(error) {
              console.error("Ошибка при выходе:", error);
          }
      })
  }

  logout();
  loadCurrentUser();
});
