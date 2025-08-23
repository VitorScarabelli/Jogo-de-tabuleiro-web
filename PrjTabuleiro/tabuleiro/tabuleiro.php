<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dado + Peões em estilo Ludo</title>
  <style>
    body {
      margin: 0;
      background-color: #cfcfcf;
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    #cube-container {
      width: 80px;
      height: 80px;
      position: fixed;
      top: 20px;
      left: 20px;
      transform-style: preserve-3d;
      transition: transform 1s ease-in-out;
      cursor: pointer;
      z-index: 10;
    }

    .face {
      position: absolute;
      width: 80px;
      height: 80px;
      background: linear-gradient(145deg, #f0f0f0, #dcdcdc);
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: repeat(3, 1fr);
      padding: 10px;
      box-sizing: border-box;
    }

    .front  { transform: translateZ(40px); }
    .back   { transform: rotateY(180deg) translateZ(40px); }
    .right  { transform: rotateY(90deg) translateZ(40px); }
    .left   { transform: rotateY(-90deg) translateZ(40px); }
    .top    { transform: rotateX(90deg) translateZ(40px); }
    .bottom { transform: rotateX(-90deg) translateZ(40px); }

    .dot {
      width: 12px;
      height: 12px;
      background-color: black;
      border-radius: 50%;
      justify-self: center;
      align-self: center;
      opacity: 0;
      transition: opacity 0.15s ease-in-out;
    }

    .dot.visible { opacity: 1; }
    .face1-dot5 { background-color: red !important; }

    .pos1 { grid-area: 1 / 1; }
    .pos2 { grid-area: 1 / 2; }
    .pos3 { grid-area: 1 / 3; }
    .pos4 { grid-area: 2 / 1; }
    .pos5 { grid-area: 2 / 2; }
    .pos6 { grid-area: 2 / 3; }
    .pos7 { grid-area: 3 / 1; }
    .pos8 { grid-area: 3 / 2; }
    .pos9 { grid-area: 3 / 3; }

    #board {
      display: grid;
      grid-template-columns: repeat(7, 60px);
      grid-template-rows: repeat(7, 60px);
      gap: 4px;
      background: #aaa;
      padding: 10px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .cell {
      width: 60px;
      height: 60px;
      background-color: #fff;
      border-radius: 6px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-template-rows: repeat(2, 1fr);
      place-items: center;
      font-weight: bold;
      font-size: 14px;
      color: #222;
      position: relative;
      transition: background-color 0.3s ease;
      overflow: visible;
    }

    .cell.path { background-color: #7ad3f8; }
    .cell.start { background-color: #a3fca3; }
    .cell.end { background-color: #ff7e7e; }
    .empty { background-color: transparent; box-shadow: none; }

    .pawn {
      font-size: 18px;
      position: static;
    }
  </style>
</head>
<body>

  <div id="cube-container" title="Clique para lançar dado">
    <div class="face front"></div>
    <div class="face back"></div>
    <div class="face right"></div>
    <div class="face left"></div>
    <div class="face top"></div>
    <div class="face bottom"></div>
  </div>

  <div id="board"></div>

  <script>
    // Dado 3D
    const cube = document.getElementById('cube-container');

    const dotMap = {
      1: [5], 2: [1, 9], 3: [1, 5, 9],
      4: [1, 3, 7, 9], 5: [1, 3, 5, 7, 9],
      6: [1, 3, 4, 6, 7, 9]
    };

    const faces = {
      1: cube.querySelector('.front'), 2: cube.querySelector('.back'),
      3: cube.querySelector('.right'), 4: cube.querySelector('.left'),
      5: cube.querySelector('.top'),   6: cube.querySelector('.bottom')
    };

    function setupFaces() {
      for (let num = 1; num <= 6; num++) {
        const face = faces[num];
        face.innerHTML = '';
        for (let pos = 1; pos <= 9; pos++) {
          const dot = document.createElement('div');
          dot.classList.add('dot', `pos${pos}`);
          if (dotMap[num].includes(pos)) dot.classList.add('visible');
          if (num === 1 && pos === 5) dot.classList.add('face1-dot5');
          face.appendChild(dot);
        }
      }
    }

    const rotations = {
      1: { x: 0,   y: 0 },
      2: { x: 0,   y: 180 },
      3: { x: 0,   y: -90 },
      4: { x: 0,   y: 90 },
      5: { x: 90,  y: 0 },
      6: { x: -90, y: 0 }
    };

    setupFaces();

    // TABULEIRO
    const board = document.getElementById('board');

    const pathIndexes = [
      0,1,2,3,4,5,6,
      13,20,27,34,41,48,
      47,46,45,44,43,42,
      35,28,21,14,7
    ]; // 24 casas

    const allCells = [];

    for (let i = 0; i < 49; i++) {
      const cell = document.createElement('div');
      if (pathIndexes.includes(i)) {
        cell.classList.add('cell', 'path');
        const step = pathIndexes.indexOf(i);
        cell.dataset.step = step;
        if (step === 0) cell.classList.add('start');
        if (step === pathIndexes.length - 1) cell.classList.add('end');
      } else {
        cell.classList.add('cell', 'empty');
      }
      board.appendChild(cell);
      allCells.push(cell);
    }

    // Jogadores
    const players = [
      { emoji: '⚫', position: 0 },
      { emoji: '🔴', position: 0 },
      { emoji: '🔵', position: 0 },
      { emoji: '🟢', position: 0 }
    ];

    let currentPlayer = 0;

    function placeAllPawns() {
      // Limpa todos os peões
      document.querySelectorAll('.pawn').forEach(p => p.remove());

      // Para cada jogador, coloca seu peão na célula correspondente
      players.forEach(player => {
        const cellIndex = pathIndexes[player.position];
        const cell = allCells[cellIndex];
        if (!cell) return; // segurança

        const pawn = document.createElement('div');
        pawn.className = 'pawn';
        pawn.textContent = player.emoji;
        cell.appendChild(pawn);
      });
    }

    function movePawn(playerIndex, steps) {
      let target = players[playerIndex].position + steps;
      if (target >= pathIndexes.length) target = pathIndexes.length - 1;

      let current = players[playerIndex].position;

      const interval = setInterval(() => {
        if (current >= target) {
          clearInterval(interval);
          // Passa a vez para o próximo jogador
          currentPlayer = (currentPlayer + 1) % players.length;
          return;
        }
        current++;
        players[playerIndex].position = current;
        placeAllPawns();
      }, 300);
    }

    // Inicializa a posição dos peões
    placeAllPawns();

    // Clique no dado para jogar e mover o peão do jogador atual
    cube.addEventListener('click', () => {
      const number = Math.floor(Math.random() * 6) + 1;
      const rot = rotations[number];
      cube.style.transform = `rotateX(${rot.x}deg) rotateY(${rot.y}deg)`;
      movePawn(currentPlayer, number);
    });
  </script>

</body>
</html>