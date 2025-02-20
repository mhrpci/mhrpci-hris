@extends('layouts.ai')

@section('title', 'MHRPCI Tools - AI Image Generator')

@section('content')
<div class="image-generator-container">
    <!-- Header Section -->
    <div class="page-header">
        <h1>MHRPCI AI Image Generator</h1>
        <p class="text-muted">Create unique images using AI-powered text prompts</p>
    </div>

    <!-- Main Generation Form -->
    <div class="generation-form-container">
        <form id="imageGenerationForm" class="generation-form">
            @csrf
            <div class="form-group">
                <label for="prompt">Image Description</label>
                <textarea 
                    id="prompt" 
                    name="prompt" 
                    class="prompt-input" 
                    placeholder="Describe the image you want to generate... (e.g., 'A serene sunset over mountains with a lake reflection')"
                    required
                ></textarea>
            </div>

            <div class="form-options">
                <div class="option-group">
                    <label for="size">Image Size</label>
                    <select id="size" name="size" class="select-input">
                        <option value="256x256">256 x 256</option>
                        <option value="512x512">512 x 512</option>
                        <option value="1024x1024" selected>1024 x 1024</option>
                    </select>
                </div>

                <div class="option-group">
                    <label for="style">Art Style</label>
                    <select id="style" name="style" class="select-input">
                        <option value="realistic">Realistic</option>
                        <option value="artistic">Artistic</option>
                        <option value="digital-art">Digital Art</option>
                        <option value="photography">Photography</option>
                        <option value="cartoon">Cartoon</option>
                    </select>
                </div>

                <div class="option-group">
                    <label for="number">Number of Images</label>
                    <select id="number" name="number" class="select-input">
                        <option value="1">1 Image</option>
                        <option value="2">2 Images</option>
                        <option value="3">3 Images</option>
                        <option value="4">4 Images</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="generate-button">
                <i class="fas fa-magic"></i>
                Generate Image
            </button>
        </form>
    </div>

    <!-- Results Section -->
    <div id="results" class="results-container hidden">
        <h2>Generated Images</h2>
        <div id="imageGrid" class="image-grid"></div>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="loading-state hidden">
        <div class="spinner"></div>
        <p>Generating your images...</p>
    </div>
</div>

<style>
    .image-generator-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .generation-form-container {
        background: var(--secondary-color);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-md);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .prompt-input {
        width: 100%;
        min-height: 100px;
        padding: 1rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--primary-color);
        color: var(--text-color);
        font-size: 1rem;
        resize: vertical;
    }

    .form-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .option-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .select-input {
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--primary-color);
        color: var(--text-color);
        font-size: 0.875rem;
    }

    .generate-button {
        width: 100%;
        padding: 1rem;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: var(--transition-base);
    }

    .generate-button:hover {
        background: var(--accent-hover);
    }

    .results-container {
        margin-top: 2rem;
    }

    .results-container h2 {
        margin-bottom: 1rem;
    }

    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .image-grid img {
        width: 100%;
        border-radius: 0.5rem;
        box-shadow: var(--shadow-md);
    }

    .loading-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding: 2rem;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid var(--border-color);
        border-top: 3px solid var(--accent-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .hidden {
        display: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('imageGenerationForm');
    const loadingState = document.getElementById('loadingState');
    const results = document.getElementById('results');
    const imageGrid = document.getElementById('imageGrid');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Show loading state
        loadingState.classList.remove('hidden');
        results.classList.add('hidden');

        // Get form data
        const formData = new FormData(form);

        try {
            // Replace with your actual API endpoint
            const response = await fetch('/api/generate-image', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const data = await response.json();

            // Handle the response
            if (data.success) {
                imageGrid.innerHTML = ''; // Clear previous results
                
                // Add generated images to the grid
                data.images.forEach(imageUrl => {
                    const img = document.createElement('img');
                    img.src = imageUrl;
                    img.alt = 'Generated image';
                    imageGrid.appendChild(img);
                });

                results.classList.remove('hidden');
            } else {
                alert('Error generating images. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        } finally {
            loadingState.classList.add('hidden');
        }
    });
});
</script>
@endsection 