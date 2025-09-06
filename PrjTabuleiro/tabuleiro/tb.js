

const board = document.getElementById("board");
const diceEl = document.getElementById("dice");
const turnEl = document.getElementById("turn");
const rollBtn = document.getElementById("roll");

const totalCasas = 36;
const cells = [];

// --- cria tabuleiro ---
for (let i = 0; i < totalCasas; i++) {
  const cell = document.createElement("div");
  cell.classList.add("cell");
  cell.dataset.index = i;

  if (i === 0) cell.classList.add("start");
  if (i === totalCasas - 1) cell.classList.add("end");

  const evento = eventos.find(e => e.casa === i);
  if (evento) {
    cell.classList.add("event");
    cell.dataset.eventId = evento.id;
  }

  board.appendChild(cell);
  cells.push(cell);
}

// --- jogadores ---
const players = [
  { icon: "⚫", pos: 0 },
  { icon: "🔴", pos: 0 }
];
let currentPlayer = 0;

// --- renderização ---
function render() {
  cells.forEach(c => c.textContent = "");
  players.forEach(p => {
    cells[p.pos].textContent += p.icon;
  });
}
//Modificadores
function aplicModificador(player, modificador){
  modificador = modificador.toLowerCase();

  if (modificador.includes("avance") || modificador.includes("anda")){
    const CASAS = parseInt(modificador.match(/\d+/));//match busca padrões na string e o /\d+/ verifica um número de 0 a 9
    player.pos += CASAS;

  }else if(modificador.includes("volte")){
    const CASAS = parseInt(modificador.match(/\d+/))
    player.pos -= CASAS;
  }else if(modificador.includes("perde 1 turno")){
    player.pularTurno = true
  }

  if (player.pos < 0){
    player.pos=0
  }

  if (player.pos >=cells.length){
     player.pos = cells.length - 1
    }
}



// --- movimento ---
function movePlayer(player, steps) {
  if (player.pularTurno){
    alert(player.icon + "Perdeu a vez!")
    player.pularTurno = false
    return
  }

  player.pos += steps;
  if (player.pos >= cells.length - 1) {
    player.pos = cells.length - 1;
    alert(player.icon + " chegou ao fim!")
  }

  const evento = eventos.find(e => e.casa === player.pos);
  if (evento) {
    alert(
      `🎲 Evento: ${evento.nome}\n\n📖 ${evento.descricao}\n\n⚡ Modificador: ${evento.modificador}`    
    )
    aplicModificador(player, evento.modificador)
  }
}
// --- dado ---
rollBtn.addEventListener("click", () => {
  const roll = Math.floor(Math.random() * 6) + 1;
  diceEl.textContent = roll;

  movePlayer(players[currentPlayer], roll);
  render()

  currentPlayer = (currentPlayer + 1) % players.length;
  turnEl.textContent = currentPlayer + 1;
});

render()
