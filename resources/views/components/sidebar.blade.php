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
<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebarMenu = document.getElementById("sidebar-menu");
  if (!sidebarMenu) return;

  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');

  // 🍪 Cookie olish
  function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
    return null;
  }

  // 📥 Menu yuklash
  async function loadMenu() {
    try {
      const sessionId = getCookie("sessionid");
      const officeSession = getCookie("my-office-session");

      if (!sessionId && !officeSession) {
        sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Session topilmadi</li>";
        return;
      }

      const response = await fetch(`${baseUrl}/proxy/menu`, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": token,
          "Content-Type": "application/json",
        },
        credentials: "include",
      });

      const data = await response.json();
      console.log("📦 API menu data:", data);

      if (!data || Object.keys(data).length === 0) {
        sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Menu topilmadi</li>";
        return;
      }

      const menuArray = Object.values(data);
      renderMenu(menuArray);
    } catch (err) {
      console.error("❌ Menu load error:", err);
      sidebarMenu.innerHTML = "<li class='text-danger p-3'>❌ Xato yuz berdi</li>";
    }
  }

  // 🧩 Menu render funksiyasi
  function renderMenu(menuItems) {
    sidebarMenu.innerHTML = "";

    // rekursiv render
    function renderNode(node) {
      const hasChildren = Array.isArray(node.child) && node.child.length > 0;
      const li = document.createElement("li");
      li.className = "nav-item";

      if (hasChildren) {
        const collapseId = `submenu-${Math.random().toString(36).substr(2, 9)}`;
        li.innerHTML = `
          <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#${collapseId}">
            <span class="me-2">${node.svg_icon ?? ""}</span>
            <span class="menu-name">${node.name}</span>
            <span class="ms-auto small"><i class="bi bi-chevron-down"></i></span>
          </a>
          <div id="${collapseId}" class="collapse" data-bs-parent="#sidebar-menu">
            <ul class="nav flex-column ms-3 my-2"></ul>
          </div>
        `;

        const ul = li.querySelector("ul");
        node.child.forEach(child => ul.appendChild(renderNode(child)));
      } else {
        li.innerHTML = `
          <a href="${node.path || "#"}" class="nav-link d-flex align-items-center">
            <span class="me-2">${node.svg_icon ?? ""}</span>
            <span class="menu-name">${node.name}</span>
          </a>
        `;
      }

      return li;
    }

    menuItems.forEach(item => sidebarMenu.appendChild(renderNode(item)));
  }

  // 🚀 Boshlang‘ich yuklash
  loadMenu();
});
</script>

