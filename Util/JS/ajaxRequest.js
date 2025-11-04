function ajaxRequest(url, data = {}, success = function () { }, error = function () { }, type = 'POST') {
    $.ajax({
        url: url,         // Endereço do arquivo PHP ou endpoint
        type: type,       // Método HTTP (POST, GET, etc.)
        data: data,       // Dados enviados para o servidor (objeto JS)
        dataType: 'json', // Espera resposta em JSON e já converte para objeto JS
        success: success, // Função chamada se a requisição der certo
        error: error      // Função chamada se der erro
    });
}