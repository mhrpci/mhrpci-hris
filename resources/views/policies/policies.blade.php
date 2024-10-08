<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Policies | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --background-color: #f8f9fa;
            --text-color: #333;
        }
        body {
            background-color: var(--background-color);
            font-family: 'Roboto', 'Arial', sans-serif;
            color: var(--text-color);
        }
        .container-fluid {
            position: relative;
            z-index: 1;
            max-width: 1200px;
        }
        .section-title {
            color: var(--secondary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-top: 2rem;
            font-weight: 600;
        }
        .policy-page {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            page-break-inside: avoid;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .policy-page:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        .policy-title {
            color: var(--secondary-color);
            font-size: 1.8rem;
            font-weight: bold;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .policy-content {
            font-size: 1rem;
            line-height: 1.8;
            text-align: justify;
        }
        .policy-content p,
        .policy-content li {
            margin-bottom: 1.2em;
            text-indent: 1.5em;
        }
        .policy-content h1, .policy-content h2, .policy-content h3,
        .policy-content h4, .policy-content h5, .policy-content h6 {
            color: var(--secondary-color);
            margin-top: 1.8em;
            margin-bottom: 1em;
            font-weight: 600;
            text-align: left;
        }
        .policy-content ul, .policy-content ol {
            margin-bottom: 1.2em;
            padding-left: 2.5em;
        }
        .policy-content li {
            margin-bottom: 0.8em;
        }
        .policy-content ul {
            list-style-type: disc;
        }
        .policy-content ul ul {
            list-style-type: circle;
        }
        .policy-content ul ul ul {
            list-style-type: square;
        }
        .policy-content ol {
            list-style-type: decimal;
        }
        .policy-content ol ol {
            list-style-type: lower-alpha;
        }
        .policy-content ol ol ol {
            list-style-type: lower-roman;
        }
        .policy-content ul li::marker,
        .policy-content ol li::marker {
            color: var(--secondary-color);
        }
        .policy-content dl {
            margin-bottom: 1em;
        }
        .policy-content dt {
            font-weight: bold;
            margin-top: 0.5em;
        }
        .policy-content dd {
            margin-left: 2em;
            margin-bottom: 0.5em;
        }
        .justify-text {
            text-align: justify;
        }
        .policy-content table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1em;
        }
        .policy-content th, .policy-content td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .policy-content th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .btn-back {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .btn-back:hover {
            background-color: #2980b9;
            color: white;
        }
        .last-updated {
            font-size: 0.9rem;
            color: #6c757d;
            font-style: italic;
        }
        @media print {
            body {
                background-color: white;
            }
            .policy-page {
                page-break-after: always;
                box-shadow: none;
                border: none;
            }
            .btn-back, .last-updated {
                display: none;
            }
        }
        .company-logo {
            max-width: 500px;
            max-height: 500px;
            margin-bottom: 50px;
        }

        /* Add these new styles for the shape background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            background-color: #f8f9fa;
            background-image:
                linear-gradient(30deg, #e0e0e0 12%, transparent 12.5%, transparent 87%, #e0e0e0 87.5%, #e0e0e0),
                linear-gradient(150deg, #e0e0e0 12%, transparent 12.5%, transparent 87%, #e0e0e0 87.5%, #e0e0e0),
                linear-gradient(30deg, #e0e0e0 12%, transparent 12.5%, transparent 87%, #e0e0e0 87.5%, #e0e0e0),
                linear-gradient(150deg, #e0e0e0 12%, transparent 12.5%, transparent 87%, #e0e0e0 87.5%, #e0e0e0),
                linear-gradient(60deg, #e0e0e077 25%, transparent 25.5%, transparent 75%, #e0e0e077 75%, #e0e0e077),
                linear-gradient(60deg, #e0e0e077 25%, transparent 25.5%, transparent 75%, #e0e0e077 75%, #e0e0e077);
            background-size: 80px 140px;
            background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;
            opacity: 0.3;
        }

        /* Add these new styles for the sticky search bar */
        .sticky-search {
            position: sticky;
            top: 0;
            background-color: var(--background-color);
            padding: 15px 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Adjust the policies container to account for the sticky search bar */
        #policies-container {
            padding-top: 20px;
        }

        #search-results {
            font-weight: bold;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-5">
        <div class="header text-end">
            <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="logo company-logo">
        </div>
        <a href="{{ route('home') }}" class="btn-back mb-4">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
        <h1 class="text-center mb-5">Company Policies</h1>

        <!-- Move the search input outside the policies container and make it sticky -->
        <div class="sticky-search">
            <input type="text" id="policySearch" class="form-control" placeholder="Search policies...">
        </div>

        <div id="policies-container">
            @foreach($policies as $sectionName => $sectionPolicies)
                <h2 class="section-title mb-4">{{ $sectionName }}</h2>
                @foreach($sectionPolicies as $policy)
                    <div class="policy-page mb-5 p-5 bg-white shadow">
                        <div class="policy-header mb-4">
                            <h3 class="policy-title">{{ $policy->title }}</h3>
                            <p class="last-updated">Last updated: {{ $policy->updated_at->format('F d, Y') }}</p>
                        </div>
                        <div class="policy-content">
                            {!! $policy->content !!}
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
                // Split the content into lines
                let lines = content.innerHTML.split('\n');
                let formattedContent = '';
                let isNamePosition = false;

                lines.forEach((line, index) => {
                    line = line.trim();
                    if (line.startsWith('Department Concerned:')) {
                        formattedContent += `<p><strong>Department Concerned:</strong> ${line.split(':')[1].trim()}</p>`;
                    } else if (line.startsWith('Persons Involved:')) {
                        formattedContent += `<p><strong>Persons Involved:</strong> ${line.split(':')[1].trim()}</p>`;
                    } else if (line.startsWith('Particular Policy Statement:')) {
                        formattedContent += `<p><strong>Particular Policy Statement:</strong> ${line.split(':')[1].trim()}</p>`;
                    } else if (line.startsWith('Purpose:')) {
                        formattedContent += `<p><strong>Purpose:</strong> ${line.split(':')[1].trim()}</p>`;
                    } else if (line.startsWith('Scope:')) {
                        formattedContent += `<p><strong>Scope:</strong> ${line.split(':')[1].trim()}</p>`;
                    } else if (line.startsWith('Basis of the SOP:')) {
                        formattedContent += `<p><strong>Basis of the SOP:</strong> ${line.split(':')[1].trim()}</p>`;
                    } else if (line.trim() !== '') {
                        // Check if this line and the next line might be a name and position
                        if (index < lines.length - 1 &&
                            line.split(' ').length <= 4 &&
                            lines[index + 1].split(' ').length <= 4) {
                            isNamePosition = true;
                            formattedContent += `<p class="name-position"><strong><u>${line}</u></strong></p>`;
                        } else if (isNamePosition) {
                            formattedContent += `<p class="name-position"><strong><u>${line}</u></strong></p>`;
                            isNamePosition = false;
                        } else {
                            formattedContent += `<p>${line}</p>`;
                        }
                    }
                });

                content.innerHTML = formattedContent;

                // Apply styles
                const paragraphs = content.querySelectorAll('p');
                paragraphs.forEach(p => {
                    if (!p.classList.contains('name-position')) {
                        p.style.marginBottom = '0.5em';
                        p.style.textAlign = 'justify';
                    }
                });
            });

            // Improved search functionality
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

                    if (content.includes(searchTerm) || title.includes(searchTerm)) {
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
                            span.style.backgroundColor = 'yellow';
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
                    searchResultsElement.className = 'mt-3 mb-4';
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
