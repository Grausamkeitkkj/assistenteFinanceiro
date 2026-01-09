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
                label: 'Total de Gastos por Mês(Projeção)',
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

    $('#table-button').on('click', function () {
        // pegar o range de data
        dataInicio = $('')
    })

    $('#graphic-button').on('click', function (e) {
        const dataVencimentoIncio = $("#data_vencimento_inicio_grafico").val();
        const dataVencimentoFim = $("#data_vencimento_fim_grafico").val();

        if (!dataVencimentoIncio) {
            alert('Por favor, selecione uma data.');
            return;
        }

        $.ajax({
            url: 'ajax/atualizar_grafico_gastos.php',
            method: 'POST',
            data: {
                data_vencimento_inicio_grafico: dataVencimentoIncio,
                data_vencimento_fim_grafico: dataVencimentoFim
            },
            success: function (response) {
                if (response.success) {
                    // Atualiza os dados do gráfico
                    grafico.data.labels = response.labels;
                    grafico.data.datasets[0].data = response.data;
                    grafico.update();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Erro na requisição: ' + xhr.responseText);
                console.error('Erro:', error);
                console.log('Resposta:', xhr.responseText);
            }
        });
    })

    $('#table-button').on('click', function (e) {
        const dataVencimentoIncio = $("#data_vencimento_inicio_tabela").val();
        const dataVencimentoFim = $("#data_vencimento_fim_tabela").val();

        if (!dataVencimentoIncio) {
            alert('Por favor, selecione uma data.');
            return;
        }

        $.ajax({
            url: 'ajax/atualizar_tabela_gastos.php',
            method: 'POST',
            data: {
                data_vencimento_inicio_tabela: dataVencimentoIncio,
                data_vencimento_fim_tabela: dataVencimentoFim
            },
            success: function (response) {
                if (response.success) {
                    const tbody = $(".tabela-gasto tbody");
                    tbody.empty();
                    response.retorno.forEach(item => {
                        const dataFormatada = item.data_pagamento ? item.data_pagamento.split('-').reverse().join('/') : 'Sem data';
                        const linha = `
                            <tr>
                                <td>${item.produto}</td>
                                <td>${item.nome_categoria_gasto}</td>
                                <td>R$ ${parseFloat(item.valor).toFixed(2).replace('.', ',')}</td>
                                <td>${item.nome_forma_pagamento}</td>
                                <td>${item.contagem_parcelas_pagas}/${item.total_parcelas}</td>
                                <td>${dataFormatada}</td>
                                <td>
                                    <button class="parcela-btn pointer" data-id-gasto="${item.id_gasto}">+</button>
                                </td>
                            </tr>
                        `;
                        tbody.append(linha);
                    });

                    // Reatribui o evento de click
                    $('.parcela-btn').on('click', function () {
                        var idGasto = $(this).data('id-gasto');
                        window.location.href = 'parcela_gasto.php?idGasto=' + idGasto;
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Erro na requisição: ' + xhr.responseText);
                console.error('Erro:', error);
                console.log('Resposta:', xhr.responseText);
            }
        });
    })
});