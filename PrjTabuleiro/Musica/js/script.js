const audio = document.getElementById('musica');
const pauseBtn = document.getElementById('btn-pausar');
const btnParar = document.getElementById('btn-parar');

if(sessionStorage.getItem('musica') === 'parada'){
    audio.pause(); // garante que não toca
    pauseBtn.disabled = true; // opcional: desativa botão
    pauseBtn.textContent = 'Música parada';
} else {
    // toca normalmente ao clicar pela primeira vez
    function desmutar() {
        audio.muted = false;
        audio.play();
        document.removeEventListener('click', desmutar);
    }
    document.addEventListener('click', desmutar);

    // botão pausar/tocar
    pauseBtn.addEventListener('click', () => {
        if (!audio.paused) {
            audio.pause();
            pauseBtn.textContent = 'Tocar música';
        } else {
            audio.play();
            pauseBtn.textContent = 'Pausar música';
        }
    });

    // botão "Parar música permanentemente"
    btnParar.addEventListener('click', () => {
        audio.pause();
        sessionStorage.setItem('musica', 'parada'); // salva estado
        pauseBtn.disabled = true; // desativa botão
    });
}

