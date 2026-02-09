<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema de Gerenciamento de Salas</title>

    <!-- Bootstrap 5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
        }

        .card {
            border-radius: 1rem;
        }

        .brand-box {
            background: linear-gradient(160deg, #0d6efd, #084298);
        }

        .brand-box h4 {
            letter-spacing: 0.5px;
        }

        .footer-credit {
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-9 col-lg-7">

            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">

                    <!-- Lado esquerdo -->
                    <div class="col-md-5 brand-box text-white d-flex align-items-center">
                        <div class="p-4 text-center w-100">
                            <i class="bi bi-building fs-1 mb-3"></i>
                            <h4 class="fw-bold">Bem-vindo!</h4>
                            <p class="small mb-3">
                                Sistema de Gerenciamento de Salas<br>
                                <strong>Versão 0001 • Beta</strong>
                            </p>

                            <hr class="border-light">

                            <p class="small mb-0">
                                Projeto desenvolvido para o<br>
                                <strong>SENAI – Corumbá/MS</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Lado direito -->
                    <div class="col-md-7">
                        <div class="card-body p-4 p-md-5">

                            <?php
                            if (isset($_SESSION['msg'])) {
                                echo '<div class="alert alert-danger text-center">' . $_SESSION['msg'] . '</div>';
                                unset($_SESSION['msg']);
                            }
                            ?>

                            <h5 class="text-center mb-4 fw-semibold">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                Acesso ao Sistema
                            </h5>

                            <form action="../../controller/usuario/login_usuario.php" method="post">

                                <!-- CPF -->
                                <div class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-vcard"></i>
                                        </span>
                                        <input type="text" id="cpf" name="cpf" class="form-control"
                                            placeholder="000.000.000-00" required>
                                    </div>
                                </div>

                                <!-- Senha -->
                                <div class="mb-4">
                                    <label for="senha" class="form-label">Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" id="senha" name="senha" class="form-control" required>
                                    </div>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-door-open me-1"></i>
                                        Entrar
                                    </button>
                                </div>

                            </form>

                            <!-- Rodapé -->
                            <div class="text-center footer-credit mt-4">
                                Desenvolvido por <strong>Instrutor Lucas</strong><br>
                                SENAI – Corumbá/MS
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
