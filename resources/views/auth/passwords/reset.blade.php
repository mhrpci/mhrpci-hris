<!-- resources/views/auth/passwords/reset.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MHRPCI-HRIS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            position: relative;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('/images/frontmhrhci.jpg');
            background-size: cover;
            background-position: center;
            transition: filter 0.5s ease;
        }
        .background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102,126,234,0.6) 0%, rgba(118,75,162,0.6) 100%);
        }
        .reset-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            z-index: 1;
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .reset-form:hover, .reset-form:focus-within {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            width: 120px;
            height: auto;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-group input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
        }
        .btn-login:hover {
            background-color: #3a7bc8;
        }
        .btn-login:active {
            transform: scale(0.98);
        }
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 8s infinite;
            pointer-events: none;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            color: #4a90e2;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="background" id="background"></div>
        <form class="reset-form" method="POST" action="{{ route('password.update') }}" id="reset-password-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="logo">
                <img src="/images/LOGO4.png" alt="Company Logo">
            </div>
            <h1>Reset Password</h1>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required autofocus placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirm New Password</label>
                <input type="password" id="password-confirm" name="password_confirmation" required placeholder="Confirm new password">
            </div>
            <button type="submit" class="btn-login">Reset Password</button>
        </form>
    </div>

    <script>
        function createBubbles() {
            const background = document.getElementById('background');
            for (let i = 0; i < 15; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                bubble.style.width = `${Math.random() * 100 + 50}px`;
                bubble.style.height = bubble.style.width;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.top = `${Math.random() * 100}%`;
                bubble.style.animationDuration = `${Math.random() * 4 + 4}s`;
                bubble.style.animationDelay = `${Math.random() * 2}s`;
                background.appendChild(bubble);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            createBubbles();
            
            const form = document.querySelector('.reset-form');
            const background = document.getElementById('background');

            form.addEventListener('focus', () => {
                background.style.filter = 'blur(5px)';
            }, true);

            form.addEventListener('blur', () => {
                background.style.filter = 'blur(0)';
            }, true);

            // Add form submission handler
            const resetPasswordForm = document.getElementById('reset-password-form');
            resetPasswordForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                try {
                    const response = await fetch(resetPasswordForm.action, {
                        method: 'POST',
                        body: new FormData(resetPasswordForm),
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        // Success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your password has been reset successfully.',
                            confirmButtonColor: '#4a90e2'
                        }).then(() => {
                            // Redirect to login page or dashboard
                            window.location.href = '/login'; // Adjust this URL as needed
                        });
                    } else {
                        // Error message
                        let errorMessage = 'Failed to reset password. Please try again.';
                        if (data.errors) {
                            errorMessage = Object.values(data.errors).flat().join('\n');
                        } else if (data.message) {
                            errorMessage = data.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonColor: '#4a90e2'
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonColor: '#4a90e2'
                    });
                }
            });
        });
    </script>
</body>
</html>