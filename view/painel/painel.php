<?php
include_once '../../model/usuario.php';
include_once '../../model/emprestimo.php';
$usuarios = new Usuario(null, null, null, null, null, null);
$lista_usuarios = $usuarios->listarUsuarios();

if(isset($_GET['id_usuario']) && isset($_GET['data_inicial']) && isset($_GET['data_final'])){
    $emprestimo = new Emprestimo(null, null, null, null, null, $_GET['id_usuario'], null, null);
    $emprestimos = $emprestimo->buscarEmprestimoData($_GET['id_usuario'], $_GET['data_inicial'], $_GET['data_final']);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col-6">
                <form action="#" method="get">

            <div class="mb-4">
                <label class="form-label fw-semibold">Usuário responsável</label>
                <select name="id_usuario" class="form-select shadow-sm" required>
                <?php while($u = $lista_usuarios->fetch_assoc()): ?>
                <option value="<?= $u['id_usuario'] ?>"><?= $u['nome_usuario'] ?></option>
                <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Data Inicial</label>
                <input type="date" name="data_inicial" class="form-control" value="<?= $_GET['data_inicial'] ?? '' ?>" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Data Final</label>
                <input type="date" name="data_final" class="form-control" value="<?= $_GET['data_final'] ?? '' ?>" required>
            </div>

            <input type="submit" class="btn btn-primary mt-4" value="Gerar Relatório">
            </form>
        </div>
    </div>

    <div class="row">
        <?php if(isset($_GET['id_usuario']) && isset($_GET['data_inicial']) && isset($_GET['data_final'])){ ?>
          
            <h3>Relatório de Empréstimos</h3>
            <p>Período: <?= date('d/m/Y', strtotime($_GET['data_inicial'])) ?> a <?= date('d/m/Y', strtotime($_GET['data_final'])) ?></p>
            <!-- Aqui você pode adicionar a lógica para buscar e exibir os dados do relatório com base nos filtros selecionados -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Empréstimo</th>
                        <th>Data Empréstimo</th>
                        <th>Hora Retirada</th>
                        <th>Hora Devolução</th>
                        <th>Período</th>
                        <th>Status Empréstimo</th>
                        <th>Evento/Turma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($emprestimos as $emp): ?>
                    <tr>
                        <td><?= $emp['id_emprestimo'] ?></td>
                        <td><?= date('d/m/Y', strtotime($emp['data_emprestimo'])) ?></td>
                        <td><?= date('H:i', strtotime($emp['hora_retirada'])) ?></td>
                        <td><?= date('H:i', strtotime($emp['hora_devolucao'])) ?></td>
                        <td><?= ucfirst($emp['periodo']) ?></td>
                        <td><?= $emp['status_emprestimo'] == 1 ? 'Em Andamento' : 'Devolvido' ?></td>
                        <td><?= $emp['evento'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

      
            <?php }  ?>
    </div>
  </div>

  
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>



