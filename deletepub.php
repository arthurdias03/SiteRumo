<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM arquivos";
if ($search) {
    $search = $conn->real_escape_string($search);
    $sql .= " WHERE nome_arquivo LIKE '%$search%' 
              OR descricao LIKE '%$search%' 
              OR categoria LIKE '%$search%' 
              OR ano LIKE '%$search%' 
              OR autor LIKE '%$search%' 
              OR periodo LIKE '%$search%'";
}
$result = $conn->query($sql);

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $id = intval($_POST['delete_id']);
        $deleteSql = "DELETE FROM arquivos WHERE id='$id'";
        if ($conn->query($deleteSql) === TRUE) {
            $message = 'Publicação excluída com sucesso!';
            $messageType = 'success';
            // Recarregar a consulta após exclusão
            $result = $conn->query($sql);
        } else {
            $message = 'Erro ao excluir publicação: ' . $conn->error;
            $messageType = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gerenciar e excluir publicações acadêmicas - Rumo à Educação Matemática Inclusiva">
    <title>Excluir Publicações - Rumo à Educação Matemática Inclusiva</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #17a2b8;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --text-dark: #333;
            --border-color: #dee2e6;
            --shadow: 0 4px 15px rgba(0,0,0,0.1);
            --gradient-primary: linear-gradient(135deg, #147df5ff 0%, #133efcff 100%);
            --gradient-danger: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Header - mantido original */
        

        .navbar{
            padding: 1rem;

        }


        /* Main Content */
        .main-content {
            padding: 3rem 0;
            min-height: calc(100vh - 200px);
        }

        .page-header {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-danger);
        }

        .page-title {
            color: var(--danger-color);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 2rem;
        }

        .page-subtitle {
            color: #6c757d;
            margin: 0.5rem 0 0 0;
            font-size: 1.1rem;
        }

        .warning-notice {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 1px solid #ffc107;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .warning-notice i {
            color: #856404;
            font-size: 1.25rem;
        }

        .warning-notice p {
            margin: 0;
            color: #856404;
            font-weight: 500;
        }

        /* Search Section */
        .search-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: slideInLeft 0.6s ease-out 0.2s both;
        }

        .search-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-input {
            border: 2px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--secondary-color);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
            background: white;
        }

        .btn-search {
            background: var(--gradient-primary);
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 10rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .table-title {
            color: var(--danger-color);
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-responsive {
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .table {
            margin: 0;
            font-size: 0.95rem;
        }

        .table thead th {
            background: var(--gradient-danger);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1.25rem 1rem;
            text-align: center;
            position: relative;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background: rgba(220, 53, 69, 0.05);
            transform: scale(1.01);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        .table tbody td:first-child {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Buttons */
        .btn-delete {
            background: var(--gradient-danger);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.875rem;
        }

        .btn-delete:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            animation: shake 0.5s ease-in-out;
        }

        .btn-delete:active {
            animation: pulse 0.6s;
        }

        /* Messages */
        .alert {
            border-radius: 0.75rem;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.6s ease-out;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .alert i {
            font-size: 1.25rem;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: var(--gradient-danger);
            color: white;
            border-radius: 1rem 1rem 0 0;
            padding: 1.5rem 2rem;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        .modal-body {
            padding: 2rem;
            text-align: center;
        }

        .delete-icon {
            font-size: 4rem;
            color: var(--danger-color);
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        .delete-message {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .publication-info {
            background: var(--secondary-color);
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 1rem 0;
            border-left: 4px solid var(--danger-color);
        }

        .btn-confirm-delete {
            background: var(--gradient-danger);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .btn-confirm-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #5a6268;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Footer - mantido original */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .footer .navbar-brand img {
            transition: all 0.3s ease;
            border-radius: 0.375rem;
            background: white;
            padding: 0.5rem;
            filter: brightness(1.1);
        }

        .footer .navbar-brand img:hover {
            transform: scale(1.05);
            filter: brightness(1.3);
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                text-align: center;
            }
            
            .table-responsive {
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 0.75rem 0.5rem;
            }
            
            .btn-delete {
                padding: 0.375rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        /* Accessibility */
        .sr-only {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Header - mantido original -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-body-blue" aria-label="Tenth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08"
                aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class=" nav-link2" aria-current="page" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2 " href="Sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" href="Equipe.php">Equipe </a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="publicacoesteste.php">Publicações</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="Aplicativos.php">Aplicativos</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="Materiais.php">Materiais</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="Contato.php">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="login.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="editpub.php">Editar</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="deletepub.php">deletar</a>
                    </li>
                    <li class="nav-item">
                          <a href="logout.php" class="  btn btn-danger" style="text-decoration: none; margin-left:2rem;font-weight:500">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Messages -->
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                    <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Page Header -->
            <section class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-trash-alt"></i>
                    Excluir Publicações
                </h1>
                <p class="page-subtitle">
                    Gerencie e remova publicações acadêmicas do projeto
                </p>
                <div class="warning-notice">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p><strong>Atenção:</strong> A exclusão de publicações é uma ação irreversível. Certifique-se antes de confirmar.</p>
                </div>
            </section>

            <!-- Search Section -->
            <section class="search-section">
                <h2 class="search-title">
                    <i class="fas fa-search"></i>
                    Buscar Publicações
                </h2>
                <form method="get" role="search" aria-label="Buscar publicações">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" name="search" 
                               placeholder="Digite nome do arquivo, autor, categoria ou qualquer termo..." 
                               value="<?php echo htmlspecialchars($search); ?>"
                               aria-label="Campo de busca">
                        <button class="btn btn-search" type="submit">
                            <i class="fas fa-search me-2"></i>
                            Buscar
                        </button>
                    </div>
                </form>
            </section>

            <!-- Table Section -->
            <section class="table-section">
                <div class="table-header">
                    <h2 class="table-title">
                        <i class="fas fa-list"></i>
                        Lista de Publicações
                    </h2>
                    <div class="table-info">
                        <span class="badge bg-danger">
                            <?php echo $result->num_rows; ?> publicações encontradas
                        </span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" role="table" aria-label="Tabela de publicações para exclusão">
                        <thead>
                            <tr>
                                <th scope="col">Arquivo</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Ano</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Período</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><strong>" . htmlspecialchars($row['nome_arquivo']) . "</strong></td>";
                                    echo "<td>" . (strlen($row['descricao']) > 50 ? substr(htmlspecialchars($row['descricao']), 0, 50) . '...' : htmlspecialchars($row['descricao'])) . "</td>";
                                    echo "<td><span class='badge bg-secondary'>" . htmlspecialchars($row['categoria']) . "</span></td>";
                                    echo "<td>" . htmlspecialchars($row['ano']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['periodo']) . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn-delete' onclick=\"confirmDelete(
                                        {$row['id']}, 
                                        '" . addslashes($row['nome_arquivo']) . "', 
                                        '" . addslashes($row['autor']) . "'
                                    )\" aria-label='Excluir publicação: " . htmlspecialchars($row['nome_arquivo']) . "'>";
                                    echo "<i class='fas fa-trash'></i> Excluir";
                                    echo "</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='7' class='empty-state'>";
                                echo "<i class='fas fa-search'></i>";
                                echo "<h4>Nenhuma publicação encontrada</h4>";
                                echo "<p>Tente ajustar os termos de busca ou verifique se há publicações cadastradas.</p>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="delete-icon">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <p class="delete-message">
                        Tem certeza que deseja excluir esta publicação?
                    </p>
                    <div class="publication-info" id="publicationInfo">
                        <!-- Informações da publicação serão inseridas aqui -->
                    </div>
                    <p class="text-muted">
                        <strong>Esta ação não pode ser desfeita!</strong>
                    </p>
                    <form method="post" id="deleteForm">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <button type="submit" class="btn-confirm-delete">
                            <i class="fas fa-trash me-2"></i>
                            Sim, Excluir
                        </button>
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer - mantido original -->
    <footer class="navbar fixed-bottom bg-footer">
        <div class="container-fluid">
            <a class="navbar-brand" href="Home.php"><img src="Img/icones/Logo_rumoPNG.png" alt="Logo" width="70"
                    height="50" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
            <div class="d-flex">
                <a class="navbar-brand"><img src="Img/icones/logo_fapesp.png" alt="Logo" width="90" height="50"
                        class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
                <a class="navbar-brand"><img src="Img/icones/CNPq_v2017_rgb.png" alt="Logo" width="90" height="40"
                        class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
                <a class="navbar-brand"><img src="Img/icones/banner_capes-1024x871.png" alt="Logo" width="70"
                        height="50" class="d-inline-block align-text-top"
                        style="margin-left: 15px; object-fit: contain;"></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(id, nomeArquivo, autor) {
            document.getElementById('delete_id').value = id;
            
            // Atualizar informações da publicação no modal
            const publicationInfo = document.getElementById('publicationInfo');
            publicationInfo.innerHTML = `
                <strong>Arquivo:</strong> ${nomeArquivo}<br>
                <strong>Autor:</strong> ${autor}
            `;

            var modalElement = document.getElementById('deleteModal');
            var modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            modalInstance.show();
        }

        // Funcionalidades adicionais
        document.addEventListener('DOMContentLoaded', function() {
            // Animação nos botões de excluir
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Auto-focus no campo de busca
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput && !searchInput.value) {
                searchInput.focus();
            }

            // Highlight dos termos de busca
            const searchTerm = '<?php echo addslashes($search); ?>';
            if (searchTerm) {
                const tableRows = document.querySelectorAll('tbody tr');
                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchTerm.toLowerCase())) {
                            cell.innerHTML = cell.innerHTML.replace(
                                new RegExp(searchTerm, 'gi'),
                                '<mark>$&</mark>'
                            );
                        }
                    });
                });
            }

            // Auto-hide de mensagens de sucesso/erro após 5 segundos
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });

            // Confirmação adicional para exclusão
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.addEventListener('submit', function(e) {
                const confirmButton = this.querySelector('.btn-confirm-delete');
                confirmButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Excluindo...';
                confirmButton.disabled = true;
            });
        });
    </script>
</body>
</html>

