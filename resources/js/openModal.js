import { updateSubCardListDOMFromModal, getChildsFromSubCardTable } from "./createSubCardTableRow";

export default (elm) => {

    if (typeof elm.dataset.nSub === "undefined" || elm.dataset.nSub == '') {
        console.log("nothing");

        return;
    }

    //var card_select =elm.parentElement.parentElement.children[1].querySelectorAll('select');

    let card_select = "";
    let card_selected = "";
    let card_text_selected = "";

    card_select = elm.parentElement.parentElement.children[1].querySelectorAll('select');

    card_select.forEach((item) => {

        card_selected = item.selectedIndex;
        card_text_selected = item.options[card_selected].textContent;
    });



    // }

    let url = document.getElementById('card-dynamick').dataset.subcarUrl;

    /** Familia */
    let idFam = document.getElementById('id_familia').value;

    $.get(url + '/' + idFam)
        .done(function (data) {
            //console.log(parent);
            let h = _.template(document.getElementById("sub-row-tpl").innerHTML);
            let models = JSON.parse(data);
            let count = elm.dataset.count;
            let item = elm.dataset.item;
            let parentSelectValue = elm.dataset.moId;
            let parentSelectText = elm.dataset.moName;

            let oldModel = { lastOrder: 0 };
            let rows_sub_card = 0;

            //const subCardWrapperTable = document.getElementById('sub-tarjetas' + count);
            //let weHaveItems_ = [];
            
            let finding = elm.dataset.cardId || item;
            let weHaveItems = getChildsFromSubCardTable(count);
            //debugger
            weHaveItems = [...weHaveItems].filter((i) => {
                let haveThis = 'subcard' + count + finding;
                return (i.dataset.cardi == haveThis);

            })
            //console.log(weHaveItems);
            const numRows = weHaveItems.length;

            let entities = [];

            if (numRows > 0) {
                weHaveItems.forEach((item) => {

                    if (_.keys(JSON.parse(item.dataset.entity)).length !== 0) {

                        if (card_text_selected == JSON.parse(item.dataset.entity).MODELO_TARJETA) {

                            entities.push(JSON.parse(item.dataset.entity));


                            return;
                        }

                    }

                    if (item.children[0].dataset.parentText == card_text_selected) {
                        rows_sub_card += 1;
                        item.querySelectorAll('td').forEach((elm, index) => {

                            if (index == 0) return;

                            oldModel[elm.dataset.name] = elm.dataset.value;
                            oldModel.lastOrder = elm.dataset.order;

                        });

                    }
                                    });



            }
            console.log(entities, "ss");
            oldModel.lastOrder = numRows - 1;
            if (!oldModel.lastOrder || isNaN(oldModel.lastOrder) || oldModel.lastOrder < 0)
                oldModel.lastOrder = 0;

            if (rows_sub_card >= 1) {
                rows_sub_card = rows_sub_card - 1;
            }

            oldModel.lastOrder = rows_sub_card;


            var success_dialog = bootbox.dialog({
                className: "modal-primary",
                backdrop: true,
                message: h({ parentSelectValue, parentSelectText, models, count, item, init: elm.dataset.initSub, q: elm.dataset.nSub, oldModel, entities }),
                title: "Agregar Sub tarjetas",
                size: 'large',
                buttons: {
                    confirm: {
                        label: 'ACEPTAR',
                        className: 'btn-default',
                        callback: function () {

                            weHaveItems.forEach(item => item.parentNode.removeChild(item))
                            return updateSubCardListDOMFromModal(item, count, weHaveItems, parentSelectText, parentSelectValue)
                        }
                    },
                    cancel: {
                        label: 'CANCELAR',
                        className: 'btn-default',

                    }
                }
            });

        });
}