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
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex align-items-center">
        <div class="row justify-content-center w-100">

            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                    <div class="row g-0">

                        <!-- Lado esquerdo - Boas-vindas -->
                        <div class="col-md-5 bg-primary text-white d-flex align-items-center">
                            <div class="p-4 text-center">
                                <i class="bi bi-building fs-1 mb-3"></i>
                                <h4 class="fw-bold">Bem-vindo!</h4>
                                <p class="small mb-0">
                                    Ao <strong>Sistema de Gerenciamento de Salas</strong>.<br>
                                    Faça login para acessar o controle de reservas, usuários e ambientes.
                                </p>
                            </div>
                        </div>

                        <!-- Lado direito - Login -->
                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <?php
                                if (isset($_SESSION['msg'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg'] . '</div>';
                                    unset($_SESSION['msg']);
                                }
                                ?>


                                <h5 class="text-center mb-4">
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
                                            <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00" required>
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
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-door-open me-1"></i>
                                            Entrar
                                        </button>
                                    </div>

                                </form>

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