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

  async function loadMenu() {
    try {
      const response = await fetch(baseUrl + "/proxy/menu", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": token,
          "Content-Type": "application/json",
        },
        credentials: "include"
      });

      const data = await response.json();
      console.log("📦 API menu data:", data);

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

  function renderMenu(menuData) {
    sidebarMenu.innerHTML = "";

    Object.values(menuData).forEach((item, index) => {
      const hasChildren = item.child && item.child.length > 0;
      const li = document.createElement("li");
      li.classList.add("nav-item");

      if (hasChildren) {
        const collapseId = `collapse-${index}`;
        li.innerHTML = `
          <a href="#${collapseId}" 
             class="nav-link d-flex align-items-center" 
             data-bs-toggle="collapse" 
             role="button" 
             aria-expanded="false" 
             aria-controls="${collapseId}">
            <span class="me-2">${item.svg_icon ?? ''}</span>
            <span class="menu-name">${item.name}</span>
            <span class="ms-auto small"><i class="bi bi-chevron-down"></i></span>
          </a>
          <div class="collapse" id="${collapseId}">
            <ul class="nav flex-column ms-3 my-2"></ul>
          </div>
        `;

        const ul = li.querySelector("ul");
        item.child.forEach(child => {
          const childLi = document.createElement("li");
          childLi.classList.add("nav-item");
          childLi.innerHTML = `
            <a href="${child.path}" class="nav-link d-flex align-items-center">
              <span class="menu-name">${child.name}</span>
            </a>
          `;
          ul.appendChild(childLi);
        });
      } else {
        li.innerHTML = `
          <a href="${item.path}" class="nav-link d-flex align-items-center">
            <span class="me-2">${item.svg_icon ?? ''}</span>
            <span class="menu-name">${item.name}</span>
          </a>
        `;
      }

      return li;
    }

    menuItems.forEach(item => sidebarMenu.appendChild(renderNode(item)));
  }

  loadMenu();
});
</script>

