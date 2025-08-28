const casas = 75; // tamanho do tabuleiro
let posicao = 0;

// cria tabuleiro
const tabuleiro = document.getElementById("tabuleiro");
for (let i = 0; i < casas; i++) {
    const div = document.createElement("div");
    div.classList.add("casa");
    div.setAttribute("id", "casa-" + i);
    tabuleiro.appendChild(div);
}

// desenha boneco na posição inicial
function desenharBoneco() {
    document.querySelectorAll(".casa").forEach(c => c.innerHTML = "");
    document.getElementById("casa-" + posicao).innerHTML = '<span class="boneco">👾</span>';
}

desenharBoneco();

// sorteio e movimento
function jogarDado() {
    const dado = Math.floor(Math.random() * 6) + 1; // número de 1 a 6
    document.getElementById("resultado").innerText = "Você tirou: " + dado;

    posicao += dado;
    if (posicao >= casas) {
        posicao = casas - 1;
        desenharBoneco();
        alert("🎉 Você chegou ao fim!");
        return;
    }

    desenharBoneco();
}

function sortearEvento(){
    var casaEvento = Math.random(1,casas/2); 
}