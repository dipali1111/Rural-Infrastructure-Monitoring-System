/* =====================================================
   Ahmednagar Connect - Gram Panchayat Dashboard
   Script
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    var menuToggle = document.getElementById("menuToggle");
    var sidebar = document.getElementById("sidebar");
    var overlay = document.getElementById("sidebarOverlay");

    function openSidebar() {
        sidebar.classList.add("open");
        overlay.classList.add("active");
    }

    function closeSidebar() {
        sidebar.classList.remove("open");
        overlay.classList.remove("active");
    }

    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            if (sidebar.classList.contains("open")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener("click", closeSidebar);
    }

    // Close sidebar automatically when a menu link is clicked (mobile)
    var sidebarLinks = document.querySelectorAll(".sidebar-nav a");
    sidebarLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            if (window.innerWidth <= 992) {
                closeSidebar();
            }
        });
    });

    // Highlight active sidebar item on click
    var sidebarItems = document.querySelectorAll(".sidebar-nav li");
    sidebarItems.forEach(function (item) {
        item.addEventListener("click", function () {
            sidebarItems.forEach(function (i) {
                i.classList.remove("active");
            });
            item.classList.add("active");
        });
    });

    // Notification icon click (placeholder interaction)
    var notifBtn = document.querySelector(".icon-btn[title='Notifications']");
    if (notifBtn) {
        notifBtn.addEventListener("click", function () {
            alert("You have new notifications.");
        });
    }

    // Reset sidebar state on window resize back to desktop
    window.addEventListener("resize", function () {
        if (window.innerWidth > 992) {
            closeSidebar();
        }
    });

});
