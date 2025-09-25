function aplicarFonte() {
    let elementos = document.querySelectorAll(".texto, .titulo");
    elementos.forEach((el) => {
        let tamanhoSalvo = sessionStorage.getItem(el.id);
        if (tamanhoSalvo) {
            el.style.fontSize = tamanhoSalvo + "px";
        } else {
            let estilo = window.getComputedStyle(el);
            el.style.fontSize = parseInt(estilo.fontSize) + "px";
        }
    });
} // Aumenta a fonte 
function AumentarFonte() {
    let elementos = document.querySelectorAll(".texto, .titulo");
    elementos.forEach((el) => {
        let estilo = window.getComputedStyle(el);
        let tamanhoAtual = parseInt(estilo.fontSize);
        if (tamanhoAtual < 100) {
            let novoTamanho = tamanhoAtual + 5;
            el.style.fontSize = novoTamanho + "px";
            sessionStorage.setItem(el.id, novoTamanho);
        }
    });
}
document.addEventListener("DOMContentLoaded", aplicarFonte);