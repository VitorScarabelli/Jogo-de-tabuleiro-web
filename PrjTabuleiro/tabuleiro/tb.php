<?php
$eventosSelecionados = [];

if (isset($_POST['eventos'])) {
    foreach ($_POST['eventos'] as $id => $dados) {
        if (isset($dados['ativo']) && !empty($dados['casa'])) {
            $eventosSelecionados[] = [
                'id' => $id,
                'nome' => $dados['nome'],
                'descricao' => $dados['descricao'],
                'modificador' => $dados['modificador'],
                'casa' => (int)$dados['casa']
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Tabuleiro com Eventos Escolhidos</title>
  <link rel="stylesheet" href="./tb.css">
</head>
<body>

  <h2>Tabuleiro com Eventos</h2>

  <div id="board"></div>

  <div id="controls">
    <button id="roll">Jogar dado</button>
    <span>Dado: <span id="dice">-</span></span>
    <span>Vez: <span id="turn">1</span></span>
  </div>

  <script>
    const eventos = <?php echo json_encode($eventosSelecionados, JSON_UNESCAPED_UNICODE); ?>;
  </script>
  <script src="./tb.js"></script>
</body>
</html>
