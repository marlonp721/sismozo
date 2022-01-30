import createSubCardTableRow from "./createSubCardTableRow";
let changeSlot = require("./changeSlot").default;

export default function (shelf, eId) {

  const ulElm = document.querySelector('ul[role="tablist"]');
  const url = ulElm.dataset.url;
  const urlSubs = ulElm.dataset.urlSubs;
  /** count == shelf */
  const selectedModel = document.getElementById('id_modelo');
  const selectedOption = selectedModel.options[selectedModel.selectedIndex]
  const cardsFromSeletecModel = selectedOption.dataset.collect;
  const models = JSON.parse(cardsFromSeletecModel);
  const nSlots = selectedOption.dataset.nSlots;
  const ref = 'shelf' + shelf;
  let b = _.template(document.getElementById("tab-body-tpl").innerHTML);
  const body = _.template(document.getElementById("tpl-cards-form").innerHTML);
  let d = document.querySelector('[role="tabpanel"]:first-child');
  if (d)
    d.remove();


  $.get(url + '/' + eId + '/' + shelf)
    .done(function (data) {
      
      const data_shelf=data.shelf;
      
      const cardModels = data.tarjetas.data;
     /* if (cardModels.length == 0)
        return*/
     
      $("#tab-content").prepend(b({ content: body({ count: shelf, models, nSlots, cardModels,data_shelf }), ref, count: shelf }));
      document.querySelector('[role="tabpanel"]:first-child').classList.add("active");

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
                { name: preName + '[slot]', value: item.SUB_SLOT, inText: item.SUB_SLOT },
                { name: preName + '[serie]', value: item.NUMERO_SERIE, inText: item.NUMERO_SERIE }
              ]
            });

          });

        }).done(() => {
          
          changeSlot('select-slot' + shelf);
        }); ;

    });



}