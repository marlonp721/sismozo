var createSubCardTableRow = require("./createSubCardTableRow").default;

const load = (eId, shelf) => {
    const ulElm = document.querySelector('ul[role="tablist"]');
    const url = ulElm.dataset.url;
    const urlSubs = ulElm.dataset.urlSubs;

    const selectedModel = document.getElementById('id_modelo');
    const selectedOption = selectedModel.options[selectedModel.selectedIndex]
    const cardsFromSeletecModel = selectedOption.dataset.collect;
    const models = JSON.parse(cardsFromSeletecModel);
    const nSlots = selectedOption.dataset.nSlots;
    const body = _.template(document.getElementById("tpl-cards-form").innerHTML);

    console.log(url);
    $.get(url + '/' + eId + '/' + shelf)
        .done(function (data) {
             const data_shelf=data.shelf;
      
            const cardModels = data.tarjetas.data;
                console.log(data_shelf);
            //console.log(data);
            const content = body({ count: shelf, models, nSlots, cardModels,data_shelf });
            document.getElementById('shelf' + shelf).innerHTML = content;

        }).done(function () {

            $.get(urlSubs + '/' + eId + '/' + shelf)
                .done(function (data) {


                    const subCardModels = data.data;

                    _.forEach(subCardModels, (item, index) => {

                        let preName = 'equipment[card][' + shelf + '][updates][' + item.TID + '][' + index + ']';
                        const entity = {
                            obj: JSON.stringify(item),
                            parentSelectText: item.MODELO_TARJETA,
                            parentSelectValue: null,
                            cardId: item.TID
                        }
                        createSubCardTableRow({
                            entity,
                            item: item.TID, count: shelf, inputs: [
                                { name: preName + '[id]', value: item.STID },
                                { name: preName + "[modelo]", value: item.MoSTID, inText: item.MODELO_SUBTARJETA },
                                { name: preName + '[slot]', value: item.SUB_SLOT, inText: 'slot' + item.SUB_SLOT },
                                { name: preName + '[serie]', value: item.NUMERO_SERIE, inText: item.NUMERO_SERIE }
                            ]
                        });

                    });

                });

        });
}


export default (e) => {
    const target = e.target;
    console.log(target.href.substring(1));

    const hasContent = document.getElementById(target.dataset.shelf).childElementCount;

    if (target.dataset.card) {
        if (hasContent > 0) {
            console.log('Nothing TODO');

        } else {
            load(target.dataset.card, target.dataset.shelf.substring(5))
        }

    } else {
        console.log('RCTM');

    }

}