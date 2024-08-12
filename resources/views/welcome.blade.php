<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to HRIS</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('https://picsum.photos/1920/1080/?random') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .login-logo a {
            text-decoration: none;
            font-size: 32px;
            color: #333;
            font-weight: bold;
        }

        .login-box-msg {
            font-size: 22px;
            margin-bottom: 20px;
            color: #333;
        }

        .login-card-body h4 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #666;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .skeleton-preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .skeleton-preloader .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #333;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .login-box {
                padding: 20px 30px;
                max-width: 350px;
            }

            .login-logo a {
                font-size: 28px;
            }

            .login-box-msg {
                font-size: 20px;
            }

            .btn-primary {
                padding: 10px 20px;
                font-size: 16px;
            }
        }
    </style>
    @notifyCss
</head>
<body>
    <x-notify::notify />
    <div class="container">
        <div class="login-box">
            <div class="login-logo">
                <a href="/">MHRPCI-HRIS</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <h3 class="login-box-msg">Welcome to the Human Resources Information System</h3>
                    <h4>Please log in to access the system</h4>
                    <a href="#" id="loginBtn" class="btn btn-primary btn-block">Login</a>
                </div>
            </div>
        </div>
    </div>
    <div id="skeletonPreloader" class="skeleton-preloader" style="display: none;">
        <div class="spinner"></div>
    </div>
    <script>
        document.getElementById('loginBtn').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('skeletonPreloader').style.display = 'flex';
            var delay = Math.floor(Math.random() * 3000) + 3000;
            setTimeout(function() {
                window.location.href = "{{ route('login') }}";
            }, delay);
        });
    </script>
    @notifyJs
</body>
</html>
