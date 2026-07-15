document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.dashboard-wrapper');
    const sidebar = document.querySelector('.sidebar');
    const topbar = document.querySelector('.topbar');
    
    if (wrapper && sidebar && topbar) {
        // Create hamburger button dynamically
        const hamburger = document.createElement('button');
        hamburger.className = 'hamburger-btn d-md-none';
        hamburger.type = 'button';
        hamburger.innerHTML = '☰';
        
        // Find header container in topbar to prepend hamburger button next to page title
        const headerDiv = topbar.querySelector('div');
        if (headerDiv) {
            headerDiv.style.display = 'flex';
            headerDiv.style.alignItems = 'center';
            headerDiv.style.flexWrap = 'wrap';
            headerDiv.prepend(hamburger);
        } else {
            topbar.prepend(hamburger);
        }
        
        // Create overlay backdrop element
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        wrapper.appendChild(overlay);
        
        // Toggle function
        const toggleSidebar = () => {
            const isShown = sidebar.classList.contains('show');
            if (isShown) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                setTimeout(() => {
                    if (!sidebar.classList.contains('show')) {
                        overlay.style.display = 'none';
                    }
                }, 300); // Wait for transition duration
            } else {
                overlay.style.display = 'block';
                // Force reflow
                overlay.offsetHeight;
                sidebar.classList.add('show');
                overlay.classList.add('show');
            }
        };
        
        // Close function
        const closeSidebar = () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            setTimeout(() => {
                if (!sidebar.classList.contains('show')) {
                    overlay.style.display = 'none';
                }
            }, 300);
        };
        
        hamburger.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', closeSidebar);
        
        // Close sidebar if viewport is resized to desktop width
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
    }
});
