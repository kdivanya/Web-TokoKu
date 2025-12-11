<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Tokoku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow-y: auto;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            padding: 40px 0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('images/background.jpg') }}') center/cover;
            opacity: 0.3;
            z-index: 0;
        }

        .shape {
            position: fixed;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite;
            z-index: 0;
            transition: all 0.1s ease-out;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 80%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 70%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-50px) rotate(180deg);
            }
        }

        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 380px;
            padding: 20px;
            perspective: 1000px;
            transition: transform 0.1s ease-out;
        }

        .card-wrapper {
            position: relative;
            width: 100%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .card-wrapper.flipped {
            transform: rotateY(180deg);
        }

        .card-wrapper.shake {
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0) rotateY(0deg); }
            25% { transform: translateX(-10px) rotateY(0deg); }
            75% { transform: translateX(10px) rotateY(0deg); }
        }

        .card-wrapper.shake.flipped {
            animation: shakeFlipped 0.5s;
        }

        @keyframes shakeFlipped {
            0%, 100% { transform: translateX(0) rotateY(180deg); }
            25% { transform: translateX(-10px) rotateY(180deg); }
            75% { transform: translateX(10px) rotateY(180deg); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backface-visibility: hidden;
        }

        .login-card {
            transform: rotateY(0deg);
        }

        .register-card {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            transform: rotateY(180deg);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(102, 126, 234, 0.3);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
            }
        }

        .logo-icon i {
            font-size: 30px;
            color: white;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group-custom {
            position: relative;
            transition: transform 0.3s ease;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 18px;
            z-index: 2;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 18px;
            cursor: pointer;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.9);
            transform: translateY(-50%) scale(1.1);
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 14px 50px 14px 55px;
            color: white;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            outline: none;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 16px;
            padding: 14px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
        }

        /* Ripple Effect */
        .btn-primary-custom .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Loading State */
        .btn-primary-custom.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-primary-custom.loading .btn-text {
            opacity: 0;
        }

        .btn-primary-custom .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
        }

        .btn-primary-custom.loading .spinner {
            display: block;
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .switch-text {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-top: 25px;
        }

        .switch-link {
            color: white;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .switch-link:hover {
            color: #ffd700;
            border-bottom-color: #ffd700;
        }

        .alert-custom {
            background: rgba(220, 53, 69, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(220, 53, 69, 0.4);
            border-radius: 12px;
            color: white;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer-text {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>

    <div class="auth-container" id="authContainer">
        <div class="card-wrapper" id="cardWrapper">
            <div class="glass-card login-card">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <h1 class="logo-text">Tokoku</h1>
                    <p class="subtitle">Selamat datang kembali!</p>
                </div>

                @if(session('error'))
                    <div class="alert-custom">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="/login" id="loginForm">
                    @csrf
                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control-custom" placeholder="Email address" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="loginPassword" class="form-control-custom" placeholder="Password" required>
                            <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-custom" id="loginBtn">
                        <span class="btn-text"><i class="fas fa-sign-in-alt"></i> Masuk</span>
                        <div class="spinner"></div>
                    </button>
                </form>

                <p class="switch-text">
                    Belum punya akun? <a class="switch-link" onclick="switchToRegister()">Daftar sekarang</a>
                </p>

                <p class="footer-text">
                    <i class="fas fa-shield-alt"></i> Login aman dan terenkripsi
                </p>
            </div>

            <div class="glass-card register-card">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1 class="logo-text">Tokoku</h1>
                    <p class="subtitle">Buat akun baru!</p>
                </div>

                @if($errors->any())
                    <div class="alert-custom">
                        <i class="fas fa-exclamation-circle"></i> 
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="/register" id="registerForm">
                    @csrf
                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="name" class="form-control-custom" placeholder="Nama lengkap" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control-custom" placeholder="Email address" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="tel" name="phone" class="form-control-custom" placeholder="Nomor telepon" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="registerPassword" class="form-control-custom" placeholder="Password" required>
                            <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('registerPassword', this)"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password_confirmation" id="registerPasswordConfirm" class="form-control-custom" placeholder="Konfirmasi password" required>
                            <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('registerPasswordConfirm', this)"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-custom" id="registerBtn">
                        <span class="btn-text"><i class="fas fa-user-plus"></i> Daftar</span>
                        <div class="spinner"></div>
                    </button>
                </form>

                <p class="switch-text">
                    Sudah punya akun? <a class="switch-link" onclick="switchToLogin()">Masuk di sini</a>
                </p>

                <p class="footer-text">
                    <i class="fas fa-shield-alt"></i> Data anda aman bersama kami
                </p>
            </div>
        </div>
    </div>

    <script>
        const cardWrapper = document.getElementById('cardWrapper');
        const authContainer = document.getElementById('authContainer');
        const body = document.body;

        function switchToRegister() {
            cardWrapper.classList.add('flipped');
        }

        function switchToLogin() {
            cardWrapper.classList.remove('flipped');
        }

        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        function createRipple(event) {
            const button = event.currentTarget;
            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            button.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        }

        document.querySelectorAll('.btn-primary-custom').forEach(button => {
            button.addEventListener('click', createRipple);
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('registerBtn');
            btn.classList.add('loading');
        });

        document.addEventListener('mousemove', (e) => {
            const shapes = document.querySelectorAll('.shape');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 10;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });

            const cardX = (mouseX - 0.5) * 15;
            const cardY = (mouseY - 0.5) * 15;
            authContainer.style.transform = `translate(${cardX}px, ${cardY}px)`;
        });

        document.querySelectorAll('.form-control-custom').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>