/* =====================================================
   AHMEDNAGAR CONNECT — Admin Dashboard Sidebar (Member 6)
   sidebar.js — collapse, submenu toggle, mobile drawer, active state
===================================================== */

document.addEventListener('DOMContentLoaded', function () {

  var sidebar        = document.getElementById('sidebar');
  var sidebarToggle   = document.getElementById('sidebarToggle');
  var mobileMenuBtn   = document.getElementById('mobileMenuBtn');
  var sidebarOverlay  = document.getElementById('sidebarOverlay');
  var masterDataItem  = document.getElementById('masterDataItem');
  var navItems        = document.querySelectorAll('.sidebar .nav-item');
  var submenuLinks    = document.querySelectorAll('.submenu-link');

  /* -------------------------------------------------
     1. Desktop collapse / expand
  ------------------------------------------------- */
  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function () {
      sidebar.classList.toggle('collapsed');
      // Close any open submenu when collapsing, so icons stay clean
      if (sidebar.classList.contains('collapsed')) {
        masterDataItem.classList.remove('open');
      }
    });
  }

  /* -------------------------------------------------
     2. Mobile drawer open / close
  ------------------------------------------------- */
  function openMobileSidebar() {
    sidebar.classList.add('mobile-open');
    sidebarOverlay.classList.add('visible');
  }

  function closeMobileSidebar() {
    sidebar.classList.remove('mobile-open');
    sidebarOverlay.classList.remove('visible');
  }

  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', openMobileSidebar);
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', closeMobileSidebar);
  }

  /* -------------------------------------------------
     3. Master Data submenu toggle
  ------------------------------------------------- */
  if (masterDataItem) {
    var toggleLink = masterDataItem.querySelector('.submenu-toggle');
    toggleLink.addEventListener('click', function (e) {
      e.preventDefault();

      // If sidebar is collapsed, expand it first so the submenu is visible
      if (sidebar.classList.contains('collapsed')) {
        sidebar.classList.remove('collapsed');
      }
      masterDataItem.classList.toggle('open');
    });
  }

  /* -------------------------------------------------
     4. Active state handling — top-level items
  ------------------------------------------------- */
  navItems.forEach(function (item) {
    var link = item.querySelector(':scope > .nav-link');
    if (!link || link.classList.contains('submenu-toggle')) return;

    link.addEventListener('click', function () {
      navItems.forEach(function (i) { i.classList.remove('active'); });
      item.classList.add('active');
      // Collapse Master Data submenu when a different top-level item is chosen
      masterDataItem.classList.remove('open');
      closeMobileSidebar();
    });
  });

  /* -------------------------------------------------
     5. Active state handling — Master Data submenu links
  ------------------------------------------------- */
  submenuLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      submenuLinks.forEach(function (l) { l.classList.remove('active-sub'); });
      link.classList.add('active-sub');

      navItems.forEach(function (i) { i.classList.remove('active'); });
      closeMobileSidebar();
    });
  });

  /* -------------------------------------------------
     6. Keep layout correct on resize
  ------------------------------------------------- */
  window.addEventListener('resize', function () {
    if (window.innerWidth > 992) {
      closeMobileSidebar();
    }
  });

});
