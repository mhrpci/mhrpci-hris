@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="searchNews" class="form-control" placeholder="Search news...">
                <button class="btn btn-primary" type="button" onclick="searchNews()">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <select class="form-select" id="categoryFilter" onchange="filterByCategory()">
                <option value="">All Categories</option>
                <option value="business">Business</option>
                <option value="technology">Technology</option>
                <option value="sports">Sports</option>
                <option value="entertainment">Entertainment</option>
                <option value="health">Health</option>
                <option value="science">Science</option>
            </select>
        </div>
    </div>

    <!-- News Grid -->
    <div class="row" id="newsContainer">
        <!-- News cards will be dynamically inserted here -->
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-4">
        <button id="loadMore" class="btn btn-outline-primary d-none">
            Load More
        </button>
    </div>
</div>

@push('scripts')
<script>
const API_KEY = 'a8670770905e4fdda9ddf628f8d814aa';
let page = 1;
let currentSearch = '';
let currentCategory = '';

// Initial load
document.addEventListener('DOMContentLoaded', () => {
    fetchNews();
});

// Fetch news function
async function fetchNews(search = '', category = '') {
    try {
        let url = `https://newsapi.org/v2/top-headlines?country=us&apiKey=${API_KEY}`;
        
        if (search) {
            url = `https://newsapi.org/v2/everything?q=${search}&apiKey=${API_KEY}`;
        }
        
        if (category) {
            url = `https://newsapi.org/v2/top-headlines?category=${category}&country=us&apiKey=${API_KEY}`;
        }

        const response = await fetch(url);
        const data = await response.json();
        
        if (page === 1) {
            document.getElementById('newsContainer').innerHTML = '';
        }

        renderNews(data.articles);
        
        // Show/hide load more button based on results
        const loadMoreBtn = document.getElementById('loadMore');
        loadMoreBtn.classList.toggle('d-none', !data.articles.length);
    } catch (error) {
        console.error('Error fetching news:', error);
    }
}

// Render news articles
function renderNews(articles) {
    const container = document.getElementById('newsContainer');
    
    articles.forEach(article => {
        const card = `
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <img src="${article.urlToImage || '/images/news-placeholder.jpg'}" 
                         class="card-img-top" alt="${article.title}"
                         onerror="this.src='/images/news-placeholder.jpg'">
                    <div class="card-body">
                        <h5 class="card-title">${article.title}</h5>
                        <p class="card-text text-muted">
                            ${article.description || 'No description available'}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                ${new Date(article.publishedAt).toLocaleDateString()}
                            </small>
                            <a href="${article.url}" class="btn btn-sm btn-primary" target="_blank">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', card);
    });
}

// Search functionality
function searchNews() {
    const searchTerm = document.getElementById('searchNews').value;
    page = 1;
    currentSearch = searchTerm;
    currentCategory = '';
    document.getElementById('categoryFilter').value = '';
    fetchNews(searchTerm);
}

// Category filter
function filterByCategory() {
    const category = document.getElementById('categoryFilter').value;
    page = 1;
    currentCategory = category;
    currentSearch = '';
    document.getElementById('searchNews').value = '';
    fetchNews('', category);
}

// Loading state handlers
function showLoading() {
    document.getElementById('loading').classList.remove('d-none');
}

function hideLoading() {
    document.getElementById('loading').classList.add('d-none');
}

// Load more functionality
document.getElementById('loadMore').addEventListener('click', () => {
    page++;
    fetchNews(currentSearch, currentCategory);
});

// Debounce search input
let searchTimeout;
document.getElementById('searchNews').addEventListener('input', (e) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        if (e.target.value) {
            searchNews();
        }
    }, 500);
});
</script>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-title {
    font-size: 1.1rem;
    line-height: 1.4;
    margin-bottom: 0.75rem;
}

.card-text {
    font-size: 0.9rem;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection