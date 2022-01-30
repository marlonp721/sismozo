let createTab =  require("./createTab");

const letsdoit = (url) => {

    $('#id_familia').find('option').remove();
    $('#id_modelo').find('option').remove();
    let id = $('#id_vendor').val();
    return $.ajax({
        type: 'GET',
        url: url,
        data: { id: id }
    }).done(function (data) {

        var html = '<option></option>';

        for (const prop in data) {
            html += '<option value="' + `${prop}` + '">' + `${data[prop]}` + '</option>';
        }

        $('#id_familia').append(html);

    });

}

export default () => {
    const selectElement = document.getElementById('id_vendor');
    const created = document.querySelector('[role="tablist"]').querySelectorAll('li a[data-shelf]').length

    if (created > 0) {
        let success_dialog = bootbox.dialog({
            className: "modal-primary",
            backdrop: true,
            message: 'Se eliminarán todas las tarjetas y sub tarjetas',
            title: "Aviso",
            //size: 'large',
            buttons: {
                confirm: {
                    label: 'ACEPTAR',
                    className: 'btn-success',
                    callback: function () {
                        const url = document.getElementById('register_equipment').dataset.delCardsUrl
                        if (!url || url == '')
                        return;
                        $.ajax({
                            type: 'POST',
                            url: url,
                        }).done(() => {
                            letsdoit(selectElement.dataset.url)
                        }).done(() => {
                            Array.from(document.querySelector("ul[role='tablist']").children).forEach((e) => {
                                console.log(e.firstChild.id);
                                
                                if (e.firstChild.id == 'more-cards')
                                    return ;
                                e.remove();
                            });
                            Array.from(document.getElementById('tab-content').children).forEach((e) => {
                                e.remove();
                            });
                            createTab('shelf', 'SHELF', {}, 0);
                        });
                    }
                },
                cancel: {
                    label: 'CANCELAR',
                    className: 'btn-danger',
                    callback: () => {
                        selectElement.value = selectElement.dataset.default;
                    }

                }
            }
        });
    } else {
        letsdoit(selectElement.dataset.url)
    }

}