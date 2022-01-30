let changeSlot = require("./changeSlot").default;

export default function (elm, shelf) {
    const cardWrapper = document.getElementById('cards-table' + shelf);
    let howMany = cardWrapper.childElementCount;
    const order = cardWrapper.lastElementChild.dataset.order;
    
    
    /* Option selected at MODELO (id:id_modelo) */
    const selectElment = document.getElementById('id_modelo');
    let allowedAmount = selectElment.options[selectElment.selectedIndex].dataset.nSlots;
    let models = selectElment.options[selectElment.selectedIndex].dataset.collect;

    if (howMany > allowedAmount) {

        var success_dialog = bootbox
            .dialog({
                className: "modal-danger",
                backdrop: true,
                message: "No se pueden agregar más TARJETAS, no hay Slots disponibles",
                title: "AVISO"
            });

        hideModal(success_dialog, 2);
        return;
    }


    let item = parseInt(order) + 1;

    var html = document.getElementById("row-tpl").innerHTML;
    var tpl = _.template(html);

    if (typeof models != 'object') {
        models = JSON.parse(models);
    }

    $("#cards-table" + shelf).append(tpl({ count: shelf, models, nSlots: allowedAmount, item: {}, counter: item }));

    changeSlot('select-slot' + shelf);
};