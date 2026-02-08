<?php 
session_start();
include_once '../../model/sala.php';
$salaModel = new Sala(null, null);
$salas = $salaModel->listar_sala_bloco();

include_once '../../model/usuario.php';
$usuarios = new Usuario(null, null, null, null, null, null);
$lista_usuarios = $usuarios->listarUsuarios();

include_once '../../model/emprestimo.php';
$emprestimoModel = new emprestimo(null, null, null, null, null, null, null,null);

$salasOcupadas = [];

if (isset($_GET['data'], $_GET['periodo'])) {
    $data = $_GET['data'];
    $periodo = $_GET['periodo'];
    $emprestimos = $emprestimoModel->buscarEmprestimos($data, $periodo);
    $emprestimosDevolvidos= $emprestimoModel->buscarEmprestimosDevolvidos($data, $periodo);

  
$buscar = isset($_GET['buscar']) && $_GET['buscar'] === 'true';


    if (!empty($emprestimos)) {
        foreach ($emprestimos as $e) {
            if ($e['status_emprestimo'] == 1) {
                $salasOcupadas[$e['id_sala']] = true;
            }
        }
    }
}


?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Seleção de Salas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.card-box {
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.sala {
    height: 64px;
    border-radius: 12px;
    background-color: #0d6efd;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .2s ease;
    user-select: none;
    box-shadow: 0 4px 10px rgba(0,0,0,.15);
}

.sala-nome {
    color: #fff;
    font-size: .85rem;
    font-weight: 600;
    text-align: center;
}

.sala:hover {
    transform: scale(1.05);
    filter: brightness(1.1);
}

.sala.selecionada {
    background-color: #198754;
    box-shadow: 0 0 0 3px rgba(25,135,84,.4);
}

.sala-ocupada {
    background-color: #dc3545 !important;
    cursor: not-allowed;
    opacity: .8;
    box-shadow: none;
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ChaveCerta</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../view/painel/painel_geral.php">Painel</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Painel
          </a>
          <ul class="dropdown-menu">
            <li> <a class="dropdown-item" href="../../view/painel/painel.php">Painel p/ Usuario</a></li>
            <li><a class="dropdown-item" href="../../view/painel/painel_sala.php">Painel p/ Sala</a></li>
            <li><a class="dropdown-item" href="../../view/painel/painel_bloco.php">Painel p/ bloco</a></li>
          <li><a class="dropdown-item" href="../../view/painel/painel_geral.php">Painel Geral</a></li>
            </ul>
        </li>



        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../../view/bloco/cadastrar_bloco.php">Cadastrar Bloco</a></li>
            <li><a class="dropdown-item" href="../../view/sala/cadastrar_sala.php">Cadastrar Sala</a></li>
            <li><a class="dropdown-item" href="../../view/usuario/cadastro_usuario.php">Cadastrar Usuário</a></li>
          <li><a class="dropdown-item" href="../../view/usuario/listar_usuarios.php">Lista de Usuários</a></li>
            </ul>
        </li>
        <?php 
        if(isset($_SESSION['nome'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="../../controller/usuario/logout.php">Sair</a>
        </li>
        <?php  }  ?>

      </ul>
    
    </div>
  </div>
</nav>


<div class="container-xl py-4">

<h3 class="fw-bold mb-4">📋 Controle de Empréstimo de Salas</h3>


<!-- FORM BUSCA -->
<div class="card-box mb-4">
<form method="get" class="row g-3 align-items-end">

<div class="col-md-4">
    <label class="form-label fw-semibold">Data</label>
    <input type="date" name="data" class="form-control" value="<?= $_GET['data'] ?? '' ?>" required>
</div>

<div class="col-md-4">
    <label class="form-label fw-semibold">Período</label>
    <select name="periodo" class="form-select" required>
        <option value="matutino" <?= (@$_GET['periodo']=='matutino')?'selected':'' ?>>Matutino</option>
        <option value="vespertino" <?= (@$_GET['periodo']=='vespertino')?'selected':'' ?>>Vespertino</option>
        <option value="noturno" <?= (@$_GET['periodo']=='noturno')?'selected':'' ?>>Noturno</option>
    </select>
</div>

<div class="col-md-4">
    <button class="btn btn-primary w-100"  id="btnBuscar">🔍 Buscar Salas</button>
</div>

</form>
</div>

<?php if (isset($_GET['data'], $_GET['periodo'])): ?>

<form action="../../controller/emprestimo/registrar_emprestimo.php" method="post">

<input type="hidden" name="hora" id="hora">
<input type="hidden" name="data" value="<?= $_GET['data'] ?>">
<input type="hidden" name="periodo" value="<?= $_GET['periodo'] ?>">

<div class="card-box">

<h5 class="fw-semibold mb-3">
Salas – <?= $_GET['periodo'] ?> | <?= $_GET['data'] ?>
</h5>

   <?php if (isset($_SESSION['msg'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION['msg'] ?>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['msg']); 
    ?>


<!-- LEGENDA -->
<div class="d-flex gap-4 mb-4">
    <div class="d-flex align-items-center gap-2">
        <span style="width:16px;height:16px;background:#0d6efd;border-radius:4px;"></span> Livre
    </div>
    <div class="d-flex align-items-center gap-2">
        <span style="width:16px;height:16px;background:#198754;border-radius:4px;"></span> Selecionada
    </div>
    <div class="d-flex align-items-center gap-2">
        <span style="width:16px;height:16px;background:#dc3545;border-radius:4px;"></span> Ocupada
    </div>
</div>

<div class="mb-4">
<label class="form-label fw-semibold">Usuário responsável</label>
<select name="id_usuario" class="form-select shadow-sm" required>
<?php while($u = $lista_usuarios->fetch_assoc()): ?>
<option value="<?= $u['id_usuario'] ?>"><?= $u['nome_usuario'] ?></option>
<?php endwhile; ?>
</select>
</div>

<div class="mb-4">
<label class="form-label fw-semibold">Evento/turma</label>
<input type="text" name="evento" class="form-control" required>
</div>

<div class="accordion" id="accordionBlocos">
<?php
$blocoAtual = "";
$contador = 0;

while ($row = $salas->fetch_assoc()) {

    if ($blocoAtual != $row['nome_bloco']) {

        if ($blocoAtual != "") {
            echo "</div></div></div></div>";
        }

        $blocoAtual = $row['nome_bloco'];
        $contador++;
        $show = ($contador == 1) ? "show" : "";

        echo "
        <div class='accordion-item mb-3'>
            <h2 class='accordion-header'>
                <button type='button'
                        class='accordion-button ".($contador>1?'collapsed':'')." fw-semibold'
                        data-bs-toggle='collapse'
                        data-bs-target='#bloco$contador'>
                    🏢 Bloco {$blocoAtual}
                </button>
            </h2>

            <div id='bloco$contador' class='accordion-collapse collapse $show'>
                <div class='accordion-body'>
                    <div class='row row-cols-2 row-cols-md-4 g-3'>";
    }

    $ocupada = isset($salasOcupadas[$row['id_sala']]);
    $classe = $ocupada ? 'sala-ocupada' : '';

    echo "
    <div class='col'>
        <div class='sala $classe' data-id='{$row['id_sala']}'>
            <span class='sala-nome'>{$row['nome_sala']}</span>
        </div>
    </div>";
}

if ($blocoAtual != "") {
    echo "</div></div></div></div>";
}
?>
</div>

<button type="submit" class="btn btn-success btn-lg w-100 mt-4">
✔ Registrar Empréstimo
</button>

</div>
</form>
<?php endif; ?>

<div class="row">
    <h1>salas em uso</h1>

  <table class="table table-bordered table-hover mt-4">
    <thead class="table-dark">
        <tr>
            <th>Sala / Bloco</th>
            <th>Evento</th>
            <th>Período</th>
            <th>Usuário</th>
            <th>Data</th>
            <th>Hora retirada</th>
            <th>Hora entrega</th>
            <?php if ($_SESSION['nivel_acesso'] == 'admin' || $_SESSION['nivel_acesso'] == 'gerente' || $_SESSION['nivel_acesso'] == 'coordenador' || $_SESSION['nivel_acesso'] == 'portaria'): ?>
            <th>Devolução</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>

    <?php if (!empty($emprestimos)): ?>
        <?php foreach ($emprestimos as $e): ?>
            <?php if ($e['status_emprestimo'] == 1): ?>
            <tr>
                <td>
                    <?= $e['nome_sala'] ?> / <?= $e['nome_bloco'] ?>
                </td>
               <td><?= $e['evento'] ?></td>
                <td><?= $e['periodo'] ?></td>
                <td><?= $e['nome_usuario'] ?></td>
                <td><?= date('d/m/Y', strtotime($e['data_emprestimo'])) ?></td>
                <td><?= $e['hora_retirada'] ?></td>
                <td><?= $e['hora_devolucao'] ?? '-' ?></td>
                 <?php if ($_SESSION['nivel_acesso'] == 'admin' || $_SESSION['nivel_acesso'] == 'gerente' || $_SESSION['nivel_acesso'] == 'coordenador' || $_SESSION['nivel_acesso'] == 'portaria'): ?>
                <td>      
                    <form action="../../controller/emprestimo/devolucao_emprestimo.php" method="post">
                        <input type="hidden" name="periodo" value="<?= $_GET['periodo'] ?>">
                        <input type="hidden" name="data_emprestimo" value="<?= $e['data_emprestimo'] ?>">
                        <input type="hidden" name="id_emprestimo" value="<?= $e['id_emprestimo'] ?>">
                        <button class="btn btn-sm btn-success">Registrar Devolução</button>
                    </form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center text-muted">
                Nenhuma sala ocupada neste período
            </td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>


</div>

<div class="row">
    <h1> histórico do turno</h1>

  <table class="table table-bordered table-hover mt-4">
    <thead class="table-dark">
        <tr>
            <th>Sala / Bloco</th>
            <th>Evento</th>
            <th>Usuário</th>
            <th>Data</th>
            <th>Hora retirada</th>
            <th>Hora entrega</th>
            <?php if ($_SESSION['nivel_acesso'] == 'admin' || $_SESSION['nivel_acesso'] == 'gerente' || $_SESSION['nivel_acesso'] == 'coordenador' || $_SESSION['nivel_acesso'] == 'portaria'): ?>
            <th>Devolução</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>

    <?php if (!empty($emprestimosDevolvidos)): ?>
        <?php foreach ($emprestimosDevolvidos as $e): ?>
            <?php if ($e['status_emprestimo'] == 0): ?>
            <tr>
                <td>
                    <?= $e['nome_sala'] ?> / <?= $e['nome_bloco'] ?>
                </td>
                <td><?= $e['periodo'] ?></td>
                <td><?= $e['nome_usuario'] ?></td>
                <td><?= date('d/m/Y', strtotime($e['data_emprestimo'])) ?></td>
                <td><?= $e['hora_retirada'] ?></td>
                <td><?= $e['hora_devolucao'] ?? '-' ?></td>
                 <?php if ($_SESSION['nivel_acesso'] == 'admin' || $_SESSION['nivel_acesso'] == 'gerente' || $_SESSION['nivel_acesso'] == 'coordenador' || $_SESSION['nivel_acesso'] == 'portaria'): ?>
                <td>      
                    <form action="../../controller/emprestimo/devolucao_emprestimo.php" method="post">
                        <input type="hidden" name="data_emprestimo" value="<?= $e['data_emprestimo'] ?>">
                        <input type="hidden" name="id_emprestimo" value="<?= $e['id_emprestimo'] ?>">
                        <button class="btn btn-sm btn-success" disabled>Devolvido</button>
                    </form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center text-muted">
                Nenhuma sala ocupada neste período
            </td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>


</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
const agora = new Date();
document.getElementById('hora').value =
    agora.getHours().toString().padStart(2,'0') + ':' +
    agora.getMinutes().toString().padStart(2,'0');

let salasSelecionadas = [];
const form = document.querySelector('form[action*="registrar_emprestimo"]');

document.querySelectorAll('.sala').forEach(sala => {
    sala.addEventListener('click', () => {

        if (sala.classList.contains('sala-ocupada')) return;

        const id = sala.dataset.id;

        if (salasSelecionadas.includes(id)) {
            salasSelecionadas = salasSelecionadas.filter(s => s !== id);
            sala.classList.remove('selecionada');
        } else {
            salasSelecionadas.push(id);
            sala.classList.add('selecionada');
        }

        document.querySelectorAll('input[name="id_sala[]"]').forEach(i => i.remove());

        salasSelecionadas.forEach(idSala => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id_sala[]';
            input.value = idSala;
            form.appendChild(input);
        });
    });
});

form?.addEventListener('submit', e => {
    if (salasSelecionadas.length === 0) {
        e.preventDefault();
        alert('Selecione ao menos uma sala!');
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const buscar = <?= $buscar ? 'true' : 'false' ?>;

    if (buscar) {
        document.getElementById('btnBuscar').click();
    }
});
</script>

</body>
</html>
