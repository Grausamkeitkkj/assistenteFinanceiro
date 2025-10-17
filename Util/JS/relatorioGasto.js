$(document).ready(function () {
    const meses = [
        { valor: '01', nome: 'Janeiro' },
        { valor: '02', nome: 'Fevereiro' },
        { valor: '03', nome: 'Março' },
        { valor: '04', nome: 'Abril' },
        { valor: '05', nome: 'Maio' },
        { valor: '06', nome: 'Junho' },
        { valor: '07', nome: 'Julho' },
        { valor: '08', nome: 'Agosto' },
        { valor: '09', nome: 'Setembro' },
        { valor: '10', nome: 'Outubro' },
        { valor: '11', nome: 'Novembro' },
        { valor: '12', nome: 'Dezembro' }
    ];
    const selectsMes = ['#mes_inicio_tabela', '#mes_fim_tabela', '#mes_inicio', '#mes_fim'];
    selectsMes.forEach(function (selector) {
        const select = $(selector);
        select.empty();
        select.append($('<option>', { value: '', text: 'Escolha o mês' }));
        meses.forEach(function (mes) {
            select.append($('<option>', { value: mes.valor, text: mes.nome }));
        });
    });

    var anoAtual = new Date().getFullYear();
    $('.ano').each(function () {
        for (var ano = anoAtual; ano >= 2000; ano--) {
            $(this).append($('<option>', {
                value: ano,
                text: ano
            }));
        }
    });

    const ctx = document.getElementById('grafico1').getContext('2d');
    const grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total de Gastos por Mês',
                data: data,
                borderWidth: 1,
                borderColor: '#6949ca',
                backgroundColor: '#6949ca',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return 'R$ ' + value.toFixed(2).replace('.', ',');
                        }
                    }
                }
            }
        }
    });

    $('.parcela-btn').on('click', function () {
        var idGasto = $(this).data('id-gasto');
        window.location.href = 'parcela_gasto.php?idGasto=' + idGasto;
    });
});