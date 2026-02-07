<?php
include_once '../../model/sala.php';

$salaModel = new Sala(null, null);
$salas = $salaModel->listarSalas();
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seleção de Salas</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .sala {
      height: 60px;
      border-radius: 8px;
      background-color: #0d6efd;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }

    .sala-nome {
      color: #ffffff;
      font-size: 0.8rem;
      font-weight: 600;
    }

    /* efeito hover */
    .sala:hover {
      filter: brightness(1.1);
    }

    /* sala selecionada */
    .sala.selecionada {
      background-color: #198754; /* verde */
      box-shadow: 0 0 0 3px rgba(25,135,84,.5);
    }
  </style>
</head>

<body class="bg-light">

<div class="container mt-4">

  <div class="accordion" id="accordionBlocos">

    <!-- BLOCO A -->
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#blocoA">
          Bloco A
        </button>
      </h2>

      <div id="blocoA" class="accordion-collapse collapse show">
        <div class="accordion-body">

          <div class="row row-cols-4 g-3 mb-3">
            <div class="col"><div class="sala"><span class="sala-nome">Sala 101</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 102</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 103</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 104</span></div></div>
          </div>

          <div class="row row-cols-4 g-3">
            <div class="col"><div class="sala"><span class="sala-nome">Sala 105</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 106</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 107</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 108</span></div></div>
          </div>

        </div>
      </div>
    </div>

    <!-- BLOCO B -->
    <div class="accordion-item mt-3">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#blocoB">
          Bloco B
        </button>
      </h2>

      <div id="blocoB" class="accordion-collapse collapse">
        <div class="accordion-body">

          <div class="row row-cols-4 g-3 mb-3">
            <div class="col"><div class="sala"><span class="sala-nome">Sala 201</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 202</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 203</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 204</span></div></div>
          </div>

          <div class="row row-cols-4 g-3">
            <div class="col"><div class="sala"><span class="sala-nome">Sala 205</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 206</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 207</span></div></div>
            <div class="col"><div class="sala"><span class="sala-nome">Sala 208</span></div></div>
          </div>

        </div>
      </div>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.querySelectorAll('.sala').forEach(sala => {
    sala.addEventListener('click', () => {
      sala.classList.toggle('selecionada');
    });
  });
</script>

</body>
</html>
