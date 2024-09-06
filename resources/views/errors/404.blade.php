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
            justify-content: flex-end; /* Align content to the right */
            height: 100vh;
            text-align: center;
        }
        .container {
            padding: 40px;
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
            margin-left: auto; /* Align container to the right */
            margin-right: 20px; /* Align container to the right */
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
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()">Go Back</a>
    </div>
</body>
</html>
