<?php
// Configurações de segurança
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Strict');

session_start();

// Regenerar ID da sessão para prevenir fixação
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Verificar se já está logado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: upload.php');
    exit;
}

$error = '';
$attempts = 0;
$lockout_time = 0;

// Sistema de proteção contra força bruta
if (isset($_SESSION['login_attempts'])) {
    $attempts = $_SESSION['login_attempts'];
    $last_attempt = $_SESSION['last_attempt'] ?? 0;
    
    // Lockout por 15 minutos após 5 tentativas
    if ($attempts >= 5) {
        $lockout_time = $last_attempt + (15 * 60); // 15 minutos
        if (time() < $lockout_time) {
            $remaining = $lockout_time - time();
            $error = "Muitas tentativas de login. Tente novamente em " . ceil($remaining / 60) . " minutos.";
        } else {
            // Reset após lockout
            $_SESSION['login_attempts'] = 0;
            $attempts = 0;
        }
    }
}

// Verificar token CSRF
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Token de segurança inválido.';
    } elseif (time() < $lockout_time) {
        // Ainda em lockout
        $remaining = $lockout_time - time();
        $error = "Muitas tentativas de login. Tente novamente em " . ceil($remaining / 60) . " minutos.";
    } else {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        // Validação básica
        if (empty($username) || empty($password)) {
            $error = 'Usuário e senha são obrigatórios.';
        } else {
            // Hash da senha armazenada (em produção, use banco de dados)
            $stored_username = 'rumoadmin';
            $stored_password_hash = password_hash('Rumo@2025', PASSWORD_DEFAULT);
            
            // Verificar credenciais com timing attack protection
            $username_valid = hash_equals($stored_username, $username);
            $password_valid = password_verify($password, $stored_password_hash);
            
            if ($username_valid && $password_valid) {
                // Login bem-sucedido
                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['login_time'] = time();
                $_SESSION['last_activity'] = time();
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                
                // Reset tentativas
                unset($_SESSION['login_attempts']);
                unset($_SESSION['last_attempt']);
                
                // Log de segurança
                error_log("Login bem-sucedido para usuário: $username em " . date('Y-m-d H:i:s'));
                
                header('Location: upload.php');
                exit;
            } else {
                // Login falhou
                $_SESSION['login_attempts'] = $attempts + 1;
                $_SESSION['last_attempt'] = time();
                
                // Log de segurança
                error_log("Tentativa de login falhada para usuário: $username em " . date('Y-m-d H:i:s') . " - IP: " . $_SERVER['REMOTE_ADDR']);
                
                $error = 'Usuário ou senha incorretos.';
                
                // Delay progressivo para dificultar ataques
                sleep(min($attempts, 3));
            }
        }
    }
}

// Gerar token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Administrativo - Rumo à Educação Matemática Inclusiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #17a2b8;
            --danger-color: #dc3545;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --text-dark: #333;
            --border-color: #dee2e6;
            --shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #669beaff 0%, #1990ffff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .login-header .content {
            position: relative;
            z-index: 1;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            backdrop-filter: blur(10px);
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .login-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--secondary-color);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
            background: white;
        }

        .input-group-text {
            background: var(--secondary-color);
            border: 2px solid var(--border-color);
            border-right: none;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .security-info {
            background: linear-gradient(135deg, rgba(44, 90, 160, 0.1), rgba(23, 162, 184, 0.1));
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .security-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .security-badge {
            background: rgba(44, 90, 160, 0.1);
            color: var(--primary-color);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 0.25rem;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .attempts-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .login-header, .login-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="content">
                <div class="logo-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1 class="login-title">Área Administrativa</h1>
                <p class="login-subtitle">Rumo à Educação Matemática Inclusiva</p>
            </div>
        </div>
        
        <div class="login-body">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($attempts > 0 && $attempts < 5): ?>
                <div class="attempts-warning">
                    <i class="fas fa-exclamation-circle"></i>
                    Tentativa <?php echo $attempts; ?> de 5. Cuidado com tentativas excessivas.
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="post" id="loginForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" class="form-control" id="username" name="username" 
                           placeholder="Nome de usuário" required autocomplete="username"
                           <?php echo (time() < $lockout_time) ? 'disabled' : ''; ?>>
                </div>
                
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Senha" required autocomplete="current-password"
                           <?php echo (time() < $lockout_time) ? 'disabled' : ''; ?>>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <div class="password-strength" id="passwordStrength" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Força da senha:</span>
                        <span id="strengthText">Fraca</span>
                    </div>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login" 
                        <?php echo (time() < $lockout_time) ? 'disabled' : ''; ?>>
                    <i class="fas fa-sign-in-alt me-2"></i>
                    <?php echo (time() < $lockout_time) ? 'Bloqueado' : 'Entrar'; ?>
                </button>
            </form>
            
            <div class="security-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-shield-check text-success me-2"></i>
                    <strong>Sistema Protegido</strong>
                </div>
                <div class="security-features">
                    <span class="security-badge">
                        <i class="fas fa-key me-1"></i>Criptografia
                    </span>
                    <span class="security-badge">
                        <i class="fas fa-ban me-1"></i>Anti-Força Bruta
                    </span>
                    <span class="security-badge">
                        <i class="fas fa-shield-alt me-1"></i>CSRF Protection
                    </span>
                    <span class="security-badge">
                        <i class="fas fa-clock me-1"></i>Sessão Segura
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('passwordStrength');
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            if (password.length === 0) {
                strengthDiv.style.display = 'none';
                return;
            }
            
            strengthDiv.style.display = 'block';
            
            let strength = 0;
            let text = 'Muito Fraca';
            let color = '#dc3545';
            
            // Length check
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;
            
            // Character variety checks
            if (/[a-z]/.test(password)) strength += 12.5;
            if (/[A-Z]/.test(password)) strength += 12.5;
            if (/[0-9]/.test(password)) strength += 12.5;
            if (/[^A-Za-z0-9]/.test(password)) strength += 12.5;
            
            if (strength >= 75) {
                text = 'Forte';
                color = '#28a745';
            } else if (strength >= 50) {
                text = 'Média';
                color = '#ffc107';
            } else if (strength >= 25) {
                text = 'Fraca';
                color = '#fd7e14';
            }
            
            strengthFill.style.width = strength + '%';
            strengthFill.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        });

        // Form security enhancements
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verificando...';
            submitBtn.disabled = true;
        });

        // Auto-focus on username field
        document.getElementById('username').focus();

        // Prevent multiple form submissions
        let formSubmitted = false;
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            if (formSubmitted) {
                e.preventDefault();
                return false;
            }
            formSubmitted = true;
        });

        // Security logging (client-side detection)
        if (window.location.protocol !== 'https:' && window.location.hostname !== 'localhost') {
            console.warn('⚠️ Conexão não segura detectada. Use HTTPS em produção.');
        }
    </script>
</body>
</html>

