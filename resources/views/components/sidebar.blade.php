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

    <ul id="sidebar-menu" class="nav flex-column menu-active-line"></ul>

    <div class="mt-auto"></div>
  </div>
</div>
 <main class="adminuiux-content has-sidebar" onclick="contentClick()"> 
 
        <!-- breadcrumb --> 
        <div class="container-fluid mt-3"> 
        </div> 
 
        <!-- content --> 
        <div class="container mt-3" id="main-content"> 
        </div> 
 
        <!-- mobile footer --> 
        <footer class="adminuiux-mobile-footer hide-on-scrolldown style-2"> 
            <div class="container"> 
                <ul class="nav nav-pills nav-justified"> 
                    <li class="nav-item"> 
                        <a class="nav-link" href="#"> 
                    <span> 
                        <i class="nav-icon" data-feather="home"></i> 
                        <span class="nav-text">Home</span> 
                    </span> 
                        </a> 
                    </li> 
                    <li class="nav-item"> 
                        <a class="nav-link" href="#"> 
                    <span> 
                        <i class="nav-icon bi bi-wallet"></i> 
                        <span class="nav-text">Wallet</span> 
                    </span> 
                        </a> 
                    </li> 
                    <li class="nav-item"> 
                        <a href="#" class="nav-link "> 
                    <span> 
                        <i class="nav-icon" data-feather="target"></i> 
                        <span class="nav-text">Goals</span> 
                    </span> 
                        </a> 
                    </li> 
                    <li class="nav-item"> 
                        <a class="nav-link" href="#"> 
                    <span> 
                        <i class="nav-icon" data-feather="users"></i> 
                        <span class="nav-text">Statistic</span> 
                    </span> 
                        </a> 
                    </li> 
                    <li class="nav-item"> 
                        <a class="nav-link" href="#"> 
                    <span> 
                        <i class="nav-icon bi bi-calculator"></i> 
                        <span class="nav-text">Calc.</span> 
                    </span> 
                        </a> 
                    </li> 
                </ul> 
            </div> 
        </footer> 
</main> 
<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebarMenu = document.getElementById("sidebar-menu");

  // 🍪 Cookie olish funksiyasi
  function getCookie(name) {
    let value = `; ${document.cookie}`;
    let parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  async function loadMenu() {
    try {
      // Cookie’dan session_key_id olamiz (agar bo‘lmasa fallback static)
      const sessionKey = getCookie("session_id") || getCookie("session_key_id");

      if (!sessionKey) {
        sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Token topilmadi, qaytadan login qiling</li>";
        return;
      }

      // API’ga so‘rov
      const response = await fetch("https://my.synterra.uz/backs/menu/get_list", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          sessionid: sessionKey // 🚀 avval cookie’dagi id yuboramiz
        })
      });

      const data = await response.json();

      // 🔑 Agar API’da session_id qaytsa → uni ishlatamiz
      const realSessionId = data?.session_id || "ryd3wprsupdvp7pkt90srqni3o6fdf6z";

      // 🔄 API qaytgan menu bo‘sh bo‘lsa
      if (!data || !data.menu) {
        sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Menu topilmadi</li>";
        return;
      }

      // Menuni render qilish
      renderMenu(data.menu);

      console.log("✅ Ishlatilgan session_id:", realSessionId);
    } catch (error) {
      console.error("Menu load error:", error);
      sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Xato yuz berdi</li>";
    }
  }

  // Menuni chizish
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

  loadMenu();
});
</script>


