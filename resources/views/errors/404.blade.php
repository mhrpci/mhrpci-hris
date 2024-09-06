<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('vendor/adminlte/dist/img/NOT FOUND.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center; /* Center content horizontally */
            height: 100vh;
            text-align: center;
        }
        .container {
            padding: 40px;
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
            margin-left: auto; /* Align container to the right on larger screens */
            margin-right: 20px; /* Align container to the right on larger screens */
        }
        h1 {
            font-size: 100px;
            margin: 0;
            color: #d9534f; /* Bootstrap danger color */
        }
        h2 {
            font-size: 24px;
            margin: 0 0 20px;
            color: #555;
        }
        p {
            font-size: 18px;
            margin: 0 0 30px;
            color: #777;
        }
        a {
            text-decoration: none;
            color: #007bff; /* Bootstrap primary color */
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        a:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Mobile view adjustments */
        @media (max-width: 768px) {
            body {
                justify-content: flex-start; /* Align content to the start on mobile screens */
            }
            .container {
                margin: 0; /* Remove margin on mobile screens */
                position: relative;
            }
            a {
                position: absolute;
                top: 150px;
                right: 10px;
                font-size: 16px; /* Adjust font size for better mobile view */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()">Go Back</a>
    </div>
</body>
</html>
