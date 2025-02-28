@extends('layouts.ai')

@section('title', 'AI Assistant - MHRPCI Tools')

@section('content')
<style>
    .chat-container {
        max-width: 1200px;
        margin: 0 auto;
        height: calc(100vh - 4rem);
        display: flex;
        flex-direction: column;
    }

    .chat-header {
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .chat-header h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-color);
        margin-right: 1rem;
    }

    .chat-controls {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .control-button {
        padding: 0.5rem;
        background: var(--secondary-color);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        color: var(--text-muted);
        cursor: pointer;
        transition: var(--transition-base);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .control-button:hover {
        color: var(--text-color);
        border-color: var(--accent-color);
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        background: var(--secondary-color);
        border-radius: 0.75rem;
        margin-bottom: 1rem;
        scroll-behavior: smooth;
    }

    .message {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.3s ease-in-out;
        position: relative;
    }

    .message-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .message.user .message-avatar {
        background: var(--success-color);
    }

    .message-avatar i {
        color: white;
        font-size: 1.25rem;
    }

    .message-content {
        flex: 1;
        background: rgba(255, 255, 255, 0.05);
        padding: 1rem;
        border-radius: 0.5rem;
        border: 1px solid var(--border-color);
        position: relative;
    }

    .message.user .message-content {
        background: rgba(16, 185, 129, 0.05);
    }

    .message.ai .message-content {
        background: rgba(59, 130, 246, 0.05);
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        align-items: center;
    }

    .message-sender {
        font-weight: 500;
        color: var(--accent-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .message.user .message-sender {
        color: var(--success-color);
    }

    .message-time {
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .message-text {
        line-height: 1.6;
        color: var(--text-color);
        font-size: 0.9375rem;
    }

    .message-actions {
        position: absolute;
        right: 0.5rem;
        top: 0.5rem;
        display: none;
        gap: 0.5rem;
    }

    .message:hover .message-actions {
        display: flex;
    }

    .message-action-btn {
        padding: 0.25rem;
        background: var(--secondary-color);
        border: none;
        border-radius: 0.25rem;
        color: var(--text-muted);
        cursor: pointer;
        transition: var(--transition-base);
    }

    .message-action-btn:hover {
        color: var(--text-color);
        background: var(--accent-color);
    }

    .chat-input-container {
        position: relative;
        padding: 1rem;
        background: var(--secondary-color);
        border-radius: 0.75rem;
        border: 1px solid var(--border-color);
    }

    .chat-input-wrapper {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .chat-input {
        flex: 1;
        min-height: 60px;
        max-height: 200px;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        color: var(--text-color);
        font-family: inherit;
        resize: vertical;
        outline: none;
        transition: var(--transition-base);
        font-size: 0.9375rem;
        line-height: 1.6;
    }

    .chat-input:focus {
        border-color: var(--accent-color);
        background: rgba(255, 255, 255, 0.08);
    }

    .chat-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .action-button {
        padding: 0.75rem;
        background: var(--accent-color);
        border: none;
        border-radius: 0.5rem;
        color: white;
        cursor: pointer;
        transition: var(--transition-base);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-button:hover {
        background: var(--accent-hover);
    }

    .action-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .action-button i {
        font-size: 1.25rem;
    }

    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.875rem;
        padding: 0.5rem 0;
    }

    .typing-dots {
        display: flex;
        gap: 0.25rem;
    }

    .typing-dot {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: currentColor;
        animation: typingDot 1.4s infinite;
    }

    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typingDot {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-4px); }
    }

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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .chat-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .chat-controls {
            width: 100%;
            justify-content: space-between;
        }

        .message-actions {
            display: flex;
            position: static;
            margin-top: 0.5rem;
            justify-content: flex-end;
        }
    }

    @media (max-width: 480px) {
        .chat-input-wrapper {
            flex-direction: column;
        }

        .chat-actions {
            flex-direction: row;
            width: 100%;
        }

        .action-button {
            flex: 1;
        }
    }

    /* File Upload Styles */
    .file-upload-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.75);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .file-upload-overlay.active {
        display: flex;
    }

    .file-upload-container {
        background: var(--secondary-color);
        border-radius: 1rem;
        padding: 2rem;
        width: 90%;
        max-width: 600px;
        border: 1px solid var(--border-color);
    }

    .file-upload-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .file-upload-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-color);
    }

    .file-upload-close {
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        font-size: 1.5rem;
        padding: 0.5rem;
    }

    .file-upload-close:hover {
        color: var(--text-color);
    }

    .file-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .file-upload-area:hover {
        border-color: var(--accent-color);
        background: rgba(59, 130, 246, 0.05);
    }

    .file-upload-icon {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .file-upload-text {
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .file-upload-info {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .file-preview-container {
        margin-top: 1.5rem;
        display: none;
    }

    .file-preview-container.active {
        display: block;
    }

    .file-preview-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .file-preview-item {
        position: relative;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.05);
    }

    .file-preview-item-inner {
        padding: 0.75rem;
    }

    .file-preview-thumbnail {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 0.25rem;
        background: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    .file-preview-thumbnail i {
        font-size: 2rem;
        color: var(--text-muted);
    }

    .file-preview-thumbnail img,
    .file-preview-thumbnail video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-preview-thumbnail audio {
        width: 100%;
    }

    .file-preview-name {
        font-size: 0.875rem;
        color: var(--text-color);
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .file-preview-size {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    .file-preview-remove {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        background: var(--error-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: var(--transition-base);
    }

    .file-preview-item:hover .file-preview-remove {
        opacity: 1;
    }

    .file-upload-progress {
        margin-top: 1rem;
        display: none;
    }

    .file-upload-progress.active {
        display: block;
    }

    .progress-bar {
        width: 100%;
        height: 4px;
        background: var(--border-color);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: var(--accent-color);
        width: 0%;
        transition: width 0.3s ease;
    }

    .message-attachments {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .message-attachment {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.05);
    }

    .message-attachment-preview {
        width: 100%;
        height: 100px;
        object-fit: cover;
        background: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .message-attachment-info {
        padding: 0.75rem;
    }

    .message-attachment-name {
        font-size: 0.875rem;
        color: var(--text-color);
        margin-bottom: 0.25rem;
        word-break: break-all;
    }

    .message-attachment-size {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* Additional responsive styles */
    @media (max-width: 640px) {
        .file-preview-list {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }

        .message-attachments {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
    }
</style>

<!-- File Upload Overlay -->
<div class="file-upload-overlay" id="fileUploadOverlay">
    <div class="file-upload-container">
        <div class="file-upload-header">
            <h3 class="file-upload-title">Upload Files</h3>
            <button class="file-upload-close" id="fileUploadClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="file-upload-area" id="fileUploadArea">
            <input type="file" multiple accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xls,.xlsx,.txt" 
                   class="hidden" id="fileInput">
            <div class="file-upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div class="file-upload-text">
                Drag and drop files here or click to browse
            </div>
            <div class="file-upload-info">
                Supported files: Images, Videos, Audio, Documents (PDF, Word, Excel, Text)
            </div>
        </div>

        <div class="file-preview-container" id="filePreviewContainer">
            <div class="file-preview-list" id="filePreviewList"></div>
            <div class="file-upload-progress">
                <div class="progress-bar">
                    <div class="progress-bar-fill"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="chat-container">
    <div class="chat-header">
        <div class="chat-header-left">
            <h2>MHRPCI AI Assistant</h2>
        </div>
        <div class="chat-controls">
            <button class="control-button" id="clearChat">
                <i class="fas fa-trash-alt"></i>
                <span class="hidden sm:inline">Clear Chat</span>
            </button>
            <button class="control-button" id="exportChat">
                <i class="fas fa-download"></i>
                <span class="hidden sm:inline">Export Chat</span>
            </button>
            <button class="control-button" id="toggleMode">
                <i class="fas fa-moon"></i>
                <span class="hidden sm:inline">Toggle Mode</span>
            </button>
        </div>
    </div>

    <div class="chat-messages" id="chat-messages">
        <div class="message ai">
            <div class="message-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="message-content">
                <div class="message-header">
                    <span class="message-sender">
                        <i class="fas fa-shield-alt"></i>
                        AI Assistant
                    </span>
                    <span class="message-time">Just now</span>
                </div>
                <div class="message-text">
                    Hello! I'm your AI assistant. I'm here to help you with any questions or tasks you have. How can I assist you today?
                </div>
                <div class="message-actions">
                    <button class="message-action-btn" title="Copy message">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button class="message-action-btn" title="Save response">
                        <i class="fas fa-bookmark"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form class="chat-input-container" id="chat-form">
        <div class="chat-input-wrapper">
            <textarea 
                class="chat-input" 
                placeholder="Type your message here... (Press Enter to send, Shift + Enter for new line)" 
                rows="1" 
                id="user-input"
            ></textarea>
            <div class="chat-actions">
                <button type="button" class="action-button" title="Attach file" id="attachButton">
                    <i class="fas fa-paperclip"></i>
                </button>
                <button type="submit" class="action-button" title="Send message" id="sendButton">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
        <div class="typing-indicator hidden" id="typingIndicator">
            <span>AI is typing</span>
            <div class="typing-dots">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('user-input');
    const chatMessages = document.getElementById('chat-messages');
    const sendButton = document.getElementById('sendButton');
    const typingIndicator = document.getElementById('typingIndicator');
    const clearChatButton = document.getElementById('clearChat');
    const exportChatButton = document.getElementById('exportChat');
    const toggleModeButton = document.getElementById('toggleMode');

    let isProcessing = false;

    // Auto-resize textarea
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
        sendButton.disabled = this.value.trim().length === 0;
    });

    // Handle Enter key
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!isProcessing && this.value.trim()) {
                chatForm.dispatchEvent(new Event('submit'));
            }
        }
    });

    // Handle form submission
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        
        if (message && !isProcessing) {
            isProcessing = true;
            sendButton.disabled = true;
            
            // Add user message
            addMessage('User', message, 'user');
            
            // Clear input and reset height
            chatInput.value = '';
            chatInput.style.height = 'auto';
            
            // Show typing indicator
            typingIndicator.classList.remove('hidden');
            
            try {
                // Simulate AI response (replace with actual API call)
                await new Promise(resolve => setTimeout(resolve, 1500));
                addMessage('AI Assistant', 'I received your message: ' + message, 'ai');
            } catch (error) {
                console.error('Error:', error);
                addMessage('AI Assistant', 'Sorry, there was an error processing your request.', 'ai', true);
            } finally {
                typingIndicator.classList.add('hidden');
                isProcessing = false;
                sendButton.disabled = false;
                chatInput.focus();
            }
        }
    });

    // Clear chat
    clearChatButton.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear the chat history?')) {
            const initialMessage = chatMessages.firstElementChild;
            chatMessages.innerHTML = '';
            chatMessages.appendChild(initialMessage);
        }
    });

    // Export chat
    exportChatButton.addEventListener('click', function() {
        const messages = Array.from(chatMessages.children).map(msg => {
            const sender = msg.querySelector('.message-sender').textContent.trim();
            const text = msg.querySelector('.message-text').textContent.trim();
            const time = msg.querySelector('.message-time').textContent.trim();
            return `${sender} (${time}):\n${text}\n`;
        }).join('\n');

        const blob = new Blob([messages], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'chat-history.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

    // Copy message
    document.addEventListener('click', function(e) {
        if (e.target.closest('.message-action-btn')) {
            const btn = e.target.closest('.message-action-btn');
            if (btn.title === 'Copy message') {
                const text = btn.closest('.message-content').querySelector('.message-text').textContent;
                navigator.clipboard.writeText(text).then(() => {
                    const originalTitle = btn.title;
                    btn.title = 'Copied!';
                    setTimeout(() => btn.title = originalTitle, 2000);
                });
            }
        }
    });

    function addMessage(sender, text, type, isError = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        
        const avatar = type === 'ai' ? 'fa-robot' : 'fa-user';
        const senderIcon = type === 'ai' ? 'fa-shield-alt' : 'fa-user-circle';
        
        messageDiv.innerHTML = `
            <div class="message-avatar">
                <i class="fas ${avatar}"></i>
            </div>
            <div class="message-content ${isError ? 'error' : ''}">
                <div class="message-header">
                    <span class="message-sender">
                        <i class="fas ${senderIcon}"></i>
                        ${sender}
                    </span>
                    <span class="message-time">${new Date().toLocaleTimeString()}</span>
                </div>
                <div class="message-text">${text}</div>
                <div class="message-actions">
                    <button class="message-action-btn" title="Copy message">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button class="message-action-btn" title="Save response">
                        <i class="fas fa-bookmark"></i>
                    </button>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // File Upload Handling
    const fileUploadOverlay = document.getElementById('fileUploadOverlay');
    const fileUploadClose = document.getElementById('fileUploadClose');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('fileInput');
    const filePreviewContainer = document.getElementById('filePreviewContainer');
    const filePreviewList = document.getElementById('filePreviewList');
    const attachButton = document.getElementById('attachButton');
    
    let uploadedFiles = new Map();

    // Show file upload overlay
    attachButton.addEventListener('click', function() {
        fileUploadOverlay.classList.add('active');
    });

    // Close file upload overlay
    fileUploadClose.addEventListener('click', function() {
        fileUploadOverlay.classList.remove('active');
    });

    // Handle drag and drop
    fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = getComputedStyle(document.documentElement).getPropertyValue('--accent-color');
    });

    fileUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = getComputedStyle(document.documentElement).getPropertyValue('--border-color');
    });

    fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = getComputedStyle(document.documentElement).getPropertyValue('--border-color');
        handleFiles(e.dataTransfer.files);
    });

    // Handle file input change
    fileUploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (validateFile(file)) {
                uploadedFiles.set(generateFileId(), file);
                displayFilePreview(file);
            }
        });

        if (uploadedFiles.size > 0) {
            filePreviewContainer.classList.add('active');
        }
    }

    function validateFile(file) {
        const maxSize = 50 * 1024 * 1024; // 50MB
        const allowedTypes = [
            'image/',
            'video/',
            'audio/',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain'
        ];

        if (file.size > maxSize) {
            alert('File is too large. Maximum size is 50MB.');
            return false;
        }

        if (!allowedTypes.some(type => file.type.startsWith(type))) {
            alert('File type not supported.');
            return false;
        }

        return true;
    }

    function displayFilePreview(file) {
        const fileId = generateFileId();
        const preview = document.createElement('div');
        preview.className = 'file-preview-item';
        preview.dataset.fileId = fileId;

        const thumbnail = createThumbnail(file);
        const fileInfo = createFileInfo(file);
        const removeButton = createRemoveButton(fileId);

        preview.innerHTML = `
            <div class="file-preview-item-inner">
                ${thumbnail}
                ${fileInfo}
            </div>
        `;
        preview.appendChild(removeButton);
        filePreviewList.appendChild(preview);
    }

    function createThumbnail(file) {
        if (file.type.startsWith('image/')) {
            return `<div class="file-preview-thumbnail">
                <img src="${URL.createObjectURL(file)}" alt="Preview">
            </div>`;
        } else if (file.type.startsWith('video/')) {
            return `<div class="file-preview-thumbnail">
                <video src="${URL.createObjectURL(file)}" controls></video>
            </div>`;
        } else if (file.type.startsWith('audio/')) {
            return `<div class="file-preview-thumbnail">
                <audio src="${URL.createObjectURL(file)}" controls></audio>
            </div>`;
        } else {
            const icon = getFileIcon(file.type);
            return `<div class="file-preview-thumbnail">
                <i class="fas ${icon}"></i>
            </div>`;
        }
    }

    function createFileInfo(file) {
        return `
            <div class="file-preview-name">${file.name}</div>
            <div class="file-preview-size">${formatFileSize(file.size)}</div>
        `;
    }

    function createRemoveButton(fileId) {
        const button = document.createElement('button');
        button.className = 'file-preview-remove';
        button.innerHTML = '<i class="fas fa-times"></i>';
        button.addEventListener('click', () => removeFile(fileId));
        return button;
    }

    function removeFile(fileId) {
        uploadedFiles.delete(fileId);
        const element = document.querySelector(`[data-file-id="${fileId}"]`);
        if (element) {
            element.remove();
        }
        if (uploadedFiles.size === 0) {
            filePreviewContainer.classList.remove('active');
        }
    }

    function getFileIcon(type) {
        if (type.startsWith('image/')) return 'fa-image';
        if (type.startsWith('video/')) return 'fa-video';
        if (type.startsWith('audio/')) return 'fa-music';
        if (type.includes('pdf')) return 'fa-file-pdf';
        if (type.includes('word')) return 'fa-file-word';
        if (type.includes('excel')) return 'fa-file-excel';
        return 'fa-file';
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function generateFileId() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    // Modify the existing addMessage function to handle attachments
    const originalAddMessage = addMessage;
    addMessage = function(sender, text, type, isError = false, attachments = []) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        
        const avatar = type === 'ai' ? 'fa-robot' : 'fa-user';
        const senderIcon = type === 'ai' ? 'fa-shield-alt' : 'fa-user-circle';
        
        let attachmentsHTML = '';
        if (attachments.length > 0) {
            attachmentsHTML = `
                <div class="message-attachments">
                    ${attachments.map(file => `
                        <div class="message-attachment">
                            ${createThumbnail(file)}
                            <div class="message-attachment-info">
                                <div class="message-attachment-name">${file.name}</div>
                                <div class="message-attachment-size">${formatFileSize(file.size)}</div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }
        
        messageDiv.innerHTML = `
            <div class="message-avatar">
                <i class="fas ${avatar}"></i>
            </div>
            <div class="message-content ${isError ? 'error' : ''}">
                <div class="message-header">
                    <span class="message-sender">
                        <i class="fas ${senderIcon}"></i>
                        ${sender}
                    </span>
                    <span class="message-time">${new Date().toLocaleTimeString()}</span>
                </div>
                <div class="message-text">${text}</div>
                ${attachmentsHTML}
                <div class="message-actions">
                    <button class="message-action-btn" title="Copy message">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button class="message-action-btn" title="Save response">
                        <i class="fas fa-bookmark"></i>
                    </button>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    };

    // Modify the form submission to include files
    const originalSubmitHandler = chatForm.onsubmit;
    chatForm.onsubmit = async function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        const files = Array.from(uploadedFiles.values());
        
        if ((message || files.length > 0) && !isProcessing) {
            isProcessing = true;
            sendButton.disabled = true;
            
            // Add user message with attachments
            addMessage('User', message, 'user', false, files);
            
            // Clear input, files, and reset height
            chatInput.value = '';
            chatInput.style.height = 'auto';
            uploadedFiles.clear();
            filePreviewList.innerHTML = '';
            filePreviewContainer.classList.remove('active');
            fileUploadOverlay.classList.remove('active');
            
            // Show typing indicator
            typingIndicator.classList.remove('hidden');
            
            try {
                // Simulate AI response (replace with actual API call)
                await new Promise(resolve => setTimeout(resolve, 1500));
                const response = files.length > 0 
                    ? `I received your message and ${files.length} file(s). I'll process them right away.`
                    : `I received your message: ${message}`;
                addMessage('AI Assistant', response, 'ai');
            } catch (error) {
                console.error('Error:', error);
                addMessage('AI Assistant', 'Sorry, there was an error processing your request.', 'ai', true);
            } finally {
                typingIndicator.classList.add('hidden');
                isProcessing = false;
                sendButton.disabled = false;
                chatInput.focus();
            }
        }
    };
});
</script>
@endsection
