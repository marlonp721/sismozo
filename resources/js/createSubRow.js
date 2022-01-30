let changeSlot = require("./changeSlot").default;

module.exports = function (elm) {
  
    let count = elm.dataset.count;
    let item = elm.dataset.item;
    let models = JSON.parse(elm.dataset.models);
    let init = elm.dataset.init;
    let q = elm.dataset.q;
    let parentSelectValue = elm.dataset.cardId;
    let parentSelectText = elm.dataset.cardName;
    let order = document.getElementById('sub-form-'+ item + '-' + count).lastElementChild.dataset.order;
    let subItem = parseInt(order)+1;

    let howMany = document.getElementsByClassName('subcarditem').length;

    if (howMany>=q) {
        var success_dialog = bootbox.dialog({
            className: "modal-danger",
            backdrop: true,
            message: "No se pueden agregar más SUB - TARJETAS, no hay Sub Slots disponibles",
            title: "AVISO"
            });
            
            hideModal(success_dialog, 2);
            return;
    }

    var html = document.getElementById("sub-row-row-tpl").innerHTML;
    var tpl = _.template(html);

    let pro = new Promise((resolve, reject) => {
        resolve(); 
    });
    
    pro.then(() => {
      $("#sub-form-" + item + '-' + count).append(tpl({parentSelectValue, parentSelectText, count, item, subItem, models, init, q, oldModel: {}, entity: {}}));
    });
  
    pro.then(() => {
      changeSlot('select-sub-slot' + count+item);
    });

};