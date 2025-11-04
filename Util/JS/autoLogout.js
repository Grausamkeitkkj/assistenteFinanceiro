$(document).ready(function () {
    let tempoLimite = 3600000;  // 1 hora em milissegundos

    function logoutAutomatico() {
        window.location.href = './logout.php';
    }

    function reiniciarTimer() {
        clearTimeout(timer);
        timer = setTimeout(logoutAutomatico, tempoLimite);// executa essa funcao após um tempo determinado
    }

    let timer = setTimeout(logoutAutomatico, tempoLimite);

    window.onload = reiniciarTimer;
    document.onmousemove = reiniciarTimer;
    document.onclick = reiniciarTimer;
    document.onscroll = reiniciarTimer;
});