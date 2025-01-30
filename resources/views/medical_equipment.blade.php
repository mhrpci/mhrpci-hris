<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Showcase - Categories</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 2rem;
            padding-top: 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            position: relative;
        }

        .back-button {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #2c5282;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .back-button:hover {
            background-color: #e2e8f0;
            color: #1a365d;
        }

        .category-section {
            margin-bottom: 4rem;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #2c5282;
        }

        .category-logo {
            width: 50px;
            height: 50px;
            padding: 10px;
            background: #2c5282;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-logo svg {
            width: 100%;
            height: 100%;
            fill: white;
        }

        .category-title {
            font-size: 2rem;
            color: #2c5282;
        }

        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .category-description {
            margin-bottom: 2rem;
            color: #666;
            line-height: 1.6;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 15px rgba(44, 82, 130, 0.2);
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #2c5282;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-image {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #f6f6f6 0%, #e9e9e9 100%);
            border-radius: 4px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            max-height: none;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #2c5282;
            margin-bottom: 0.5rem;
        }

        .product-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .product-button {
            background: linear-gradient(135deg, #2c5282 0%, #1a365d 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .product-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(44, 82, 130, 0.3);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 1rem;
            overflow-y: auto;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            padding: 3rem;
            border-radius: 12px;
            max-width: 800px;
            width: 100%;
            position: relative;
            transform: translateY(-20px);
            transition: all 0.3s ease;
            margin: auto;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .modal .product-title {
            font-size: 2rem;
            color: #2c5282;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .modal .product-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4a5568;
            margin-bottom: 2rem;
        }

        .modal pre {
            background-color: #f7fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-family: inherit;
            margin-top: 2rem;
        }

        .modal ul {
            list-style: none;
            padding: 0;
        }

        .modal ul li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }

        .modal ul li:before {
            content: "•";
            color: #2c5282;
            font-weight: bold;
            margin-right: 1rem;
        }

        .close-modal {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: #a0aec0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            background-color: #f7fafc;
        }

        .close-modal:hover {
            background-color: #e2e8f0;
            color: #2c5282;
        }

        @media (max-width: 768px) {
            .modal-content {
                padding: 1.5rem;
                max-height: 95vh;
            }

            .close-modal {
                top: 0.5rem;
                right: 0.5rem;
            }
        }

        html {
            scroll-behavior: smooth;
        }

        .scroll-animation {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .scroll-animation.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Add preloader styles */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .preloader.fade-out {
            opacity: 0;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #2c5282;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        .loading-text {
            color: #2c5282;
            font-size: 1.2rem;
            font-weight: 500;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Add preloader HTML right after body tag -->
    <div class="preloader">
        <div class="spinner"></div>
        <div class="loading-text">Loading...</div>
    </div>

    <div class="header">
        <button onclick="window.location.href='/mhrhealthcareinc'" class="back-button">← Back</button>
        <h1>Our Products</h1>
    </div>

    <div id="sterilewaves" class="category-section">
        <div class="category-header">
                <img src="/vendor/adminlte/dist/img/img/Sterilwave.png" alt="Sterilewaves Icon" style="max-width: 100px; height: auto;">
            <h2 class="category-title">Sterilewave</h2>
        </div>
        <p class="category-description">Advanced sterilization solutions for medical and professional environments.</p>
        <div class="products-container" id="sterilewavesContainer"></div>
    </div>

    <div id="danube" class="category-section">
        <div class="category-header">
            <img src="/vendor/adminlte/dist/img/img/danube.png" alt="Danube Icon" style="max-width: 100px; height: auto;">
            <h2 class="category-title">Danube</h2>
        </div>
        <p class="category-description">Premium water purification and treatment systems.</p>
        <div class="products-container" id="danubeContainer"></div>
    </div>

    <div id="ventilator" class="category-section">
        <div class="category-header">
            <img src="/vendor/adminlte/dist/img/img/cebic.jpg" alt="Cebic Icon" style="max-width: 100px; height: auto;">
            <h2 class="category-title">Cebic Ventilator</h2>
        </div>
        <p class="category-description">High-quality ventilation and air management solutions.</p>
        <div class="products-container" id="ventilatorContainer"></div>
    </div>

    <div class="modal" id="productModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
            <button class="product-button" style="margin-top: 2rem;" onclick="showQuotationModal()">Request Quotation</button>
        </div>
    </div>

    <!-- Add new quotation modal -->
    <div class="modal" id="quotationModal">
        <div class="modal-content" style="max-width: 500px;">
            <span class="close-modal" onclick="closeQuotationModal()">&times;</span>
            <h2 class="product-title">Request Quotation</h2>
            <form id="quotationForm" onsubmit="submitQuotation(event)">
                <div style="margin-bottom: 1.5rem;">
                    <label for="productName" style="display: block; margin-bottom: 0.5rem; color: #2c5282;">Product</label>
                    <input type="text" id="quotationProductName" readonly 
                        style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; color: #2c5282;">Email Address</label>
                    <input type="email" id="quotationEmail" required 
                        style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 4px;">
                </div>
                <button type="submit" class="product-button">Send Request</button>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

        const products = {
            sterilewaves: [
                {
                    id: 'sw100',
                    name: "SW 100",
                    image: "/vendor/adminlte/dist/img/img/sw100.png",
                    description: "Within 35-45 minutes, Sterilwave® transforms bio-hazardous waste into unrecognizable and inert municipal waste. Eco-friendly & efficient microwave technology, it is dedicated to hospitals, clinics, laboratories and any other medical centers looking to improve its waste management cost and effectiveness. Sterilwave® converts bio-hazardous waste into ordinary municipal waste with a volume reduction up to 85% and weight reduction up to 25%. Sterilwave® level of treatment exceeds all regulatory standards including NFX30-503 and STAATT requirements. The microwave technology is recommended by WHO as lowest operating cost solution for bio-hazardous waste management.",
                    details: "<ul>\
                        <li>Microwave Technology (Shredding & Heating)</li>\
                        <li>Environmental and endusers friendly</li>\
                        <li>Hazard free operation. One single vessel</li>\
                        <li>Very safe to use, No segregation, Ambiant pressure</li>\
                        <li>All types of solid waste including placenta, body parts (Pathological & Biological)</li>\
                        <li>DENR-EMB approved PTO</li>\
                        <li>Electric use only. No water, No chemical</li>\
                        <li>National Reference Laboratory (NRL - DOH Lab Test)</li>\
                        <li>Compliant with International Standard</li>\
                    </ul>"
                },
                {
                    id: 'sw250',
                    name: "SW 250",
                    image: "/vendor/adminlte/dist/img/img/sw250.png",
                    description: "Within 35-45 minutes, Sterilwave® transforms bio-hazardous waste into unrecognizable and inert municipal waste. Eco-friendly & efficient microwave technology, it is dedicated to hospitals, clinics, laboratories and any other medical centers looking to improve its waste management cost and effectiveness. Sterilwave® converts bio-hazardous waste into ordinary municipal waste with a volume reduction up to 85% and weight reduction up to 25%. Sterilwave® level of treatment exceeds all regulatory standards including NFX30-503 and STAATT requirements. The microwave technology is recommended by WHO as lowest operating cost solution for bio-hazardous waste management.",
                    details: "<ul>\
                        <li>Microwave Technology (Shredding & Heating)</li>\
                        <li>Environmental and endusers friendly</li>\
                        <li>Hazard free operation. One single vessel</li>\
                        <li>Very safe to use, No segregation, Ambiant pressure</li>\
                        <li>All types of solid waste including placenta, body parts (Pathological & Biological)</li>\
                        <li>DENR-EMB approved PTO</li>\
                        <li>Electric use only. No water, No chemical</li>\
                        <li>National Reference Laboratory (NRL - DOH Lab Test)</li>\
                        <li>Compliant with International Standard</li>\
                    </ul>"
                },
                {
                    id: 'sw440',
                    name: "SW 440",
                    image: "/vendor/adminlte/dist/img/img/sw440.png",
                    description: "Within 35-45 minutes, Sterilwave® transforms bio-hazardous waste into unrecognizable and inert municipal waste. Eco-friendly & efficient microwave technology, it is dedicated to hospitals, clinics, laboratories and any other medical centers looking to improve its waste management cost and effectiveness. Sterilwave® converts bio-hazardous waste into ordinary municipal waste with a volume reduction up to 85% and weight reduction up to 25%. Sterilwave® level of treatment exceeds all regulatory standards including NFX30-503 and STAATT requirements. The microwave technology is recommended by WHO as lowest operating cost solution for bio-hazardous waste management.",
                    details: "<ul>\
                        <li>Microwave Technology (Shredding & Heating)</li>\
                        <li>Environmental and endusers friendly</li>\
                        <li>Hazard free operation. One single vessel</li>\
                        <li>Very safe to use, No segregation, Ambiant pressure</li>\
                        <li>All types of solid waste including placenta, body parts (Pathological & Biological)</li>\
                        <li>DENR-EMB approved PTO</li>\
                        <li>Electric use only. No water, No chemical</li>\
                        <li>National Reference Laboratory (NRL - DOH Lab Test)</li>\
                        <li>Compliant with International Standard</li>\
                    </ul>"
                },
            ],
            danube: [
                {
                    id: 'd1',
                    name: "Professional Equipment",
                    description: "This range of equipment offers the latest technology to suit the needs of all kind of small businesses. These small capacity models have been designed to ensure top quality and high performance thanks to their design, robustness thanks to industrial components, outstanding features thanks to the ET2 control while offering a competitive price. Electric heated models and gas heated dryers, now available with heat pump.",
                    image: "/vendor/adminlte/dist/img/img/washerextractor.png",
                    details: "<ul>\
                        <li>Washers Extractors 8 & 10 kg</li>\
                        <li>Tumble Dryers 8 & 10 kg</li>\
                    </ul>"
                },
                {
                    id: 'd2',
                    name: "Industrial Washers",
                    description: "The industrial range of Danube front washers and sanitary barrier washers offers productivity and efficiency with significative savings of energy, water and detergents. With one of the highest G factor on the market, all the models are equipped with the ET2 control with a wide touch screen, which enable many features as telemetry, connectivity, versatility and are easy to maintain.",
                    image: "/vendor/adminlte/dist/img/img/barrier.png",
                    details: "<ul>\
                        <li>Front Washer 11 to 120 kg</li>\
                        <li>Barriers Washers 16 to 100 kg</li>\
                    </ul>"
                },
                {
                    id: 'd3',
                    name: "Industrial Dryers",
                    description: "This is one of the most extended range of tumble dryers with single drum, double drum and heat pump models. Like the washers, all models have been designed to meet the greatest kind of requirements in terms of efficiency, productivity, connectivity and versatility. They meet most needs and are suitable for all sizes of business.",
                    image: "/vendor/adminlte/dist/img/img/heatpump.png",
                    details: "<ul>\
                        <li>Tumble Dryers 11 to 80 kg</li>\
                        <li>Single Drum</li>\
                        <li>Double Drum</li>\
                        <li>Heat Pump</li>\
                    </ul>"
                },
                {
                    id: 'd4',
                    name: "Cleanroom",
                    description: "A cleanroom is a place designed for laundrie where the very high level of hygiene and cleanliness is requested such in agri-food, pharmaceutical, nuclear or chemical industries. Danube offers models with specific options to achieve the highest level of hygiene, to avoid cross contamination and ensure optimal degree of safety : barrier washers from 16 to 70 kg, tumble dryers from 11 to 80 kg.",
                    image: "/vendor/adminlte/dist/img/img/cleanroom.png",
                    details: "<ul>\
                        <li>Barrier washers with opposite doors for cross-contamination prevention</li>\
                        <li>Load capacity: 16 to 70 kg</li>\
                        <li>Multiple heating options: electric, steam, or combination</li>\
                        <li>ET2 microprocessor with 7-inch touch screen</li>\
                        <li>Data analysis and traceability control</li>\
                        <li>Durable and ergonomic design with low maintenance</li>\
                        <li>Compliant with current legislation quality standards</li>\
                        <li>Comprehensive technical and after-sales support</li>\
                    </ul>"
                }
            ],
            ventilator: [
                {
                    id: 'v1',
                    name: "Cebic Ventilator",
                    image: "/vendor/adminlte/dist/img/img/ventilator.png",
                    description: "Advanced automated adaptive assisted wide-range ventilation system with electronic microprocessor controlled by volume and pressure, designed to fit all types of patients from Neonates, Pediatrics to Adults. Featuring a 15.6\" TFT touch screen (18.5\" optional) with 360-degree rotation capability. The system supports both invasive and non-invasive modes for wide applications. Equipped with an integrated self-check system including leak check and system tightness verification (POST: Power On Self Test) to ensure reliable ventilation results. The unit provides automatic leakage compensation to optimize respirator settings. Powered by dual Lithium batteries, guaranteeing up to 6 hours of continuous operation. Features manual settable Inspiratory pause from 0-60% and automatic triggers adjustment for both flow and pressure triggers. Advanced capabilities include volumetric capnography of CO2 measurement (ETCO2 measurement optional). The AMV mode minimizes the work of breathing under the target minute ventilation.",
                    details: "<ul>\
                        <li>360° Rotatable LCD</li>\
                        <li>15.6\" TFT Touch Screen (18.5\" Optional)</li>\
                        <li>One-hand operative valves</li>\
                        <li>Stable and durable trolley with brake</li>\
                        <li>Servo control humidifier (Optional)</li>\
                        <li>In-built nebulizer</li>\
                        <li>Dual limb support</li>\
                        <li>Neonatal ventilation interface</li>\
                        <li>Invasive ventilation capability</li>\
                        <li>Advanced Turbine technology</li>\
                    </ul>"
                },
            ]
        };

        function createProductCards() {
            Object.keys(products).forEach(category => {
                const container = document.getElementById(`${category}Container`);
                
                products[category].forEach(product => {
                    const card = document.createElement('div');
                    card.className = 'product-card scroll-animation';
                    
                    // Limit description to 100 characters and add ellipsis if needed
                    const truncatedDescription = product.description.length > 100 
                        ? product.description.substring(0, 100) + '...' 
                        : product.description;
                    
                    card.innerHTML = `
                        <div class="product-image">
                            <img src="${product.image}" alt="${product.name}">
                        </div>
                        <h2 class="product-title">${product.name}</h2>
                        <p class="product-description">${truncatedDescription}</p>
                        <button class="product-button" onclick="showProductDetails('${product.id}')">View Details</button>
                    `;
                    
                    container.appendChild(card);
                });
            });
        }

        function showProductDetails(productId) {
            let product;
            for (const category in products) {
                product = products[category].find(p => p.id === productId);
                if (product) break;
            }

            const modal = document.getElementById('productModal');
            const modalContent = document.getElementById('modalContent');
            
            // Store the current product name in a data attribute
            modal.setAttribute('data-product-name', product.name);
            
            modalContent.innerHTML = `
                <h2 class="product-title">${product.name}</h2>
                ${product.image ? `
                    <div style="text-align: center; margin: 2rem 0;">
                        <img src="${product.image}" alt="${product.name}" 
                            style="max-width: 100%; height: auto; max-height: 400px; object-fit: contain; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    </div>` : ''
                }
                <div class="product-info">
                    <h3 style="color: #2c5282; margin-bottom: 1rem;">Product Description</h3>
                    <p class="product-description">${product.description}</p>
                    
                    <h3 style="color: #2c5282; margin: 2rem 0 1rem;">Technical Specifications</h3>
                    <div class="product-details">
                        ${product.details}
                    </div>
                </div>
            `;
            
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('active'), 10);
        }

        function showQuotationModal() {
            const productModal = document.getElementById('productModal');
            const quotationModal = document.getElementById('quotationModal');
            const productName = productModal.getAttribute('data-product-name');
            
            // Set the product name in the quotation form
            document.getElementById('quotationProductName').value = productName;
            
            // Hide product modal and show quotation modal
            productModal.classList.remove('active');
            setTimeout(() => {
                productModal.style.display = 'none';
                quotationModal.style.display = 'flex';
                setTimeout(() => quotationModal.classList.add('active'), 10);
            }, 300);
        }

        function closeModal() {
            const modal = document.getElementById('productModal');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        function closeQuotationModal() {
            const quotationModal = document.getElementById('quotationModal');
            quotationModal.classList.remove('active');
            setTimeout(() => {
                quotationModal.style.display = 'none';
            }, 300);
        }

        function submitQuotation(event) {
            event.preventDefault();
            
            const productName = document.getElementById('quotationProductName').value;
            const email = document.getElementById('quotationEmail').value;
            
            // Create mailto link with pre-filled subject and body
            const subject = encodeURIComponent(`Quotation Request for ${productName}`);
            const body = encodeURIComponent(`Hello,\n\nI would like to request a quotation for ${productName}.\n\nBest regards,\n${email}`);
            const mailtoLink = `mailto:csr.mhrhealthcare@gmail.com?subject=${subject}&body=${body}`;
            
            // Open default email client
            window.location.href = mailtoLink;
            
            // Close the quotation modal
            closeQuotationModal();
        }

        // Update window click handler to handle both modals
        window.onclick = function(event) {
            const productModal = document.getElementById('productModal');
            const quotationModal = document.getElementById('quotationModal');
            if (event.target === productModal) {
                closeModal();
            }
            if (event.target === quotationModal) {
                closeQuotationModal();
            }
        }

        // Add this new function for scroll animation
        function handleScrollAnimation() {
            const elements = document.querySelectorAll('.scroll-animation');
            const windowHeight = window.innerHeight;

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                if (elementPosition < windowHeight - 100) {
                    element.classList.add('visible');
                }
            });
        }

        // Initialize the page
        createProductCards();
        
        // Add scroll event listener
        window.addEventListener('scroll', handleScrollAnimation);
        // Trigger initial check
        handleScrollAnimation();
    </script>
</body>
</html>