@extends('layouts.ai')

@section('title', 'Document Scanner & Analyzer - MHRPCI Tools')

@section('content')
<div class="scanner-container">
    <!-- Header Section -->
    <div class="page-header">
        <h1 class="text-2xl font-bold mb-2">MHRPCI Document Scanner & Analyzer</h1>
        <p class="text-text-secondary mb-6">Upload and analyze documents using AI-powered text extraction and analysis</p>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Document Upload Section -->
        <div class="upload-section">
            <div class="upload-area" id="dropZone">
                <i class="fas fa-file-upload text-4xl mb-4"></i>
                <h3 class="font-semibold mb-2">Upload Document</h3>
                <p class="text-sm text-text-secondary mb-4">Drag & drop your files here or click to browse</p>
                <input type="file" id="fileInput" class="hidden" accept=".pdf,.doc,.docx,.txt,.png,.jpg,.jpeg">
                <button class="upload-btn">
                    <i class="fas fa-plus mr-2"></i>
                    Select File
                </button>
                <div class="mt-2 text-sm text-text-secondary">
                    Supported formats: PDF, DOC, DOCX, TXT, PNG, JPG
                </div>
            </div>

            <!-- Document Preview -->
            <div class="document-preview hidden" id="previewSection">
                <div class="preview-header">
                    <h3 class="font-semibold">Document Preview</h3>
                    <button class="clear-btn" id="clearDocument">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="preview-content" id="previewContent">
                    <!-- Preview content will be inserted here -->
                </div>
            </div>
        </div>

        <!-- Chat Interface Section -->
        <div class="chat-section">
            <div class="chat-container">
                <div class="chat-messages" id="chatMessages">
                    <!-- System Welcome Message -->
                    <div class="message system-message">
                        <div class="message-content">
                            <i class="fas fa-robot mr-2"></i>
                            <div>
                                <p>Hello! I'm your document analysis assistant. Upload a document and I'll help you analyze its content. You can ask me questions like:</p>
                                <ul class="suggestion-list">
                                    <li>• Summarize the main points</li>
                                    <li>• Extract key information</li>
                                    <li>• Analyze the document's tone</li>
                                    <li>• Find specific details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Input Form -->
                <form id="analysisForm" class="chat-input-form">
                    <div class="input-wrapper">
                        <textarea 
                            id="userPrompt" 
                            class="chat-input" 
                            placeholder="Ask about the document content..."
                            rows="1"
                            required
                        ></textarea>
                        <button type="submit" class="send-button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .scanner-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1rem;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1rem;
    }

    .upload-section, .chat-section {
        background: var(--secondary-color);
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .upload-area:hover {
        border-color: var(--accent-color);
        background: rgba(59, 130, 246, 0.1);
    }

    .upload-btn {
        background: var(--accent-color);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: var(--transition-base);
    }

    .upload-btn:hover {
        background: var(--accent-hover);
    }

    .document-preview {
        margin-top: 1.5rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: rgba(0, 0, 0, 0.2);
        border-bottom: 1px solid var(--border-color);
    }

    .preview-content {
        padding: 1rem;
        max-height: 400px;
        overflow-y: auto;
    }

    .chat-container {
        display: flex;
        flex-direction: column;
        height: 600px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .message {
        display: flex;
        margin-bottom: 1rem;
    }

    .message-content {
        background: rgba(0, 0, 0, 0.2);
        padding: 1rem;
        border-radius: 0.5rem;
        max-width: 80%;
    }

    .system-message .message-content {
        background: rgba(59, 130, 246, 0.1);
    }

    .suggestion-list {
        margin-top: 0.5rem;
        color: var(--text-secondary);
    }

    .suggestion-list li {
        margin-bottom: 0.25rem;
    }

    .chat-input-form {
        margin-top: auto;
        padding: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .input-wrapper {
        display: flex;
        gap: 0.5rem;
        align-items: flex-end;
    }

    .chat-input {
        flex: 1;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.75rem;
        color: var(--text-color);
        resize: none;
        max-height: 150px;
        min-height: 42px;
    }

    .chat-input:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .send-button {
        background: var(--accent-color);
        color: white;
        width: 42px;
        height: 42px;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-base);
    }

    .send-button:hover {
        background: var(--accent-hover);
    }

    .clear-btn {
        color: var(--text-secondary);
        padding: 0.25rem;
        transition: var(--transition-base);
    }

    .clear-btn:hover {
        color: var(--error-color);
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const previewSection = document.getElementById('previewSection');
    const previewContent = document.getElementById('previewContent');
    const clearDocument = document.getElementById('clearDocument');
    const analysisForm = document.getElementById('analysisForm');
    const chatMessages = document.getElementById('chatMessages');
    const userPrompt = document.getElementById('userPrompt');

    // Handle file selection
    dropZone.addEventListener('click', () => fileInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = 'var(--accent-color)';
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            // Show preview section
            previewSection.classList.remove('hidden');
            dropZone.classList.add('hidden');
            
            // Display file info
            previewContent.innerHTML = `
                <div class="file-info">
                    <p><strong>File Name:</strong> ${file.name}</p>
                    <p><strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB</p>
                    <p><strong>Type:</strong> ${file.type}</p>
                </div>
            `;

            // Here you would typically send the file to your backend for processing
            // and receive the extracted text for analysis
        }
    }

    // Clear document
    clearDocument.addEventListener('click', () => {
        previewSection.classList.add('hidden');
        dropZone.classList.remove('hidden');
        fileInput.value = '';
        previewContent.innerHTML = '';
    });

    // Handle chat form submission
    analysisForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const prompt = userPrompt.value.trim();
        
        if (prompt) {
            // Add user message
            addMessage('user', prompt);
            
            // Simulate AI response (replace with actual API call)
            setTimeout(() => {
                addMessage('system', 'I am analyzing your document based on your request: "' + prompt + '". Please note that this is a demonstration message. In a real implementation, this would be replaced with actual AI analysis of your document.');
            }, 1000);

            userPrompt.value = '';
        }
    });

    function addMessage(type, content) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}-message`;
        messageDiv.innerHTML = `
            <div class="message-content">
                ${type === 'system' ? '<i class="fas fa-robot mr-2"></i>' : ''}
                <p>${content}</p>
            </div>
        `;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Auto-resize textarea
    userPrompt.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
</script>
@endsection 