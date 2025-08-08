<?php
// Configurações de segurança
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Strict');

session_start();

// Log de segurança antes do logout
if (isset($_SESSION['username'])) {
    error_log("Logout realizado por usuário: " . $_SESSION['username'] . " em " . date('Y-m-d H:i:s') . " - IP: " . $_SERVER['REMOTE_ADDR']);
}

// Limpar todas as variáveis de sessão
$_SESSION = array();

// Destruir o cookie de sessão se existir
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir a sessão
session_destroy();

// Regenerar ID de sessão para nova sessão
session_start();
session_regenerate_id(true);

// Headers de segurança para prevenir cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Verificar se foi um logout forçado por timeout ou segurança
$reason = '';
if (isset($_GET['timeout'])) {
    $reason = 'timeout';
} elseif (isset($_GET['security'])) {
    $reason = 'security';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Logout Realizado - Sistema Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #17a2b8;
            --success-color: #28a745;
            --danger-color: #dc3545;
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

        .logout-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            text-align: center;
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

        .logout-header {
            background: linear-gradient(135deg, var(--success-color), #1e7e34);
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .logout-header.timeout {
            background: linear-gradient(135deg, var(--warning-color), #e0a800);
        }

        .logout-header.security {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
        }

        .logout-header::before {
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

        .logout-header .content {
            position: relative;
            z-index: 1;
        }

        .logout-icon {
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

        .logout-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .logout-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .logout-body {
            padding: 2rem;
        }

        .logout-message {
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .security-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeout-warning {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
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

        .security-tips {
            background: linear-gradient(135deg, rgba(44, 90, 160, 0.1), rgba(23, 162, 184, 0.1));
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6c757d;
            text-align: left;
        }

        .security-tips h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .security-tips ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .security-tips li {
            margin-bottom: 0.25rem;
        }

        .countdown {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 1rem;
        }

        @media (max-width: 576px) {
            .logout-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .logout-header, .logout-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-header <?php echo $reason; ?>">
            <div class="content">
                <div class="logout-icon">
                    <?php if ($reason === 'timeout'): ?>
                        <i class="fas fa-clock"></i>
                    <?php elseif ($reason === 'security'): ?>
                        <i class="fas fa-shield-alt"></i>
                    <?php else: ?>
                        <i class="fas fa-sign-out-alt"></i>
                    <?php endif; ?>
                </div>
                <h1 class="logout-title">
                    <?php if ($reason === 'timeout'): ?>
                        Sessão Expirada
                    <?php elseif ($reason === 'security'): ?>
                        Logout de Segurança
                    <?php else: ?>
                        Logout Realizado
                    <?php endif; ?>
                </h1>
                <p class="logout-subtitle">Sistema Administrativo</p>
            </div>
        </div>
        
        <div class="logout-body">
            <?php if ($reason === 'timeout'): ?>
                <div class="timeout-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Sua sessão expirou por inatividade.</strong><br>
                        Por segurança, você foi desconectado automaticamente após 30 minutos de inatividade.
                    </div>
                </div>
            <?php elseif ($reason === 'security'): ?>
                <div class="security-warning">
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <strong>Logout realizado por motivos de segurança.</strong><br>
                        Detectamos uma possível tentativa de sequestro de sessão. Sua conta foi protegida automaticamente.
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="logout-message">
                <?php if ($reason === 'timeout'): ?>
                    Você foi desconectado com segurança do sistema administrativo.
                <?php elseif ($reason === 'security'): ?>
                    Sua sessão foi encerrada como medida de proteção.
                <?php else: ?>
                    Você foi desconectado com sucesso do sistema administrativo.
                <?php endif; ?>
                <br><br>
                <strong>Todas as suas informações foram protegidas.</strong>
            </div>
            
            <a href="login.php" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>
                Fazer Login Novamente
            </a>
            
            <div class="security-tips">
                <h6><i class="fas fa-lightbulb me-1"></i> Dicas de Segurança</h6>
                <ul>
                    <li>Sempre faça logout ao terminar de usar o sistema</li>
                    <li>Não compartilhe suas credenciais de acesso</li>
                    <li>Use uma senha forte e única</li>
                    <li>Mantenha seu navegador atualizado</li>
                    <?php if ($reason === 'security'): ?>
                        <li><strong>Verifique se não há pessoas não autorizadas próximas</strong></li>
                        <li><strong>Considere trocar sua senha se suspeitar de comprometimento</strong></li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="countdown">
                <i class="fas fa-info-circle"></i>
                Redirecionamento automático em <span id="countdown">10</span> segundos
            </div>
        </div>
    </div>

    <script>
        // Countdown para redirecionamento automático
        let countdown = 10;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = 'login.php';
            }
        }, 1000);
        
        // Limpar histórico do navegador para prevenir volta
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        
        // Prevenir volta com botão do navegador
        window.addEventListener('popstate', function(event) {
            window.location.href = 'login.php';
        });
        
        // Limpar cache e dados sensíveis
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for(let registration of registrations) {
                    registration.unregister();
                }
            });
        }
        
        // Limpar localStorage e sessionStorage
        try {
            localStorage.clear();
            sessionStorage.clear();
        } catch(e) {
            console.log('Não foi possível limpar o storage local');
        }
        
        // Log de segurança no console
        console.log('🔒 Logout seguro realizado em ' + new Date().toLocaleString());
        
        // Prevenir ações do usuário durante o countdown
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F5' || (e.ctrlKey && e.key === 'r')) {
                e.preventDefault();
                window.location.href = 'login.php';
            }
        });
    </script>
</body>
</html>

