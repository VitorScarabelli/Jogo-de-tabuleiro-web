document.addEventListener("DOMContentLoaded", () => {
  // Marca casas com eventos
  eventosSelecionados.forEach(ev => {
    const casa = document.querySelector(`.casa[data-casa="${ev.casa}"]`);
    if (casa) {
      casa.setAttribute("fill", "yellow"); // muda a cor da casa

      // guarda os dados do evento diretamente no elemento
      casa.dataset.nome = ev.nome;
      casa.dataset.descricao = ev.descricao;
      casa.dataset.modificador = ev.modificador;
    }
  });
});


// Pegando todas as casas em ordem no SVG (bolinhas vermelhas)
const casas = Array.from(document.querySelectorAll('.casa'));
const totalCasas = casas.length;

// Jogadores com suas peças
const jogadores = [
  { nome: "Jogador 1", pos: 0, peca: document.querySelector('.jogador1') },
  { nome: "Jogador 2", pos: 0, peca: document.querySelector('.jogador2') },
  { nome: "Jogador 3", pos: 0, peca: document.querySelector('.jogador3') },
  { nome: "Jogador 4", pos: 0, peca: document.querySelector('.jogador4') }
];

let jogadorAtual = 0;

// Quando a página carregar, posiciona os jogadores na primeira casa inferior
window.onload = () => {
  posicionarPecasIniciais();
};

function posicionarPecasIniciais() {
  const casaInicial = casas[0]; // Primeira casa (mais inferior no trajeto)
  const bbox = casaInicial.getBoundingClientRect();
  const svgBox = document.querySelector("svg").getBoundingClientRect();

  const baseX = bbox.left - svgBox.left;
  const baseY = bbox.top - svgBox.top;

  // Offsets para não sobrepor as peças
  const offsets = [
    [0, 0],
    [14, 0],
    [0, 14],
    [14, 14]
  ];

  jogadores.forEach((jogador, i) => {
    const [dx, dy] = offsets[i];
    jogador.peca.style.left = `${baseX + dx}px`;
    jogador.peca.style.top = `${baseY + dy}px`;
    jogador.pos = 0;
  });
}

function rolarDado() {
  const resultado = Math.floor(Math.random() * 6) + 1;
  document.getElementById("resultado-dado").innerText = `Resultado: ${resultado}`;
  moverJogador(resultado);

  verificarEvento(jogadores[jogadorAtual].pos);

}

function moverJogador(valor) {
  const jogador = jogadores[jogadorAtual];

  // Atualiza a posição do jogador no caminho (não pode passar do final)
  jogador.pos = Math.min(jogador.pos + valor, totalCasas - 1);

  const casa = casas[jogador.pos];
  const bbox = casa.getBoundingClientRect();
  const svgBox = document.querySelector("svg").getBoundingClientRect();

  const offsetX = bbox.left - svgBox.left;
  const offsetY = bbox.top - svgBox.top;

  // Offsets para não sobrepor quando mais de um jogador está na mesma casa
  const offsets = [
    [0, 0],
    [14, 0],
    [0, 14],
    [14, 14]
  ];
  const [dx, dy] = offsets[jogadorAtual];

  // Atualiza posição da peça
  jogador.peca.style.left = `${offsetX + dx}px`;
  jogador.peca.style.top = `${offsetY + dy}px`;

  function verificarEvento(posicaoCasa) {
    const casa = document.querySelector(`.casa[data-casa="${posicaoCasa}"]`);
    if (casa && casa.dataset.nome) {
      abrirPopup({
        nome: casa.dataset.nome,
        descricao: casa.dataset.descricao,
        modificador: casa.dataset.modificador
      });
    }
  }


  // Próximo jogador
  jogadorAtual = (jogadorAtual + 1) % jogadores.length;
}

// Função que mostra o popup com as infos do evento
function mostrarPopup(evento) {
  const popup = document.createElement("div");
  popup.classList.add("popup-evento");
  popup.innerHTML = `
    <h2>${evento.nome}</h2>
    <p><strong>Descrição:</strong> ${evento.descricao}</p>
    <p><strong>Efeito:</strong> ${evento.modificador}</p>
    <button id="fechar-popup">Fechar</button>
  `;

  document.body.appendChild(popup);

  document.getElementById("fechar-popup").addEventListener("click", () => {
    popup.remove();
  });
}

// Função que verifica se a casa tem evento
function verificarEvento(numeroCasa) {
  const casa = document.querySelector(`.casa[data-casa="${numeroCasa}"]`);
  if (casa && casa.dataset.nome) {
    mostrarPopup({
      nome: casa.dataset.nome,
      descricao: casa.dataset.descricao,
      modificador: casa.dataset.modificador
    });
  }
}  
