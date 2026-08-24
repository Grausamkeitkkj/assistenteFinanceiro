function ajaxRequest(url, data = {}, success = function () { }, error = function () { }, type = 'POST') {
    var tokenCSRF = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,         // Endereço do arquivo PHP ou endpoint
        type: type,       // Método HTTP (POST, GET, etc.)
        data: data,       // Dados enviados para o servidor (objeto JS)
        headers: {
            'X-CSRF-TOKEN': tokenCSRF // Injeta o token no cabeçalho HTTP
        },
        dataType: 'json', // Espera resposta em JSON e já converte para objeto JS
        success: success, // Função chamada se a requisição der certo
        error: error      // Função chamada se der erro
    });
}