<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Your Company Name</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: #f7f7f7;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 360px;
            width: 100%;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
        }
        h1 {
            text-align: center;
            color: #6a1b9a;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input:focus {
            border-color: #6a1b9a;
            box-shadow: 0 0 0 2px rgba(106, 27, 154, 0.2);
            outline: none;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-login:hover {
            background-color: #4a0072;
        }
        .btn-login:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="login-form" method="POST" action="{{ route('password.email') }}" id="reset-password-form">
            @csrf
            <div class="logo">
                <img src="/images/LOGO4.png" alt="Company Logo">
            </div>
            <h1>Forgot Password</h1>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required autofocus placeholder="Enter your email">
            </div>
            <button type="submit" class="btn-login">Send Password Reset Link</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
                if (data.status === 'disabled') {
                    // User is disabled, show error
                    Swal.fire({
                        icon: 'error',
                        title: 'Account Disabled',
                        text: 'Your account is disabled. Please contact support.',
                        confirmButtonColor: '#6a1b9a'
                    });
                } else {
                    // Success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Password reset link has been sent to your email.',
                        confirmButtonColor: '#6a1b9a'
                    });
                }
            } else {
                // Error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Failed to send password reset link. Please try again.',
                    confirmButtonColor: '#6a1b9a'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong. Please try again later.',
                confirmButtonColor: '#6a1b9a'
            });
        }
    });
});

    </script>
</body>
</html>
