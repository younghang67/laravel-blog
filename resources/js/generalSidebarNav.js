document.addEventListener("DOMContentLoaded", () => {
  const opnBtn = document.getElementById("general-nav-menu-open-btn");
  const clsBtn = document.getElementById("general-nav-menu-close-btn");
  const sidebarMenu = document.getElementById("general-sidebar-menu");
  const sidebarNav = document.getElementById("general-sidebar-nav");

  if (!opnBtn || !clsBtn || !sidebarMenu || !sidebarNav) return;

  const showMenuNav = () => {
    sidebarNav.classList.add("open");
  };

  opnBtn.addEventListener("click", () => {
    sidebarMenu.classList.add("open");
    setTimeout(showMenuNav, 200);
  });

  clsBtn.addEventListener("click", () => {
    sidebarMenu.classList.remove("open");
    sidebarNav.classList.remove("open");
  });
});
