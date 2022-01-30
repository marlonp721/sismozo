const createSubCardTableRow = (obj) => {

    let template = document.getElementById('itemSubCardTable').innerHTML;

    let inner_ = _.template(template)({ ...obj });
    let inner2 = document.getElementById("sub-tarjetas"+obj.count).innerHTML.concat(inner_);
    //console.log(inner2);
    $("#" + "sub-tarjetas" + obj.count).empty();
    $("#" + "sub-tarjetas" + obj.count).append(inner2);


}

export default createSubCardTableRow;


const updateSubCardListDOMFromModal = (cardItem, shelf, weHaveItems, parentSelectText, parentSelectValue) => {

    const formElement = document.getElementById('sub-form-' + cardItem + '-' + shelf);
    const rows = formElement.getElementsByClassName('subcarditem');

    Array.from(rows).forEach((row) => {

        const inputs = row.getElementsByClassName('form-control');
        let data = [];

        [...inputs].forEach((in_) => {
            let obj = {};
            if (in_.tagName.toLowerCase() == 'select' && in_.name.includes('modelo')) {
                obj.inText = in_.options[in_.selectedIndex].text;
            } else {
                obj.inText = in_.value;
            }
            obj.value = _.trim(in_.value);

            if (_.isEmpty(obj.value)) {
                in_.parentElement.classList.add('form-group', 'has-error');

            } else {
                if (in_.parentElement.classList.contains('has-error'))
                    in_.parentElement.classList.remove('has-error')
            }

            obj.name = in_.name;
            obj.order = in_.order;

            data.push({ ...obj });
        });

        let cc = formElement.querySelectorAll('.has-error').length;
        if (cc > 0) {
            return false;
        }

        const entity = {
            obj: JSON.stringify({}),
            parentSelectText,
            parentSelectValue,
            cardId: null
        }

        createSubCardTableRow({ item: cardItem, count: shelf, inputs: data, entity });

    });

    let cc = formElement.querySelectorAll('.has-error').length;
    if (cc > 0) {
        return false;
    }

    //weHaveItems.forEach((el) => { 
        //debugger
//console.log('--------------------');
//el.parentNode.removeChild(el);
        //console.log(el);
        
        //el.remove()
    //});

    return true;
}


const getChildsFromSubCardTable = (shelf) => {
   
    return document.getElementById('sub-tarjetas' + shelf).querySelectorAll('tr')
}




export { updateSubCardListDOMFromModal, getChildsFromSubCardTable };