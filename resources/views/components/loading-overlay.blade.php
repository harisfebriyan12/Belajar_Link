{{-- This overlay will be shown on page load and during navigation --}}
<div id="loading-overlay" class="fixed inset-0 bg-white bg-opacity-75 z-50 flex items-center justify-center" style="display: none;">
    <div class="w-16 h-16 border-8 border-dashed rounded-full animate-spin border-blue-600"></div>
</div>

<style>
    /* This class on the body tag ensures the loader is visible on the initial page load */
    .loading-initial #loading-overlay {
        display: flex !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('loading-overlay');

    // Hide the initial loader once the page is fully parsed
    document.body.classList.remove('loading-initial');
    if (overlay) {
        overlay.style.display = 'none';
    }

    // Show loader when a user clicks a link to navigate
    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', function(e) {
            // Do not show loader for:
            // 1. Links opening in a new tab
            // 2. Links to anchors on the same page
            // 3. Javascript function calls
            // 4. Links with a 'no-loader' class for specific exceptions
            if (
                link.target === '_blank' ||
                link.getAttribute('href').startsWith('#') ||
                link.getAttribute('href').toLowerCase().startsWith('javascript:') ||
                link.classList.contains('no-loader')
            ) {
                return;
            }

            // Show the loader
            if (overlay) {
                overlay.style.display = 'flex';
            }
        });
    });

    // Hide loader if a user navigates back/forward in browser history
    window.addEventListener('pageshow', function(event) {
        if (event.persisted && overlay) {
            overlay.style.display = 'none';
        }
    });
});
</script>