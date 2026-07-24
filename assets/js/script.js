/**
 * script.js - Enhanced Responsive Version
 * Ahmednagar Connect — frontend interactions with full responsive support
 * Handles: collapsible sidebar, mobile drawer, animated counters, progress bars,
 * touch events, responsive charts, and comprehensive mobile optimizations.
 */

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       RESPONSIVE UTILITIES - Detect device size & orientation
    ===================================================== */
    const responsive = {
        getWidth: () => Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
        getHeight: () => Math.max(document.documentElement.clientHeight, window.innerHeight || 0),
        isMobile: () => responsive.getWidth() <= 575,
        isTablet: () => responsive.getWidth() > 575 && responsive.getWidth() <= 991,
        isDesktop: () => responsive.getWidth() > 991,
        isLandscape: () => responsive.getHeight() < responsive.getWidth(),
        isPortrait: () => responsive.getHeight() >= responsive.getWidth()
    };

    /* =====================================================
       SIDEBAR TOGGLE - Desktop collapse & Mobile drawer
    ===================================================== */
    const sidebar = document.getElementById('acSidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const backdrop = document.createElement('div');
    backdrop.className = 'ac-sidebar-backdrop';
    backdrop.setAttribute('role', 'presentation');
    document.body.appendChild(backdrop);

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('mobile-open');
        backdrop.classList.remove('show');
        document.body.style.overflow = '';
    }

    function openSidebar() {
        if (sidebar) sidebar.classList.add('mobile-open');
        backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (responsive.isMobile() || responsive.isTablet()) {
                sidebar.classList.contains('mobile-open') ? closeSidebar() : openSidebar();
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });
    }

    backdrop.addEventListener('click', closeSidebar);

    // Auto-close sidebar on link click (mobile only)
    if (sidebar) {
        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (responsive.isMobile() || responsive.isTablet()) {
                    setTimeout(closeSidebar, 100);
                }
            });
        });
    }

    // Close on ESC key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && sidebar && sidebar.classList.contains('mobile-open')) {
            closeSidebar();
        }
    });

    // Handle resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (responsive.isDesktop()) {
                closeSidebar();
                if (sidebar) sidebar.classList.remove('collapsed');
            }
        }, 250);
    });

    /* =====================================================
       ANIMATED KPI COUNTERS - Intersection Observer
    ===================================================== */
    const counters = document.querySelectorAll('[data-counter]');
    const observerOptions = { threshold: 0.5 };

    const counterObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = 'true';
                animateCounter(entry.target);
            }
        });
    }, observerOptions);

    counters.forEach(counter => counterObserver.observe(counter));

    function animateCounter(el) {
        const target = parseFloat(el.getAttribute('data-counter')) || 0;
        const suffix = el.getAttribute('data-suffix') || '';
        const duration = 1200;
        const start = performance.now();

        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const value = Math.floor(eased * target);
            el.textContent = value + suffix;
            if (progress < 1) requestAnimationFrame(tick);
            else el.textContent = target + suffix;
        }
        requestAnimationFrame(tick);
    }

    /* =====================================================
       ANIMATED PROGRESS BARS - Intersection Observer
    ===================================================== */
    const progressBars = document.querySelectorAll('[data-progress]');
    
    const progressObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = 'true';
                setTimeout(() => {
                    entry.target.style.width = entry.target.getAttribute('data-progress') + '%';
                }, 50);
            }
        });
    }, observerOptions);

    progressBars.forEach(bar => progressObserver.observe(bar));

    /* =====================================================
       RESPONSIVE CHARTS - Auto-resize on viewport change
    ===================================================== */
    function resizeCharts() {
        const charts = document.querySelectorAll('canvas[id^="chart"]');
        charts.forEach(canvas => {
            if (canvas.chart && canvas.chart.resize) {
                canvas.chart.resize();
            }
        });
    }

    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resizeCharts, 250);
    });

    /* =====================================================
       SEARCH BAR - Enhanced for mobile
    ===================================================== */
    const searchInput = document.querySelector('.ac-header-search input');
    if (searchInput) {
        searchInput.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Search triggered');
            }
        });
        
        searchInput.addEventListener('focus', () => {
            if (responsive.isMobile()) closeSidebar();
        });
    }

    /* =====================================================
       GALLERY UPLOAD - File handling
    ===================================================== */
    const uploadTriggers = document.querySelectorAll('.upload-trigger');
    const photoInput = document.getElementById('photoInput');
    const documentInput = document.getElementById('documentInput');
    const uploadStatus = document.getElementById('uploadStatus');
    const selectedFilesList = document.getElementById('selectedFilesList');
    const openDriveBtn = document.getElementById('openDriveBtn');

    if (uploadTriggers.length) {
        uploadTriggers.forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                if (target === 'photoInput' && photoInput) photoInput.click();
                else if (target === 'documentInput' && documentInput) documentInput.click();
            });
        });
    }

    function updateSelectedFiles(input, label) {
        if (!input || !uploadStatus || !selectedFilesList) return;
        const files = Array.from(input.files || []);
        
        if (files.length === 0) {
            uploadStatus.textContent = 'No files selected yet.';
            selectedFilesList.innerHTML = '';
            return;
        }

        uploadStatus.textContent = `${label} ready to upload: ${files.length} file(s) selected.`;
        selectedFilesList.innerHTML = '';
        files.forEach(file => {
            const li = document.createElement('li');
            li.textContent = `${file.name} (${formatFileSize(file.size)})`;
            selectedFilesList.appendChild(li);
        });
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    if (photoInput) photoInput.addEventListener('change', function() { updateSelectedFiles(this, 'Photos'); });
    if (documentInput) documentInput.addEventListener('change', function() { updateSelectedFiles(this, 'Documents'); });
    if (openDriveBtn) openDriveBtn.addEventListener('click', () => {
        window.open('https://drive.google.com', '_blank', 'noopener,noreferrer');
    });

    /* =====================================================
       TOUCH DEVICE OPTIMIZATIONS
    ===================================================== */
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        document.body.classList.add('touch-device');
    }

    /* =====================================================
       ACCESSIBILITY - Expose responsive utilities
    ===================================================== */
    window.ResponsiveUtils = responsive;

});
