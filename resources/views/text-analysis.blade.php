@extends('layouts.ai')

@section('title', 'Text Analysis - MHRPCI Tools')

@section('content')
<div class="text-analysis-container">
    <!-- Header Section -->
    <div class="analysis-header">
        <h1>MHRPCI Text Analysis</h1>
        <p class="text-muted">Advanced text analysis powered by AI - Grammar checking, style improvement, and more.</p>
    </div>

    <!-- Main Analysis Interface -->
    <div class="analysis-interface">
        <div class="chat-container">
            <!-- Analysis History -->
            <div class="analysis-history" id="analysisHistory">
                <!-- Messages will be dynamically inserted here -->
            </div>

            <!-- Input Form -->
            <form id="analysisForm" class="analysis-form">
                <div class="input-group">
                    <select id="analysisType" class="analysis-select">
                        <option value="grammar">Grammar Check</option>
                        <option value="style">Style Improvement</option>
                        <option value="tone">Tone Analysis</option>
                        <option value="summary">Text Summarization</option>
                        <option value="sentiment">Sentiment Analysis</option>
                    </select>
                    <textarea 
                        id="textInput" 
                        class="analysis-input" 
                        placeholder="Enter your text here for analysis..."
                        rows="4"
                    ></textarea>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-secondary" id="clearBtn">
                        <i class="fas fa-eraser"></i> Clear
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-bolt"></i> Analyze Text
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-analysis-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .analysis-header {
        margin-bottom: 2rem;
    }

    .analysis-header h1 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .analysis-interface {
        background: var(--secondary-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .chat-container {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 250px);
    }

    .analysis-history {
        flex: 1;
        padding: 1.5rem;
        overflow-y: auto;
    }

    .analysis-form {
        padding: 1.5rem;
        border-top: 1px solid var(--border-color);
        background: var(--primary-color);
    }

    .input-group {
        margin-bottom: 1rem;
    }

    .analysis-select {
        width: 100%;
        padding: 0.75rem;
        background: var(--secondary-color);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        color: var(--text-color);
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .analysis-input {
        width: 100%;
        padding: 1rem;
        background: var(--secondary-color);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        color: var(--text-color);
        resize: vertical;
        font-size: 0.875rem;
        min-height: 100px;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn-primary, .btn-secondary {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .btn-primary {
        background: var(--accent-color);
        color: var(--text-color);
        border: none;
    }

    .btn-primary:hover {
        background: var(--accent-hover);
    }

    .btn-secondary {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-color);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Message Styles */
    .message {
        margin-bottom: 1.5rem;
        padding: 1rem;
        border-radius: 0.5rem;
        background: var(--primary-color);
    }

    .message.user {
        background: var(--accent-color);
    }

    .message.assistant {
        background: var(--secondary-color);
        border: 1px solid var(--border-color);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const analysisForm = document.getElementById('analysisForm');
    const analysisHistory = document.getElementById('analysisHistory');
    const textInput = document.getElementById('textInput');
    const clearBtn = document.getElementById('clearBtn');

    analysisForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const text = textInput.value.trim();
        const analysisType = document.getElementById('analysisType').value;
        
        if (!text) return;

        // Add user message
        addMessage('user', text);

        // Simulate AI processing (replace with actual API call)
        const response = await analyzeText(text, analysisType);
        
        // Add AI response
        addMessage('assistant', response);
        
        // Clear input
        textInput.value = '';
    });

    clearBtn.addEventListener('click', function() {
        textInput.value = '';
        analysisHistory.innerHTML = '';
    });

    function addMessage(type, content) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.innerHTML = `
            <div class="message-content">
                <p>${content}</p>
            </div>
        `;
        analysisHistory.appendChild(messageDiv);
        analysisHistory.scrollTop = analysisHistory.scrollHeight;
    }

    // Simulate text analysis (replace with actual API implementation)
    async function analyzeText(text, type) {
        // Simulate API delay
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Return placeholder response based on analysis type
        const responses = {
            grammar: "Grammar analysis complete. Found no major issues.",
            style: "Style analysis suggests some improvements for clarity.",
            tone: "The text appears to have a professional tone.",
            summary: "Text has been summarized successfully.",
            sentiment: "Sentiment analysis indicates a positive tone."
        };
        
        return responses[type] || "Analysis complete.";
    }
});
</script>
@endsection 