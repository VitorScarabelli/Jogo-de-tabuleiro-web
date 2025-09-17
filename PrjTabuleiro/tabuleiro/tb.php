<?php
// tb.php
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

  <div class="tabuleiro">
    <div class="trajeto">
      <svg width="1300" height="450" viewBox="0 0 1638 946" xmlns="http://www.w3.org/2000/svg">
        <ellipse class="casa" data-casa="1" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 819.098 910.372)" fill="#FF0000" />
        <ellipse class="casa" data-casa="2" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 722.575 866.502)" fill="#FF0000" />
        <ellipse class="casa" data-casa="3" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 646.589 822.631)" fill="#FF0000" />
        <ellipse class="casa" data-casa="4" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 571.629 779.353)" fill="#FF0000" />
        <ellipse class="casa" data-casa="5" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 495.643 735.482)" fill="#FF0000" />
        <ellipse class="casa" data-casa="6" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 420.683 692.204)" fill="#FF0000" />
        <ellipse class="casa" data-casa="7" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 344.697 648.333)" fill="#FF0000" />
        <ellipse class="casa" data-casa="8" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 269.737 605.056)" fill="#FF0000" />
        <ellipse class="casa" data-casa="9" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 193.751 561.185)" fill="#FF0000" />
        <ellipse class="casa" data-casa="10" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 118.792 517.907)" fill="#FF0000" />
        <ellipse class="casa" data-casa="11" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 42.8052 462.179)" fill="#FF0000" />
        <ellipse class="casa" data-casa="12" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 117.765 405.859)" fill="#FF0000" />
        <ellipse class="casa" data-casa="13" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 193.751 361.988)" fill="#FF0000" />
        <ellipse class="casa" data-casa="14" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 268.71 318.71)" fill="#FF0000" />
        <ellipse class="casa" data-casa="15" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 344.697 274.839)" fill="#FF0000" />
        <ellipse class="casa" data-casa="16" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 419.656 231.562)" fill="#FF0000" />
        <ellipse class="casa" data-casa="17" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 495.643 187.691)" fill="#FF0000" />
        <ellipse class="casa" data-casa="18" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 570.602 144.413)" fill="#FF0000" />
        <ellipse class="casa" data-casa="19" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 646.588 100.542)" fill="#FF0000" />
        <ellipse class="casa" data-casa="20" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 721.548 57.2639)" fill="#FF0000" />
        <ellipse class="casa" data-casa="21" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 819.098 13.9862)" fill="#FF0000" />
        <ellipse class="casa" data-casa="22" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 916.648 57.2639)" fill="#FF0000" />
        <ellipse class="casa" data-casa="23" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 991.608 100.542)" fill="#FF0000" />
        <ellipse class="casa" data-casa="24" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1067.59 144.413)" fill="#FF0000" />
        <ellipse class="casa" data-casa="25" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1142.55 187.69)" fill="#FF0000" />
        <ellipse class="casa" data-casa="26" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1218.54 231.562)" fill="#FF0000" />
        <ellipse class="casa" data-casa="27" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1293.5 274.839)" fill="#FF0000" />
        <ellipse class="casa" data-casa="28" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1369.49 318.71)" fill="#FF0000" />
        <ellipse class="casa" data-casa="29" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1444.45 361.988)" fill="#FF0000" />
        <ellipse class="casa" data-casa="30" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1520.43 405.859)" fill="#FF0000" />
        <ellipse class="casa" data-casa="31" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1595.39 462.179)" fill="#FF0000" />
        <ellipse class="casa" data-casa="32" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1519.4 517.907)" fill="#FF0000" />
        <ellipse class="casa" data-casa="33" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1444.45 561.185)" fill="#FF0000" />
        <ellipse class="casa" data-casa="34" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1368.46 605.056)" fill="#FF0000" />
        <ellipse class="casa" data-casa="35" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1293.5 648.333)" fill="#FF0000" />
        <ellipse class="casa" data-casa="36" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1217.51 692.204)" fill="#FF0000" />
        <ellipse class="casa" data-casa="37" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1142.55 735.482)" fill="#FF0000" />
        <ellipse class="casa" data-casa="38" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 1066.57 779.353)" fill="#FF0000" />
        <ellipse class="casa" data-casa="39" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 991.608 822.631)" fill="#FF0000" />
        <ellipse class="casa" data-casa="40" cx="11.857" cy="11.857" rx="11.857" ry="11.857" transform="matrix(0.866025 0.5 -0.866025 0.5 915.622 866.502)" fill="#FF0000" />
      </svg>
      <img src="./imageTabuleiro/BaseTabuleiro.png" class="BaseTabuleiro">
    </div>
  </div>
  <!-- UI do jogo -->
  <div id="jogo-ui">
    <div id="dado" onclick="rolarDado()">🎲</div>
    <div id="resultado-dado">Resultado: -</div>
  </div>

  <!-- Peças dos jogadores -->
  <div id="pecas-container">
    <div class="peca jogador1"></div>
    <div class="peca jogador2"></div>
    <div class="peca jogador3"></div>
    <div class="peca jogador4"></div>
  </div>
  
  <script>
    // Eventos selecionados vindos do PHP → JavaScript
    const eventosSelecionados = <?php echo json_encode($eventosSelecionados); ?>;
  </script>
  <script src="./tb.js"></script>
</body>

</html>