@extends('layouts.ai')

@section('title', 'Media Converter - MHRPCI Tools')

@section('content')
<div class="converter-container">
    <div class="page-header">
        <h1>MHRPCI Media Converter</h1>
        <p class="text-muted">Convert YouTube videos to downloadable video/audio formats</p>
    </div>

    <div class="converter-card">
        <!-- URL Input Section -->
        <div class="input-section">
            <form id="convertForm" class="url-form">
                @csrf
                <div class="form-group">
                    <label for="videoUrl">
                        <i class="fas fa-link"></i>
                        YouTube URL
                    </label>
                    <div class="input-group">
                        <input type="url" 
                               id="videoUrl" 
                               name="videoUrl" 
                               class="form-control" 
                               placeholder="Paste YouTube URL here (e.g., https://www.youtube.com/watch?v=...)" 
                               required
                               pattern="^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$"
                               title="Please enter a valid YouTube URL">
                        <button type="submit" class="submit-btn" id="fetchButton">
                            <i class="fas fa-search"></i>
                            <span>Fetch Video</span>
                        </button>
                    </div>
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle"></i>
                        Supports YouTube videos and playlists
                    </small>
                </div>
            </form>
        </div>

        <!-- Video Information Section -->
        <div id="videoInfo" class="video-info hidden">
            <div class="video-preview">
                <div class="thumbnail-container">
                    <img id="thumbnail" src="" alt="Video thumbnail" class="thumbnail">
                    <div class="duration-badge" id="videoDuration"></div>
                </div>
                <div class="video-details">
                    <h3 id="videoTitle" class="video-title"></h3>
                    <div class="video-meta">
                        <span class="quality-info">
                            <i class="fas fa-film"></i>
                            Available in multiple qualities
                        </span>
                        <span class="format-info">
                            <i class="fas fa-file-audio"></i>
                            Audio extraction available
                        </span>
                    </div>
                </div>
            </div>

            <!-- Download Options Section -->
            <div class="download-options">
                <h4>
                    <i class="fas fa-download"></i>
                    Download Options
                </h4>
                <div class="options-grid">
                    <!-- Video Download Card -->
                    <div class="option-card">
                        <div class="option-header">
                            <i class="fas fa-video"></i>
                            <h5>Video Format</h5>
                        </div>
                        <div class="option-content">
                            <select id="videoQuality" class="quality-select">
                                <option value="">Select Video Quality</option>
                            </select>
                            <button class="download-btn" onclick="downloadVideo()" id="downloadVideoBtn" disabled>
                                <i class="fas fa-download"></i>
                                <span>Download Video</span>
                            </button>
                            <small class="format-note">
                                <i class="fas fa-info-circle"></i>
                                Includes both video and audio
                            </small>
                        </div>
                    </div>

                    <!-- Audio Download Card -->
                    <div class="option-card">
                        <div class="option-header">
                            <i class="fas fa-music"></i>
                            <h5>Audio Format</h5>
                        </div>
                        <div class="option-content">
                            <select id="audioQuality" class="quality-select">
                                <option value="">Select Audio Quality</option>
                            </select>
                            <button class="download-btn" onclick="downloadAudio()" id="downloadAudioBtn" disabled>
                                <i class="fas fa-download"></i>
                                <span>Download Audio</span>
                            </button>
                            <small class="format-note">
                                <i class="fas fa-info-circle"></i>
                                High-quality MP3 format
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" class="loading hidden">
            <div class="spinner"></div>
            <p class="loading-text">Processing your request...</p>
            <small class="loading-subtext">This may take a few moments</small>
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="error-message hidden">
            <i class="fas fa-exclamation-circle"></i>
            <span class="error-text"></span>
            <button class="error-dismiss" onclick="dismissError()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Instructions Section -->
    <div class="instructions-section">
        <h4>
            <i class="fas fa-question-circle"></i>
            How to Use
        </h4>
        <ol class="instruction-steps">
            <li>Paste a valid YouTube video URL in the input field above</li>
            <li>Click "Fetch Video" to load available download options</li>
            <li>Select your preferred quality for video or audio</li>
            <li>Click the download button to start downloading</li>
        </ol>
        <div class="usage-notes">
            <p>
                <i class="fas fa-shield-alt"></i>
                <strong>Note:</strong> This tool is for personal use only. Please respect YouTube's terms of service and copyright laws.
            </p>
        </div>
    </div>
</div>

<style>
    /* Container Styles */
    .converter-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header Styles */
    .page-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, var(--accent-color), var(--accent-hover));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Card Styles */
    .converter-card {
        background: var(--secondary-color);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        margin-bottom: 2rem;
    }

    /* Form Styles */
    .input-section {
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-color);
    }

    .input-group {
        display: flex;
        gap: 1rem;
    }

    .form-control {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        background: var(--primary-color);
        color: var(--text-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: var(--transition-base);
    }

    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .submit-btn {
        padding: 0.75rem 1.5rem;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: var(--transition-base);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .submit-btn:hover {
        background: var(--accent-hover);
        transform: translateY(-1px);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* Video Info Styles */
    .video-info {
        border-top: 1px solid var(--border-color);
        padding-top: 2rem;
        animation: fadeIn 0.3s ease-out;
    }

    .video-preview {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .thumbnail-container {
        position: relative;
        flex-shrink: 0;
    }

    .thumbnail {
        width: 280px;
        border-radius: 0.5rem;
        object-fit: cover;
        box-shadow: var(--shadow-md);
    }

    .duration-badge {
        position: absolute;
        bottom: 0.5rem;
        right: 0.5rem;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }

    .video-details {
        flex: 1;
    }

    .video-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        line-height: 1.4;
        color: var(--text-color);
    }

    .video-meta {
        display: flex;
        gap: 1rem;
        color: var(--text-muted);
        font-size: 0.875rem;
    }

    .video-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Download Options Styles */
    .download-options {
        margin-top: 2rem;
    }

    .download-options h4 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .option-card {
        background: var(--primary-color);
        padding: 1.5rem;
        border-radius: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        transition: var(--transition-base);
    }

    .option-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .option-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--accent-color);
    }

    .option-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .quality-select {
        padding: 0.75rem;
        background: var(--secondary-color);
        border: 1px solid var(--border-color);
        color: var(--text-color);
        border-radius: 0.5rem;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .quality-select:focus {
        border-color: var(--accent-color);
    }

    .download-btn {
        padding: 0.75rem;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: var(--transition-base);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .download-btn:disabled {
        background: var(--border-color);
        cursor: not-allowed;
        opacity: 0.7;
    }

    .download-btn:not(:disabled):hover {
        background: var(--accent-hover);
        transform: translateY(-1px);
    }

    .format-note {
        color: var(--text-muted);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Loading Styles */
    .loading {
        text-align: center;
        padding: 2rem;
        animation: fadeIn 0.3s ease-out;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid var(--border-color);
        border-top-color: var(--accent-color);
        border-radius: 50%;
        margin: 0 auto 1rem;
        animation: spin 1s linear infinite;
    }

    .loading-text {
        color: var(--text-color);
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .loading-subtext {
        color: var(--text-muted);
    }

    /* Error Message Styles */
    .error-message {
        padding: 1rem;
        background: rgba(239, 68, 68, 0.1);
        color: var(--error-color);
        border-radius: 0.5rem;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: fadeIn 0.3s ease-out;
    }

    .error-text {
        flex: 1;
    }

    .error-dismiss {
        background: none;
        border: none;
        color: var(--error-color);
        cursor: pointer;
        padding: 0.25rem;
        opacity: 0.7;
        transition: var(--transition-base);
    }

    .error-dismiss:hover {
        opacity: 1;
    }

    /* Instructions Section Styles */
    .instructions-section {
        background: var(--secondary-color);
        border-radius: 1rem;
        padding: 2rem;
        margin-top: 2rem;
    }

    .instructions-section h4 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        color: var(--text-color);
    }

    .instruction-steps {
        list-style-position: inside;
        margin-bottom: 1.5rem;
    }

    .instruction-steps li {
        margin-bottom: 0.75rem;
        color: var(--text-secondary);
    }

    .usage-notes {
        padding: 1rem;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 0.5rem;
    }

    .usage-notes p {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-color);
        margin: 0;
    }

    /* Utility Classes */
    .hidden {
        display: none !important;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .converter-container {
            padding: 1rem;
        }

        .video-preview {
            flex-direction: column;
        }

        .thumbnail-container {
            width: 100%;
        }

        .thumbnail {
            width: 100%;
            height: auto;
        }

        .input-group {
            flex-direction: column;
        }

        .submit-btn {
            width: 100%;
            justify-content: center;
        }

        .options-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .converter-card {
            padding: 1.5rem;
        }

        .video-meta {
            flex-direction: column;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const convertForm = document.getElementById('convertForm');
    const videoInfo = document.getElementById('videoInfo');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const errorMessage = document.getElementById('errorMessage');
    const videoQualitySelect = document.getElementById('videoQuality');
    const audioQualitySelect = document.getElementById('audioQuality');
    const downloadVideoBtn = document.getElementById('downloadVideoBtn');
    const downloadAudioBtn = document.getElementById('downloadAudioBtn');
    const fetchButton = document.getElementById('fetchButton');

    // Form submission handler
    convertForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const videoUrl = document.getElementById('videoUrl').value;
        if (!videoUrl) return;

        // Validate YouTube URL
        const youtubeUrlPattern = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/;
        if (!youtubeUrlPattern.test(videoUrl)) {
            showError('Please enter a valid YouTube URL');
            return;
        }

        // Update UI state
        setLoadingState(true);
        hideError();

        try {
            const response = await fetch('/api/media/fetch-info', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ url: videoUrl })
            });

            const data = await response.json();

            if (!response.ok) throw new Error(data.message || 'Failed to fetch video info');

            // Update video information
            updateVideoInfo(data);
            
            // Show video info section
            videoInfo.classList.remove('hidden');
        } catch (error) {
            showError(error.message);
        } finally {
            setLoadingState(false);
        }
    });

    // Quality select change handlers
    videoQualitySelect.addEventListener('change', function() {
        downloadVideoBtn.disabled = !this.value;
    });

    audioQualitySelect.addEventListener('change', function() {
        downloadAudioBtn.disabled = !this.value;
    });

    // Helper functions
    function setLoadingState(isLoading) {
        fetchButton.disabled = isLoading;
        loadingIndicator.classList.toggle('hidden', !isLoading);
        if (isLoading) {
            videoInfo.classList.add('hidden');
        }
    }

    function showError(message) {
        errorMessage.querySelector('.error-text').textContent = message;
        errorMessage.classList.remove('hidden');
    }

    function hideError() {
        errorMessage.classList.add('hidden');
    }

    function updateVideoInfo(data) {
        document.getElementById('thumbnail').src = data.thumbnail;
        document.getElementById('videoTitle').textContent = data.title;
        document.getElementById('videoDuration').textContent = data.duration;

        // Populate quality options
        populateQualityOptions(videoQualitySelect, data.videoFormats);
        populateQualityOptions(audioQualitySelect, data.audioFormats);

        // Reset download buttons
        downloadVideoBtn.disabled = true;
        downloadAudioBtn.disabled = true;
    }
});

function populateQualityOptions(select, formats) {
    select.innerHTML = '<option value="">Select Quality</option>';
    formats.forEach(format => {
        const option = document.createElement('option');
        option.value = format.formatId;
        option.textContent = format.quality;
        select.appendChild(option);
    });
}

function dismissError() {
    document.getElementById('errorMessage').classList.add('hidden');
}

async function downloadVideo() {
    const formatId = document.getElementById('videoQuality').value;
    if (!formatId) return;
    
    const videoUrl = document.getElementById('videoUrl').value;
    initiateDownload('video', videoUrl, formatId);
}

async function downloadAudio() {
    const formatId = document.getElementById('audioQuality').value;
    if (!formatId) return;
    
    const videoUrl = document.getElementById('videoUrl').value;
    initiateDownload('audio', videoUrl, formatId);
}

function initiateDownload(type, url, format) {
    const downloadUrl = `/api/media/download?url=${encodeURIComponent(url)}&format=${format}&type=${type}`;
    window.location.href = downloadUrl;
}
</script>
@endsection