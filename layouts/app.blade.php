<!-- Add in the head section after SweetAlert2 CSS -->
<style>
    /* Base Toast Styles */
    .custom-toast {
        padding: 12px 16px !important;
        margin-top: 16px !important;
        margin-right: 16px !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        font-size: 14px !important;
        max-width: 356px !important;
        width: auto !important;
    }

    /* Light Mode Styles */
    @media (prefers-color-scheme: light) {
        .custom-toast {
            background: #ffffff !important;
            color: #333333 !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            border-left: 4px solid #28a745 !important;
        }

        .custom-toast .custom-toast-title {
            color: #333333 !important;
            font-weight: 500 !important;
        }

        .custom-toast-progress {
            background: rgba(40, 167, 69, 0.2) !important;
        }

        .custom-toast-progress:before {
            background-color: #28a745 !important;
        }

        /* Success Icon in Light Mode */
        .custom-toast .swal2-success-ring {
            border-color: #28a745 !important;
        }

        .custom-toast .swal2-success-line-tip,
        .custom-toast .swal2-success-line-long {
            background-color: #28a745 !important;
        }
    }

    /* Dark Mode Styles */
    @media (prefers-color-scheme: dark) {
        .custom-toast {
            background: #2d3748 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-left: 4px solid #2ecc71 !important;
        }

        .custom-toast .custom-toast-title {
            color: #ffffff !important;
            font-weight: 500 !important;
        }

        .custom-toast-progress {
            background: rgba(46, 204, 113, 0.2) !important;
        }

        .custom-toast-progress:before {
            background-color: #2ecc71 !important;
        }

        /* Success Icon in Dark Mode */
        .custom-toast .swal2-success-ring {
            border-color: #2ecc71 !important;
        }

        .custom-toast .swal2-success-line-tip,
        .custom-toast .swal2-success-line-long {
            background-color: #2ecc71 !important;
        }
    }

    /* Hover Effects */
    .custom-toast:hover {
        transform: translateY(-2px) !important;
        transition: transform 0.2s ease-in-out !important;
    }

    /* Animation */
    .custom-toast.swal2-show {
        animation: slide-in 0.3s ease-out !important;
    }

    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .custom-toast {
            max-width: calc(100vw - 32px) !important;
            margin: 8px !important;
            font-size: 13px !important;
        }
    }

    /* High Contrast Support */
    @media (forced-colors: active) {
        .custom-toast {
            border: 2px solid CanvasText !important;
        }
    }

    /* Ensure Icon Visibility */
    .custom-toast .swal2-icon {
        margin: 0 8px 0 0 !important;
        transform: scale(0.8) !important;
    }

    /* Toast Content Layout */
    .custom-toast .swal2-content {
        padding: 0 !important;
        margin: 0 !important;
    }

    .custom-toast .swal2-html-container {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
