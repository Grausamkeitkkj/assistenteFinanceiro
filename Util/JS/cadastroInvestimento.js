$('.editar-parcela').on('click', function (e) {
    e.preventDefault();

    $.ajax({
        url: './ajax/editar_parcela.php',
        type: 'POST',
        data: formData
    }).then(function (response) {
    }, function (jqXHR, textStatus, errorThrown) {

    });
});