const audio = document.getElementById('musica');
const pauseBtn = document.getElementById('btn-pausar');
const btnParar = document.getElementById('btn-parar');

if(sessionStorage.getItem('musica') === 'parada'){
    audio.pause(); 
    pauseBtn.disabled = true; 
    pauseBtn.textContent = 'Música parada';
} else {
    
    function desmutar() {
        audio.muted = false;
        audio.play();
        document.removeEventListener('click', desmutar);
    }
    document.addEventListener('click', desmutar);

    // botão pausar - tocar
    pauseBtn.addEventListener('click', () => {
        if (!audio.paused) {
            audio.pause();
            pauseBtn.textContent = 'Tocar música';
        } else {
            audio.play();
            pauseBtn.textContent = 'Pausar música';
        }
    });

    // botão parar
    btnParar.addEventListener('click', () => {
        audio.pause();
        sessionStorage.setItem('musica', 'parada'); 
        pauseBtn.disabled = true
    });
}


