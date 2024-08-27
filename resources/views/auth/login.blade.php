<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LOGIN-{{ env('APP_NAME') }}</title>
    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>

    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * {
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden; /* Prevent scrolling */
    }

    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Montserrat', sans-serif;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25),
                    0 10px 10px rgba(0,0,0,0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Ensure container doesn't overflow */
        max-height: 100vh;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
        padding: 20px; /* Add some padding */
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .overlay {
        background: #5f0a97; /* Fallback color */
        background: -webkit-linear-gradient(to right, #a45dff, #6e1ab1); /* Purple gradient for WebKit browsers */
        background: linear-gradient(to right, #a45dff, #6e1ab1); /* Purple gradient for modern browsers */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }


    .form-container:hover {
        background-color: #f9f9f9; /* Change background color on hover */
    }


    h1 {
        font-weight: bold;
        font-size: 2.5rem; /* Larger font size */
        color: #050505; /* Darker color for better readability */
        margin: 0;
        padding: 20px 0; /* Add some padding */
        text-align: center; /* Centered text */
    }


    h2 {
        text-align: center;
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    button {
        border-radius: 20px;
        border: 1px solid #FF4B2B;
        background-color: #FF4B2B;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background-color: transparent;
        border-color: #FFFFFF;
    }

    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 100%;
        text-align: center;
    }

    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
          box-shadow: 0 14px 28px rgba(0,0,0,0.25),
                0 10px 10px rgba(0,0,0,0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {
        0%, 49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%, 100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container{
        transform: translateX(-100%);
    }

    .overlay {
        background: #5f0a97; /* Fallback color */
        background: -webkit-linear-gradient(to right, #a45dff, #6e1ab1); /* Purple gradient for WebKit browsers */
        background: linear-gradient(to right, #a45dff, #6e1ab1); /* Purple gradient for modern browsers */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .container.right-panel-active .overlay {
          transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

    .social-container {
        margin: 20px 0;
    }

    .social-container a {
        border: 1px solid #DDDDDD;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 5px;
        height: 40px;
        width: 40px;
    }

    footer {
        background-color: #222;
        color: #fff;
        font-size: 14px;
        bottom: 0;
        position: fixed;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 999;
    }

    footer p {
        margin: 10px 0;
    }

    footer i {
        color: red;
    }

    footer a {
        color: #3c97bf;
        text-decoration: none;
    }

    input {
        background-color: #eee;
        border: 1px solid #ccc; /* Added border color */
        border-radius: 5px; /* Rounded corners */
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    }

    input:focus {
        border-color: #FF4B2B; /* Change border color on focus */
        box-shadow: 0 0 5px rgba(255, 75, 43, 0.5); /* Add shadow effect on focus */
        outline: none; /* Remove default focus outline */
    }

    input::placeholder {
        color: #aaa; /* Placeholder color */
        transition: color 0.3s ease; /* Smooth transition for placeholder color */
    }

    input:focus::placeholder {
        color: transparent; /* Hide placeholder text on focus */
    }
    button {
        border-radius: 20px;
        border: 1px solid #a45dff; /* Border color to match the gradient */
        background: #a45dff; /* Fallback color */
        background: -webkit-linear-gradient(to right, #a45dff, #6e1ab1); /* Purple gradient for WebKit browsers */
        background: linear-gradient(to right, #a45dff, #6e1ab1); /* Purple gradient for modern browsers */
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in, background-color 0.3s ease;
    }

    button:hover {
        background: #6e1ab1; /* Darker shade on hover */
        border-color: #6e1ab1; /* Match border color with hover background */
    }
/* Loader */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader-content {
    text-align: center;
}

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad;
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}

/* Box Loader */
.box-loader {
    width: 50px;
    height: 50px;
    margin: auto;
    position: relative;
}

.box-loader > div {
    position: absolute;
    width: 16px;
    height: 16px;
    background-color: #8e44ad;
    animation: box-loader 2s infinite ease-in-out;
}

.box-loader > div:nth-child(1) {
    top: 0;
    left: 0;
}

.box-loader > div:nth-child(2) {
    top: 0;
    right: 0;
    animation-delay: 0.5s;
}

.box-loader > div:nth-child(3) {
    bottom: 0;
    left: 0;
    animation-delay: 1.5s;
}

.box-loader > div:nth-child(4) {
    bottom: 0;
    right: 0;
    animation-delay: 1s;
}

@keyframes box-loader {
    0%, 100% {
        transform: scale(0.5);
        opacity: 0.5;
    }
    50% {
        transform: scale(1);
        opacity: 1;
    }
}
.notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 300px;
            display: none;
            z-index: 9999;
        }
        .notification.success {
            border-color: #4CAF50;
            color: #ffffff;
            background-color: #4CAF50;
        }
        .notification.error {
            border-color: #F44336;
            color: #ffffff;
            background-color: #F44336;
        }
        .notification .close {
            float: right;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            padding: 0 5px;
        }
    </style>
</head>
<body>
    <div id="loader" class="loader">
        <div class="loader-content">
            <div class="wave-loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Sign in</h1>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="{{ route('password.request') }}">Forgot your password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="vendor/adminlte/dist/img/whiteLOGO4.png" alt="Logo" class="logo" style="height: 100px"> <!-- Add your logo here -->
                    <h2>MHRPCI-HRIS</h2>
                    <p>Enter your personal details and start your journey with us</p>
                </div>
            </div>
        </div>
    </div>
    <div id="notification" class="notification"></div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let form = event.target;
            let formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                const notification = document.getElementById('notification');
                if (data.success) {
                    notification.className = 'notification success';
                    notification.innerHTML = `
                        <span>Login Successful! Redirecting...</span>
                        <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
                    `;
                    notification.style.display = 'block';
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500); // Show notification for 1.5 seconds
                } else {
                    let errorMessage = data.field === 'email' ? 'Invalid email address' : 'Invalid password';
                    notification.className = 'notification error';
                    notification.innerHTML = `
                        <span>${errorMessage}</span>
                        <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
                    `;
                    notification.style.display = 'block';
                }
            })
            .catch(error => {
                const notification = document.getElementById('notification');
                notification.className = 'notification error';
                notification.innerHTML = `
                    <span>Something went wrong. Please try again later.</span>
                    <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
                `;
                notification.style.display = 'block';
            });
        });

        // Loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            setTimeout(function() {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500); // Fade out transition time
            }, 2000); // Display loader for 2 seconds
        });
    </script>
</body>
</html>
