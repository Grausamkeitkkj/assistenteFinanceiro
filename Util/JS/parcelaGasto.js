$(document).ready(function () {
    // Delegated handler: garante funcionamento para botões adicionados dinamicamente
    $(document).on('click', '.quitar-btn', function () {
        var linha = $(this).closest('tr');
        var idParcela = linha.data('id-parcela');
        var formData = { id_parcela: idParcela };

        $.ajax({
            url: './ajax/quitar_parcela.php',
            type: 'POST',
            data: formData
        }).then(function (response) {
            if (response.data_pagamento) {
                var btn = '<button class="editar-btn pointer">✎</button>';
                linha.find('td').eq(3).text(formatarDataBR(response.data_pagamento));
                // mantem o atributo data-pagamento sincronizado com a célula
                linha.attr('data-pagamento', formatarDataBR(response.data_pagamento));
                linha.find('.quitar-btn').remove();
                linha.find('td').eq(5).html(btn);
            }
            alert('Parcela quitada com sucesso!');
        }, function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao quitar parcela: ' + errorThrown);
        });
    })

    $('.editar-parcela').on('click', function (e) {
        e.preventDefault();
        var idParcela = $('#id_parcela').val();
        var dataPagamento = $('#data_pagamento').val();
        var formData = { idParcela: idParcela, dataPagamento: dataPagamento };
        var linhaTabela = $("tr[data-id-parcela='" + idParcela + "']");

        $.ajax({
            url: './ajax/editar_parcela.php',
            type: 'POST',
            data: formData
        }).then(function (response) {
            if (response.dataPagamento) {
                linhaTabela.find('td').eq(3).text(formatarDataBR(response.dataPagamento));
                // atualizar atributo para garantir que o modal leia a data correta
                linhaTabela.attr('data-pagamento', formatarDataBR(response.dataPagamento));
            } else {
                linhaTabela.find('td').eq(3).text('Não pago')
                linhaTabela.find('.editar-btn').remove();
                linhaTabela.find('td').eq(4).html('<button class="quitar-btn pointer">✖</button>');
            }
            alert('Parcela editada com sucesso!');
            $('#modal').css('display', 'none');
        }, function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao editar parcela: ' + errorThrown);
        });
    });

    // Delegated handler: funciona para botões existentes e criados dinamicamente
    $(document).on('click', '.editar-btn', function () {
        var linha = $(this).closest('tr');
        var idParcela = linha.data('id-parcela');
        var dataPagamento = linha.data('pagamento');
        $('#id_parcela').val(idParcela);
        $('#modal').css('display', 'flex');
        $('#data_pagamento').val(dataPagamento.split('/').reverse().join('-'));
    });

    $('#modal').on('click', function (e) {
        if ($(e.target).is('#modal')) {
            $('#modal').css('display', 'none');
            $('#id_parcela').val('');
            $('#data_pagamento').val('')
        }
    });

    $('#quitado').on('change', function () {
        // O caractere ':' indica uma pseudo-classe, que seleciona elementos em um estado específico (ex: :checked, :hover, :focus)
        if ($(this).is(':checked')) {
            $('#data_pagamento').prop('disabled', false);
        } else {
            $('#data_pagamento').prop('disabled', true);
            $('#data_pagamento').val('');
        }
    });

})