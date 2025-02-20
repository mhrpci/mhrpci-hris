@extends('layouts.ai')

@section('title', 'Document Converter - MHRPCI Tools')

@section('content')
<div class="converter-container">
    <!-- Header Section -->
    <div class="section-header">
        <h1>MHRPCI Document Converter</h1>
        <p class="subtitle">Convert, compress, and manage your documents with ease</p>
    </div>

    <!-- Main Tools Grid -->
    <div class="tools-grid">
        <!-- Convert to PDF Section -->
        <div class="tool-category">
            <h2>Convert to PDF</h2>
            <div class="tools-list">
                <div class="tool-card">
                    <i class="fas fa-file-word"></i>
                    <h3>Word to PDF</h3>
                    <p>Convert DOC/DOCX files to PDF format</p>
                    <label class="upload-btn" for="word-upload">
                        <input type="file" id="word-upload" accept=".doc,.docx" class="hidden">
                        <span>Select WORD file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-file-powerpoint"></i>
                    <h3>PowerPoint to PDF</h3>
                    <p>Convert PPT/PPTX presentations to PDF</p>
                    <label class="upload-btn" for="ppt-upload">
                        <input type="file" id="ppt-upload" accept=".ppt,.pptx" class="hidden">
                        <span>Select PPT file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-file-excel"></i>
                    <h3>Excel to PDF</h3>
                    <p>Convert XLS/XLSX spreadsheets to PDF</p>
                    <label class="upload-btn" for="excel-upload">
                        <input type="file" id="excel-upload" accept=".xls,.xlsx" class="hidden">
                        <span>Select EXCEL file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-image"></i>
                    <h3>Image to PDF</h3>
                    <p>Convert JPG, PNG, or other images to PDF</p>
                    <label class="upload-btn" for="image-upload">
                        <input type="file" id="image-upload" accept="image/*" multiple class="hidden">
                        <span>Select Images</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Convert from PDF Section -->
        <div class="tool-category">
            <h2>Convert from PDF</h2>
            <div class="tools-list">
                <div class="tool-card">
                    <i class="fas fa-file-pdf"></i>
                    <h3>PDF to Word</h3>
                    <p>Convert PDF to editable WORD format</p>
                    <label class="upload-btn" for="pdf-to-word">
                        <input type="file" id="pdf-to-word" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-file-pdf"></i>
                    <h3>PDF to PowerPoint</h3>
                    <p>Convert PDF to PPT presentation</p>
                    <label class="upload-btn" for="pdf-to-ppt">
                        <input type="file" id="pdf-to-ppt" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-file-pdf"></i>
                    <h3>PDF to Excel</h3>
                    <p>Convert PDF to EXCEL spreadsheet</p>
                    <label class="upload-btn" for="pdf-to-excel">
                        <input type="file" id="pdf-to-excel" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-file-pdf"></i>
                    <h3>PDF to Images</h3>
                    <p>Extract images or convert pages to JPG</p>
                    <label class="upload-btn" for="pdf-to-images">
                        <input type="file" id="pdf-to-images" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- PDF Tools Section -->
        <div class="tool-category">
            <h2>PDF Tools</h2>
            <div class="tools-list">
                <div class="tool-card">
                    <i class="fas fa-compress-arrows-alt"></i>
                    <h3>Compress PDF</h3>
                    <p>Reduce PDF file size while maintaining quality</p>
                    <label class="upload-btn" for="compress-pdf">
                        <input type="file" id="compress-pdf" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-object-group"></i>
                    <h3>Merge PDF</h3>
                    <p>Combine multiple PDFs into one file</p>
                    <label class="upload-btn" for="merge-pdf">
                        <input type="file" id="merge-pdf" accept=".pdf" multiple class="hidden">
                        <span>Select PDF files</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-cut"></i>
                    <h3>Split PDF</h3>
                    <p>Split PDF into separate files</p>
                    <label class="upload-btn" for="split-pdf">
                        <input type="file" id="split-pdf" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>

                <div class="tool-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Protect PDF</h3>
                    <p>Add password protection to PDF</p>
                    <label class="upload-btn" for="protect-pdf">
                        <input type="file" id="protect-pdf" accept=".pdf" class="hidden">
                        <span>Select PDF file</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Processing Modal -->
    <div id="processingModal" class="modal hidden">
        <div class="modal-content">
            <div class="loader"></div>
            <h3>Processing your file...</h3>
            <p>Please wait while we process your document</p>
        </div>
    </div>
</div>

<style>
    .converter-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .subtitle {
        color: var(--text-muted);
        font-size: 1.1rem;
    }

    .tool-category {
        margin-bottom: 3rem;
    }

    .tool-category h2 {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.5rem;
    }

    .tools-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .tool-card {
        background: var(--secondary-color);
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        transition: var(--transition-base);
        border: 1px solid var(--border-color);
    }

    .tool-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .tool-card i {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }

    .tool-card h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    .tool-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .upload-btn {
        display: inline-block;
        background: var(--accent-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .upload-btn:hover {
        background: var(--accent-hover);
    }

    .hidden {
        display: none;
    }

    /* Modal Styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: var(--secondary-color);
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
    }

    .loader {
        border: 4px solid var(--border-color);
        border-top: 4px solid var(--accent-color);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .converter-container {
            padding: 1rem;
        }

        .section-header h1 {
            font-size: 2rem;
        }

        .tools-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    const processingModal = document.getElementById('processingModal');

    fileInputs.forEach(input => {
        input.addEventListener('change', async function(e) {
            if (this.files.length > 0) {
                processingModal.classList.remove('hidden');

                // Create FormData object
                const formData = new FormData();
                for (let file of this.files) {
                    formData.append('files[]', file);
                }
                formData.append('conversion_type', this.id);

                try {
                    // Send files to server
                    const response = await fetch('/api/convert-document', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        // Handle successful conversion
                        if (data.downloadUrl) {
                            window.location.href = data.downloadUrl;
                        }
                    } else {
                        throw new Error('Conversion failed');
                    }
                } catch (error) {
                    alert('An error occurred during conversion. Please try again.');
                } finally {
                    processingModal.classList.add('hidden');
                    this.value = ''; // Reset file input
                }
            }
        });
    });
});
</script>
@endsection 