<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Policies | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --background-color: #f0f9ff;
            --text-color: #1e293b;
            --accent-color: #3b82f6;
            --hover-color: #2563eb;
        }
        body {
            background-color: var(--background-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }
        .container-fluid {
            max-width: 1200px;
            padding: 2rem 1rem;
        }
        .section-title {
            color: var(--secondary-color);
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-top: 3rem;
            font-weight: 600;
            font-size: 1.8rem;
        }
        .policy-page {
            background-color: #fff;
            border-radius: 15px;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .policy-page:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }
        .policy-title {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
            padding: 1.5rem;
            background-color: #e0f2fe;
            margin: 0;
            border-bottom: 2px solid var(--accent-color);
        }
        .policy-content {
            font-size: 1rem;
            line-height: 1.8;
            padding: 2rem;
        }
        .policy-content p,
        .policy-content li {
            margin-bottom: 1rem;
        }
        .policy-content h1, .policy-content h2, .policy-content h3,
        .policy-content h4, .policy-content h5, .policy-content h6 {
            color: var(--secondary-color);
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .policy-content ul, .policy-content ol {
            padding-left: 2rem;
        }
        .policy-content li {
            margin-bottom: 0.5rem;
        }
        .policy-content table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }
        .policy-content th, .policy-content td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }
        .policy-content th {
            background-color: #e0f2fe;
            font-weight: 600;
            color: var(--secondary-color);
        }
        .btn-back {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
            font-weight: 500;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-back:hover {
            background-color: var(--hover-color);
            color: white;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .last-updated {
            font-size: 0.9rem;
            color: #64748b;
            font-style: italic;
            margin-top: 1rem;
        }
        .company-logo {
            max-width: 200px;
            margin-bottom: 2rem;
        }
        .sticky-search {
            position: sticky;
            top: 0;
            background-color: rgba(240, 249, 255, 0.95);
            padding: 1rem 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }
        #policies-container {
            padding-top: 2rem;
        }
        #search-results {
            font-weight: 500;
            padding: 1rem;
            background-color: #e0f2fe;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .highlight {
            background-color: #fef08a;
            padding: 0.1rem 0.2rem;
            border-radius: 3px;
        }
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }
            .policy-title {
                font-size: 1.3rem;
            }
            .section-title {
                font-size: 1.5rem;
            }
            .btn-back {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <a href="javascript:history.back()" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
            <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="company-logo">
        </div>

        <h1 class="text-center mb-5" style="color: var(--secondary-color); font-weight: 700; font-size: 2.5rem;">Company Policies & Regulations</h1>

        <div class="sticky-search mb-4">
            <input type="text" id="policySearch" class="form-control form-control-lg" placeholder="Search policies...">
        </div>

        <div id="search-results"></div>

        <div id="policies-container">
            @foreach($policies as $sectionName => $sectionPolicies)
                <h2 class="section-title">{{ $sectionName }}</h2>
                @foreach($sectionPolicies as $policy)
                    <div class="policy-page">
                        <h3 class="policy-title">{{ $policy->title }}</h3>
                        <div class="policy-content">
                            {!! $policy->content !!}
                            <p class="last-updated">Last updated: {{ $policy->updated_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const policyContents = document.querySelectorAll('.policy-content');

            policyContents.forEach(content => {
                let lines = content.innerHTML.split('\n');
                let formattedContent = '';
                let isNamePosition = false;

                lines.forEach((line, index) => {
                    line = line.trim();
                    if (line.startsWith('Department Concerned:') ||
                        line.startsWith('Persons Involved:') ||
                        line.startsWith('Particular Policy Statement:') ||
                        line.startsWith('Purpose:') ||
                        line.startsWith('Scope:') ||
                        line.startsWith('Basis of the SOP:')) {
                        const [label, value] = line.split(':');
                        formattedContent += `<p><strong>${label}:</strong> ${value.trim()}</p>`;
                    } else if (line.trim() !== '') {
                        if (index < lines.length - 1 &&
                            line.split(' ').length <= 4 &&
                            lines[index + 1].split(' ').length <= 4) {
                            isNamePosition = true;
                            formattedContent += `<p class="name-position"><strong>${line}</strong></p>`;
                        } else if (isNamePosition) {
                            formattedContent += `<p class="name-position"><strong>${line}</strong></p>`;
                            isNamePosition = false;
                        } else {
                            formattedContent += `<p>${line}</p>`;
                        }
                    }
                });

                content.innerHTML = formattedContent;

                const paragraphs = content.querySelectorAll('p');
                paragraphs.forEach(p => {
                    if (!p.classList.contains('name-position')) {
                        p.style.marginBottom = '1rem';
                        p.style.textAlign = 'justify';
                    }
                });
            });

            const searchInput = document.getElementById('policySearch');
            const policyPages = document.querySelectorAll('.policy-page');
            const policiesContainer = document.getElementById('policies-container');

            let debounceTimer;

            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => performSearch(this.value), 300);
            });

            function performSearch(searchTerm) {
                searchTerm = searchTerm.toLowerCase().trim();
                let foundMatch = false;
                let firstMatch = null;

                policyPages.forEach(page => {
                    const content = page.textContent.toLowerCase();
                    const title = page.querySelector('.policy-title').textContent.toLowerCase();
                    const sectionTitle = page.previousElementSibling.textContent.toLowerCase();

                    if (content.includes(searchTerm) || title.includes(searchTerm) || sectionTitle.includes(searchTerm)) {
                        page.style.display = 'block';
                        highlightText(page, searchTerm);
                        if (!foundMatch) {
                            firstMatch = page;
                            foundMatch = true;
                        }
                    } else {
                        page.style.display = 'none';
                        removeHighlight(page);
                    }
                });

                updateSearchResults(searchTerm, foundMatch);

                if (firstMatch) {
                    scrollToElement(firstMatch);
                }
            }

            function highlightText(element, searchTerm) {
                removeHighlight(element);
                if (!searchTerm) return;

                const walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
                let node;
                const regex = new RegExp(searchTerm, 'gi');

                while (node = walker.nextNode()) {
                    const parent = node.parentNode;
                    const content = node.textContent;
                    const matches = content.match(regex);

                    if (matches) {
                        const fragment = document.createDocumentFragment();
                        let lastIndex = 0;

                        for (const match of matches) {
                            const index = content.indexOf(match, lastIndex);
                            fragment.appendChild(document.createTextNode(content.slice(lastIndex, index)));

                            const span = document.createElement('span');
                            span.className = 'highlight';
                            span.textContent = match;
                            fragment.appendChild(span);

                            lastIndex = index + match.length;
                        }

                        fragment.appendChild(document.createTextNode(content.slice(lastIndex)));
                        parent.replaceChild(fragment, node);
                    }
                }
            }

            function removeHighlight(element) {
                const highlights = element.querySelectorAll('.highlight');
                highlights.forEach(highlight => {
                    const parent = highlight.parentNode;
                    parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
                    parent.normalize();
                });
            }

            function scrollToElement(element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            function updateSearchResults(searchTerm, foundMatch) {
                let searchResultsElement = document.getElementById('search-results');
                if (!searchResultsElement) {
                    searchResultsElement = document.createElement('div');
                    searchResultsElement.id = 'search-results';
                    searchResultsElement.className = 'mb-4';
                    policiesContainer.insertBefore(searchResultsElement, policiesContainer.firstChild);
                }

                if (searchTerm) {
                    const visiblePolicies = document.querySelectorAll('.policy-page[style="display: block;"]');
                    const resultCount = visiblePolicies.length;
                    searchResultsElement.innerHTML = foundMatch
                        ? `<p class="text-success">Found ${resultCount} result${resultCount !== 1 ? 's' : ''} for "${searchTerm}"</p>`
                        : `<p class="text-danger">No results found for "${searchTerm}"</p>`;
                } else {
                    searchResultsElement.innerHTML = '';
                }
            }
        });
    </script>
</body>
</html>
