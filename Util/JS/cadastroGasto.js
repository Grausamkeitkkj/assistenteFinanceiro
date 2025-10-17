$(document).ready(function () {
    $('#valor').mask('#.##0,00', { reverse: true });

    $('.form-registration').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        ajaxRequest('./ajax/salvar_gasto.php', formData,
            function (response) {
                if (response.success) {
                    alert(response.message);
                    $('.form-registration')[0].reset();
                } else {
                    alert('Erro: ' + response.message);
                }
            },
            function (jqXHR, textStatus, errorThrown) {
                alert('Erro na requisição AJAX.\n' +
                    'Status: ' + textStatus + '\n' +
                    'Erro: ' + errorThrown + '\n' +
                    'Resposta: ' + jqXHR.responseText);
            },
            'POST'
        );
    });

    $('#forma_pagamento_id').change(function () {
        formaPagamento = $(this).val();
        totalParcelas = $('#total_parcelas').val();
        if (formaPagamento == 3) {
            $('#total_parcelas').val(1);
            $('#total_parcelas').prop('readonly', true);
        } else {
            $('#total_parcelas').prop('readonly', false);
            $('#total_parcelas').val(totalParcelas);
        }
    });

});