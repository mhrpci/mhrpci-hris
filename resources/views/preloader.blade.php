<div id="preloader" class="preloader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
        </div>
        <h4 class="mt-3 loading-text">Loading<span class="loading-dots">...</span></h4>
    </div>
</div>

<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.98);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
    }

    .loader-content {
        text-align: center;
    }

    .mhr-loader {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #0056b3;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 28px;
        font-weight: bold;
        color: #0056b3;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .loading-text {
        color: #333;
        font-size: 18px;
        margin-top: 20px;
    }

    .loading-dots::after {
        content: '...';
        animation: dots 1.5s steps(4, end) infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes dots {
        0%, 20% { content: '.'; }
        40% { content: '..'; }
        60% { content: '...'; }
        80%, 100% { content: ''; }
    }

    .fade-out {
        opacity: 0;
        visibility: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const preloader = document.getElementById('preloader');

        // Fade out the preloader
        function hidePreloader() {
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }

        // Hide preloader when the page is fully loaded
        window.addEventListener('load', hidePreloader);

        // Fallback: Hide preloader after 5 seconds if the page takes too long to load
        setTimeout(hidePreloader, 5000);
    });
</script>
