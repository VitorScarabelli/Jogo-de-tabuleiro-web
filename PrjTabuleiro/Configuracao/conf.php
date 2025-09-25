<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>configurações</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <img class="background" src="images/fundo.png" alt="Fundo do jogo">

    <div class="left">
        <a href="../index/index.php"><img src="./images/Botões/BackButton.svg" alt="" width="70px" height="70px"></img></a>
        <a href="../index/index.php"><img src="./images/Botões/HomeButton.svg" alt="" width="70px" height="70px"></img></a>
    </div>
    <div class="right">
        <a href="#"><img src="./images/Botões/MusicButton.svg" alt="" width="70px" height="70px"></img></a>
        <a href="#"><img src="./images/Botões/ConfigButton.svg" alt="" width="70px" height="70px"></img></a>
    </div>

    <div class="container">
        <h1 class="titulo">CONFIGURAÇÕES</h1>
    </div>

    <div class="main-buttons">
        <div class="btn-wrapper">
            <img src="./images/caderno.png" alt="LOGIN">
            <button onclick="AumentarFonte()" id="btn-aumentar"><span>AUMENTAR FONTE</span></button>
        </div>
        <div class="btn-wrapper">
            <img src="./images/caderno.png" alt="LOGIN">
            <button id="btn-parar"><span>PARAR MÚSICA</span></button>
        </div>
    </div>

    <a href="../Tabuleiro/selecaoEventos.php">clique aq</a>

    

    <audio id="musica" preload="metadata" autoplay muted>
    <source src="../Musica/musica.mp3" type="audio/mp3">
    <source src="../Musica/musica.ogg" type="audio/ogg">
    <source src="../Musica/musica.wav" type="audio/wav">
  </audio>

  <div class="btn-box">
    <button id="btn-pausar">Pausar música</button>
  </div>

  <script src="../Configuracao/js/script.js"></script>
  <script src="../Musica/js/script.js"></script>
</body>
</html>