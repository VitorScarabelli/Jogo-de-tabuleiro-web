<?php
include('../includes/verificacao_session_usu.php');
include('../banco/conexao.php');

// --- Jogadores escolhidos ---
$personagensSelecionados = isset($_POST['personagens']) ? json_decode($_POST['personagens'], true) : [];

// 🔹 Busca dados completos
$personagensCompletos = [];
foreach ($personagensSelecionados as $p) {
    $stmt = $pdo->prepare("SELECT * FROM tbPersonagem WHERE idPersonagem = ?");
    $stmt->execute([$p['idPersonagem']]);
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        $personagensCompletos[] = [
            'idPersonagem' => $dados['idPersonagem'],
            'nome' => $dados['nomePersonagem'],
            'emoji' => $dados['emojiPersonagem'],
        ];
    }
}


// --- Modos de eventos ---
$modoNormal = isset($_POST['modoNormal']);
$modoAleatorio = isset($_POST['modoAleatorio']);
$modoAutomatico = isset($_POST['modoAutomatico']);

$eventosSelecionados = $_POST['eventos'] ?? [];
$eventos = [];

// --- Casas válidas no tabuleiro (1 até 47) ---
$casasDisponiveis = range(1, 46);
shuffle($casasDisponiveis);

// Função para pegar a próxima casa válida
function pegarCasaDisponivel(&$casas)
{
    while (!empty($casas)) {
        $casa = array_shift($casas);
        if ($casa < 48) return $casa;
    }
    return null; // se não houver casa válida
}

// --- Eventos Automáticos ---
if ($modoAutomatico) {
    $stmt = $pdo->query("SELECT * FROM tbevento ORDER BY idEvento ASC");
    $todosEventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($todosEventos as $row) {
        $casa = pegarCasaDisponivel($casasDisponiveis);
        if ($casa === null) break;
        $eventos[] = [
            'nome' => $row['nomeEvento'],
            'descricao' => $row['descricaoEvento'],
            'casas' => intval($row['casaEvento']),
            'casa' => $casa
        ];
    }
}

// --- Eventos Aleatórios ---
elseif ($modoAleatorio) {
    foreach ($eventosSelecionados as $id => $dados) {
        if (isset($dados['ativo'])) {
            $casa = pegarCasaDisponivel($casasDisponiveis);
            if ($casa === null) break;
            $eventos[] = [
                'nome' => $dados['nome'],
                'descricao' => $dados['descricao'],
                'casas' => intval($dados['casas']),
                'casa' => $casa
            ];
        }
    }
}

// --- Eventos Manuais ---
else {
    foreach ($eventosSelecionados as $id => $dados) {
        if (isset($dados['ativo']) && !empty($dados['casa'])) {
            $casa = intval($dados['casa']);
            if ($casa < 1) $casa = 1;
            if ($casa >= 47) $casa = 46; // nunca deixa ir pra última
            $eventos[] = [
                'nome' => $dados['nome'],
                'descricao' => $dados['descricao'],
                'casas' => intval($dados['casas']),
                'casa' => $casa
            ];
        }
    }
}

// --- Eventos extras dos personagens ---
foreach ($personagensCompletos as $p) {
    if (!empty($p['idPersonagem'])) {
        $stmt = $pdo->prepare("SELECT * FROM tbEventoPersonagem WHERE idPersonagem = ?");
        $stmt->execute([$p['idPersonagem']]);
        $eventosPersonagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($eventosPersonagem as $ev) {
            $casa = pegarCasaDisponivel($casasDisponiveis);
            if ($casa === null) break;

            $eventos[] = [
                'nome' => $ev['nomeEvento'],
                'descricao' => $ev['descricaoEvento'],
                'casas' => intval($ev['casas']),
                'casa' => $casa,
                'idDono' => $p['idPersonagem']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Jogo do Dado com Eventos</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            background-image: url('./imageTabuleiro/MapaTabuleiro.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .tabuleiro {
            display: grid;
            grid-template-columns: repeat(16, 9vmin);
            grid-template-rows: repeat(12, 9vmin);
            height: 5%;
            gap: 0.5vmin;
            padding: 1vmin;
            box-sizing: border-box;
            margin-top: 1.2%;
        }

        .casa {
            background: #E2DFE9;
            border-radius: 10%;
            box-shadow:
                0 4px 0 rgba(122, 105, 136, 1),
                inset 0 -6px 20px rgba(101, 92, 127, 0.25);
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            font-size: 2.5vmin;
            overflow: visible;
        }

        .tabuleiro>div:not(:nth-child(-n+16)):not(:nth-child(16n)):not(:nth-last-child(-n+16)):not(:nth-child(16n+1)) {
            background: transparent;
            box-shadow: none;
        }

        .ativo {
            background: #fff28fff !important;
        }

        .evento {
            background: #4f001cff !important;
        }

        .evento-bom {
            background-color: #5b8debff !important;
        }

        .evento-ruim {
            background-color: #ea8080ff !important;
        }

        .boneco {
            font-size: 4vmin;
            position: absolute;
        }

        .boneco1 {
            top: 0;
            left: 0;
        }

        .boneco2 {
            top: 0;
            right: 0;
        }

        .boneco3 {
            bottom: 0;
            left: 0;
        }

        .boneco4 {
            bottom: 0;
            right: 0;
        }

        /* === NOVO DADO 3D COM BOLINHAS === */
        #dice-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            perspective: 1000px;
            width: 120px;
            height: 120px;
            cursor: pointer;
            z-index: 15;
            filter: drop-shadow(0px 8px 9.6px rgba(101, 92, 127, 0.5));
        }

        #dice {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 1s ease-out;
        }

        .face {
            position: absolute;
            width: 120px;
            height: 120px;
            background: #E2DFE9;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: inset 0 -6px 20px rgba(101, 92, 127, 0.5);
        }

        .front {
            transform: rotateY(0deg) translateZ(60px);
        }

        .back {
            transform: rotateY(180deg) translateZ(60px) rotateX(180deg) rotateY(180deg);
        }

        .right {
            transform: rotateY(90deg) translateZ(60px);
        }

        .left {
            transform: rotateY(-90deg) translateZ(60px);
        }

        .top {
            transform: rotateX(90deg) translateZ(60px);
        }

        .bottom {
            transform: rotateX(-90deg) translateZ(60px);
        }

        /* pontos do dado */
        .dot {
            width: 18px;
            height: 18px;
            background: #34323A;
            border-radius: 50%;
            position: absolute;
        }

        /* bolinha do lado 1 fica vermelha */
        .face.front .dot {
            background: #bf2532ff;
        }

        .top-left {
            top: 20px;
            left: 20px;
        }

        .top-right {
            top: 20px;
            right: 20px;
        }

        .bottom-left {
            bottom: 20px;
            left: 20px;
        }

        .bottom-right {
            bottom: 20px;
            right: 20px;
        }

        .center {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .middle-left {
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
        }

        .middle-right {
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        /* Tooltip */
        .tooltip {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 2.2vmin;
            z-index: 30;
            pointer-events: none;
            white-space: normal;
            max-width: 50vmin;
            min-width: 22vmin;
            text-align: left;
            line-height: 1.4;
        }

        .tooltip.cima {
            bottom: 100%;
            margin-bottom: 6px;
        }

        .tooltip.baixo {
            top: 100%;
            margin-top: 6px;
        }

        .casa:hover .tooltip {
            display: block;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 20;
        }

        .popup-conteudo {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            width: 300px;
            max-width: 90%;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .popup-conteudo h2 {
            margin-bottom: 10px;
        }

        .popup-conteudo button {
            margin-top: 15px;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            background-color: #422aaeff;
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
        }

        .popup-conteudo button:hover {
            background-color: #2f1a8a;
        }

        #historico-container {
            position: fixed;
            /* fixa na tela */
            top: 50%;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* não bloqueia clique no tabuleiro */
        }

        .historico {
            position: absolute;
            top: 10px;
            width: 12%;
            max-height: 40vh;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            font-size: 0.9rem;
            text-align: left;
            pointer-events: auto;
        }

        /* fixa o título dentro da caixinha */
        .titulo-historico {
            position: sticky;
            top: 0;
            background: inherit;
            /* mantém o fundo da caixinha */
            padding: 5px 0;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            z-index: 1;
        }

        #historico-negativo {
            left: 10px;
        }

        #historico-positivo {
            right: 10px;
        }
    </style>
</head>

<body>

    <!-- Dado 3D -->
    <div id="dice-container">
        <div id="dice">
            <div class="face front">
                <span class="dot center"></span>
            </div>
            <div class="face back">
                <span class="dot top-left"></span>
                <span class="dot top-right"></span>
                <span class="dot bottom-left"></span>
                <span class="dot bottom-right"></span>
                <span class="dot middle-left"></span>
                <span class="dot middle-right"></span>
            </div>
            <div class="face right">
                <span class="dot top-left"></span>
                <span class="dot center"></span>
                <span class="dot bottom-right"></span>
            </div>
            <div class="face left">
                <span class="dot top-left"></span>
                <span class="dot top-right"></span>
                <span class="dot bottom-left"></span>
                <span class="dot bottom-right"></span>
            </div>
            <div class="face top">
                <span class="dot top-left"></span>
                <span class="dot top-right"></span>
                <span class="dot center"></span>
                <span class="dot bottom-left"></span>
                <span class="dot bottom-right"></span>
            </div>
            <div class="face bottom">
                <span class="dot top-left"></span>
                <span class="dot bottom-right"></span>
            </div>
        </div>
        <p id="infoTurno">É a vez do(a) Jogador(a) 1</p>
        <p id="resultado"></p>
    </div>

    <div class="tabuleiro" id="tabuleiro"></div>

    <div id="popupEvento" class="popup">
        <div class="popup-conteudo">
            <h2 id="popupNome">Nome do Evento</h2>
            <p id="popupDescricao">Descrição do evento</p>
            <p id="popupModificador">Casas: </p>
            <button>Fechar</button>
        </div>
    </div>

    <script>
        const linhas = 10;
        const colunas = 16;
        const tabuleiro = document.getElementById("tabuleiro");

        const eventos = <?php echo json_encode($eventos); ?>;
        // Antes: pegava apenas o POST (sem nome e emoji)
        // const personagensSelecionados = <?php echo json_encode($personagensSelecionados); ?>;

        // Agora: pega os personagens completos com nome e emoji
        const personagensSelecionados = <?php echo json_encode($personagensCompletos); ?>;

        // Define os jogadores (máximo 4)
        const jogadores = personagensSelecionados.slice(0, 4).map((p, index) => ({
            idPersonagem: p.idPersonagem,
            nome: p.nome,
            emoji: p.emoji,
            classe: "boneco" + (index + 1),
            posicao: 0,
            terminou: false
        }));

        let turno = 0;

        // Cria casas do tabuleiro
        for (let i = 0; i < linhas * colunas; i++) {
            const div = document.createElement("div");
            div.classList.add("casa");
            div.id = "casa-" + i;
            tabuleiro.appendChild(div);
        }

        // Define caminho do tabuleiro (espiral)
        const caminho = [];
        for (let i = 0; i < colunas; i++) caminho.push(i);
        for (let i = 1; i < linhas - 1; i++) caminho.push(i * colunas + (colunas - 1));
        for (let i = colunas * (linhas - 1) + (colunas - 1); i >= colunas * (linhas - 1); i--) caminho.push(i);
        for (let i = linhas - 2; i > 0; i--) caminho.push(i * colunas);

        // Define primeira e última casa
        document.getElementById("casa-" + caminho[0]).style.backgroundColor = "lightblue";
        document.getElementById("casa-" + caminho[caminho.length - 1]).style.backgroundColor = "gold";

        // Desenha bonecos
        function desenharBonecos() {
            document.querySelectorAll(".casa").forEach(c => {
                const tooltipHTML = c.querySelector(".tooltip") ? c.querySelector(".tooltip").outerHTML : "";
                c.innerHTML = tooltipHTML;
                c.classList.remove("ativo");
            });
            jogadores.forEach(j => {
                if (!j.terminou) {
                    const idCasa = caminho[j.posicao];
                    const casaAtual = document.getElementById("casa-" + idCasa);
                    casaAtual.classList.add("ativo");
                    const span = document.createElement("span");
                    span.classList.add("boneco", j.classe);
                    span.innerText = j.emoji;
                    casaAtual.appendChild(span);
                }
            });
        }
        desenharBonecos();

        // Popup de eventos
        function mostrarPopup(evento, callback) {
            document.getElementById("popupNome").innerText = evento.nome;
            document.getElementById("popupDescricao").innerText = evento.descricao;
            document.getElementById("popupModificador").innerText = "Casas: " + (evento.casas > 0 ? '+' + evento.casas : evento.casas);
            const popup = document.getElementById("popupEvento");
            popup.style.display = "flex";
            const btn = popup.querySelector("button");
            btn.onclick = () => {
                popup.style.display = "none";
                callback();
            }
        }

        // Movimento do jogador
        async function moverJogador(jogador, casas) {
            const passos = Math.abs(casas);
            const direcao = casas >= 0 ? 1 : -1;
            for (let i = 0; i < passos; i++) {
                await new Promise(resolve => {
                    setTimeout(() => {
                        jogador.posicao += direcao;
                        if (jogador.posicao >= caminho.length) jogador.posicao = caminho.length - 1;
                        if (jogador.posicao < 0) jogador.posicao = 0;
                        desenharBonecos();
                        resolve();
                    }, 300);
                });
            }
        }

        // Função do dado
        let rolling = false;
        document.getElementById("dice-container").addEventListener("click", async () => {
            if (rolling) return;
            rolling = true;
            const dado = Math.floor(Math.random() * 6) + 1;

            // Rotação 3D do dado
            let xRot = 0,
                yRot = 0;
            switch (dado) {
                case 1:
                    xRot = 0;
                    yRot = 0;
                    break;
                case 2:
                    xRot = 90;
                    yRot = 0;
                    break;
                case 3:
                    xRot = 0;
                    yRot = -90;
                    break;
                case 4:
                    xRot = 0;
                    yRot = 90;
                    break;
                case 5:
                    xRot = -90;
                    yRot = 0;
                    break;
                case 6:
                    xRot = 180;
                    yRot = 0;
                    break;
            }
            xRot += 360 * (Math.floor(Math.random() * 3) + 3);
            yRot += 360 * (Math.floor(Math.random() * 3) + 3);
            document.getElementById("dice").style.transform = `rotateX(${xRot}deg) rotateY(${yRot}deg)`;

            setTimeout(async () => {
                document.getElementById("resultado").innerText = "Saiu: " + dado;
                await jogarDadoAnimado(dado);
                rolling = false;
            }, 1000);
        });

// Marca eventos nas casas
eventos.forEach(e => {
    const idCasa = caminho[e.casa]; // agora e.casa já é zero-index
    const casaEl = document.getElementById("casa-" + idCasa);

    if (e.casas > 0) casaEl.classList.add("evento-bom");
    else if (e.casas < 0) casaEl.classList.add("evento-ruim");
    else casaEl.classList.add("evento");

    const tooltip = document.createElement("span");
    tooltip.classList.add("tooltip");
    const linha = Math.floor(idCasa / colunas);
    tooltip.classList.add(linha > linhas / 2 ? "cima" : "baixo");
    tooltip.innerText = `${e.nome}\n${e.descricao}\nCasas: ${e.casas>0?'+':''}${e.casas}`;
    casaEl.appendChild(tooltip);
});

// Função principal após rolar o dado
async function jogarDadoAnimado(dado) {
    const jogadorAtual = jogadores[turno];
    if (jogadorAtual.terminou) {
        proximoTurno();
        return;
    }

    document.getElementById("infoTurno").innerText = "É a vez do " + jogadorAtual.nome;

    // Move jogador
    await moverJogador(jogadorAtual, dado);

    // Contador de eventos para evitar loop infinito
    let eventosAtivados = 0;
    const limiteEventos = 3;

    while (eventosAtivados < limiteEventos) {
        const eventoNaCasa = eventos.find(e =>
            caminho[e.casa] === caminho[jogadorAtual.posicao] &&
            (!e.idDono || e.idDono === jogadorAtual.idPersonagem)
        );

        if (!eventoNaCasa) break; // se não tem evento, sai do loop

        const posicaoAntes = jogadorAtual.posicao;

        await new Promise(resolve => {
            mostrarPopup(eventoNaCasa, resolve);
        });

        if (eventoNaCasa.casas) {
            await moverJogador(jogadorAtual, eventoNaCasa.casas);
        }

        const posicaoDepois = jogadorAtual.posicao;
        adicionarHistorico(jogadorAtual, eventoNaCasa, posicaoAntes, posicaoDepois);

        eventosAtivados++;
    }

    proximoTurno();
}



        // Próximo turno
        function proximoTurno() {
            turno = (turno + 1) % jogadores.length;
            document.getElementById("infoTurno").innerText = "É a vez do " + jogadores[turno].nome;
            desenharBonecos();
        }
    </script>

    <!-- Históricos de eventos -->
    <div id="historico-negativo" class="historico">
        <h3 class="titulo-historico">Eventos Negativos</h3>
        <ul id="lista-negativa"></ul>
    </div>

    <div id="historico-positivo" class="historico">
        <h3 class="titulo-historico">Eventos Positivos</h3>
        <ul id="lista-positiva"></ul>
    </div>


    <script>
        function adicionarHistorico(jogador, evento, posicaoAnterior, posicaoFinal) {
            const tipo = evento.casas >= 0 ? "positivo" : "negativo";
            const container = tipo === "positivo" ?
                document.getElementById("historico-positivo") :
                document.getElementById("historico-negativo");

            const msg = document.createElement("div");
            msg.innerText = `${jogador.emoji} ${jogador.nome}: Casa ${posicaoAnterior+1} → Casa ${posicaoFinal+1} (${evento.nome})`;
            container.appendChild(msg);

            // Scroll automático para baixo
            container.scrollTop = container.scrollHeight;
        }
    </script>


</body>

</html>
