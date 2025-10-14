{{-- sidebar.blade.php --}}

<div class="adminuiux-sidebar">
  <div class="adminuiux-sidebar-inner">
    <div class="px-3 not-iconic mt-2">
      <div class="row gx-3">
        <div class="col align-self-center">
          <h6 class="fw-medium">Bosh menyu</h6>
        </div>
        <div class="col-auto">
          <a class="btn btn-link btn-square" data-bs-toggle="collapse" data-bs-target="#usersidebarprofile" aria-expanded="false">
            <i data-feather="user"></i>
          </a>
        </div>
      </div>
      <div class="text-center collapse" id="usersidebarprofile">
        <figure class="avatar avatar-100 rounded-circle coverimg my-3">
          <img src="https://my.synterra.uz/assets/img/modern-ai-image/user-6.jpg" alt="">
        </figure>
        <h5 class="mb-1 fw-medium">Synterra</h5>
        <p class="small">Office</p>
      </div>
    </div>

    {{-- Menu joyi --}}
    <ul id="sidebar-menu" class="nav flex-column menu-active-line"></ul>

    <div class="mt-auto"></div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebarMenu = document.getElementById("sidebar-menu");
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');

  // Cookie-dan olish funksiyasi
  function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
  }

  async function loadMenu() {
    try {
      // Cookie-lardan session olamiz
      const sessionId = getCookie('sessionid');
      const officeSession = getCookie('my-office-session');

      // Agar cookie yo'q bo'lsa
      if (!sessionId && !officeSession) {
        sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Session topilmadi</li>";
        return;
      }

      // Fetch request yuboramiz
      const response = await fetch(baseUrl + "/proxy/menu", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": token,
          "Content-Type": "application/json"
        },
        credentials: "include" // cookie-larni avtomatik yuborish uchun muhim
      });

      const data = await response.json();
      console.log("API javob:", data);

      if (!data || Object.keys(data).length === 0) {
        sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Menu topilmadi</li>";
        return;
      }

      renderMenu(data);

    } catch (error) {
      console.error("Menu load error:", error);
      sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Xato yuz berdi</li>";
    }
  }

  function renderMenu(menu) {
    sidebarMenu.innerHTML = "";
    Object.values(menu).forEach(m => {
      const li = document.createElement("li");
      li.className = "nav-item";
      li.innerHTML = `
        <a href="${m.path}" class="nav-link d-flex align-items-center">
          <span class="me-2">${m.svg_icon}</span>
          <span class="menu-name">${m.name}</span>
        </a>
      `;
      sidebarMenu.appendChild(li);
    });
  }

  // Page ochilgan zahoti menu yuklanadi
  loadMenu();
});
</script>

