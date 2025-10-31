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
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');

  async function loadMenu() {
    try {
      const response = await fetch(baseUrl + "/proxy/menu", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": token,
          "Content-Type": "application/json"
        },
        credentials: "include"
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
             class="nav-link d-flex align-items-center justify-content-between" 
             data-bs-toggle="collapse" 
             role="button" 
             aria-expanded="false" 
             aria-controls="${collapseId}">
            <span class="d-flex align-items-center">
              <span class="me-2">${item.svg_icon ?? ''}</span>
              <span class="menu-name">${item.name}</span>
            </span>
            <i class="bi bi-chevron-down small"></i>
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

<<<<<<< HEAD
    function renderLeaf(item) {
      const a = document.createElement('a');
      a.className = 'nav-link d-flex align-items-center';
      a.href = item.path || '#';
      a.innerHTML = `
        <span class="me-2">${item.svg_icon ?? ''}</span>
        <span class="menu-name">${item.name}</span>`;
      const li = document.createElement('li');
      li.className = 'nav-item';
      li.appendChild(a);
      return li;
    }

    // Render roots (pid null/0)
    (idToChildren.get(0) || idToChildren.get(null) || [])
      .forEach(root => sidebarMenu.appendChild(renderNode(root)));

    const staticTab = document.createElement("li");
    staticTab.className = "nav-item";
    staticTab.innerHTML = `
      <a href="/custom-tab" class="nav-link d-flex align-items-center">
        <span class="me-2"><i class="bi bi-star"></i></span>
        <span class="menu-name">Xodimlar</span>
      </a>`;
    sidebarMenu.appendChild(staticTab);

=======
      sidebarMenu.appendChild(li); // <---- BU juda muhim!
    });
>>>>>>> master
      sidebarMenu.appendChild(li); // <---- BU juda muhim!
    });
  }

  loadMenu();
});
</script>
