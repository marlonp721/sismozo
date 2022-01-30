
export const removedCards = []
export const removedSubCars = []

const getUrl = (elm) => {
    let url = '';
    if (elm.dataset.parent && elm.dataset.id) {
        //Card
        url = document.getElementById('register_equipment').dataset.delCardUrl
        if (!url || url == '')
            return;
        url = url.replace('#ID#', elm.dataset.id);
    } else if (elm.dataset.id) {
        //Sub Car
        url = document.getElementById('register_equipment').dataset.delSubUrl
        if (!url || url == '')
            return;
        url = url.replace('#ID#', elm.dataset.id);
    }
    return url;
}

const removeItem = (elm) => {
    const route = document.getElementById("register_equipment").action;
    const method_request = (route.indexOf("create") >= 0) ? "create" : "update";

    let del = elm.parentElement.parentElement;
    del.parentElement.removeChild(del);
    if (!elm.dataset.parent) {
        let sub_card = del.children[0].children[1];
        let sub_card_selected = sub_card.selectedIndex;

        let text_sub_card = sub_card.options[sub_card_selected].text;
        let item = elm.dataset.item;
        let count = elm.dataset.count;

        const rows = document.getElementById("sub-tarjetas" + count);

        Array.from(rows.children).forEach(row => {
            if (
                row.children[0].innerText == elm.dataset.parentText &&
                row.children[2].innerText == text_sub_card
            ) {
                row.remove();
            }
        });

        //updateSubCardListDOMFromModal(item, count, getChildsFromSubCardTable(count), elm.dataset.parentText, elm.dataset.parentValue);

    } else {
        let card =
            method_request == "create"
                ? del.children[1].children[0]
                : del.children[1].children[1];
        let card_selected = card.selectedIndex;
        let text_card = card.options[card_selected].text;
        let count = elm.dataset.count;
        const rows = document.getElementById("sub-tarjetas" + count);
        //console.log(rows);
        Array.from(rows.children).forEach(row => {
            if (row.children[0].innerText == text_card) {
                row.remove();
            }
        });
        //location.reload();
    }
}

/*export default (elm, event) => {
    event.preventDefault();
    debugger;
    const url = getUrl(elm);

    if (!url) {
        removeItem(elm);
    } else {
        $.ajax({
            type: 'POST',
            url: url,
        }).done(() => {
            removeItem(elm);
            
        });
    }


};
*/

export default (elm, event) => {

    event.preventDefault();
    const url = getUrl(elm);
    
    if (url && url != '') {
        if (elm.dataset.parent && elm.dataset.id)
            removedCards.push(elm.dataset.id);
        else if (elm.dataset.id)
            removedSubCars.push(elm.dataset.id);

    }

    removeItem(elm);
};