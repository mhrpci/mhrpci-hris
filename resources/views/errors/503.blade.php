<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 Service Unavailable</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Prevent scrolling */
        }
        .container {
            text-align: center;
            position: relative;
            z-index: 1;
        }
        h1 {
            font-size: 120px;
            color: #6200ee;
            margin: 0;
            line-height: 1;
        }
        h2 {
            font-size: 36px;
            color: #6200ee;
            margin: 0 0 20px;
        }
        p {
            font-size: 18px;
            color: #333;
            max-width: 500px;
            margin: 0 auto 30px;
        }
        .shape {
            position: absolute;
            z-index: -1;
        }
        .shape-1 {
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background-color: #6200ee;
            border-radius: 0 0 200px 0;
        }
        .shape-2 {
            bottom: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background-color: #b388ff;
            transform: rotate(45deg);
        }
        .shape-3 {
            top: 50%;
            right: 10%;
            width: 80px;
            height: 80px;
            background-color: #b388ff;
            transform: rotate(45deg);
        }
        .shape-4 {
            top: 20%;
            left: 5%;
            width: 60px;
            height: 60px;
            background-color: #6200ee;
            border-radius: 50%;
        }
        .shape-5 {
            bottom: 15%;
            left: 15%;
            width: 40px;
            height: 40px;
            background-color: #b388ff;
            transform: rotate(30deg);
        }
        .shape-6 {
            top: 10%;
            right: 20%;
            width: 50px;
            height: 50px;
            background-color: #6200ee;
            border-radius: 25px 0;
        }
        @media (max-width: 768px) {
            h1 { font-size: 80px; }
            h2 { font-size: 24px; }
            p { font-size: 16px; }
            .shape-1 { width: 150px; height: 150px; }
            .shape-2, .shape-3 { width: 60px; height: 60px; }
            .shape-4, .shape-5, .shape-6 { width: 30px; height: 30px; }
        }
    </style>
</head>
<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
    <div class="shape shape-5"></div>
    <div class="shape shape-6"></div>
    <div class="container">
        <h1><span style="font-size: 36px; display: block; margin-bottom: 10px; font-family: 'Times New Roman', Times, serif;">MHR Property Conglomerates, Inc.</span>503</h1>
        <h2>Service Unavailable</h2>
        <p>We are under maintenance, we will be back as soon as possible. Thank you for your patience.</p>
    </div>
</body>
</html>
