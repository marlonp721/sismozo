
export let toDeleteCol = []

export function deleteTab (order) {

    //let allCount = document.querySelectorAll("li[data-tab-h]").length
    /** First one */
    let elementHtoDelete = document.querySelector("a[data-shelf='shelf" + order + "'").parentElement
    let elementBtoDelete = document.querySelector("div[data-tab-b='" + elementHtoDelete.dataset.tabH + "'")
    
    elementBtoDelete.style.display = 'none';
    elementHtoDelete.style.display = 'none';
    elementBtoDelete.classList.remove('active')
    elementHtoDelete.classList.remove('active')
    console.log('DISPLAY: ' +elementBtoDelete.style.display);
    toDeleteCol.push(order);
    let elements = Array.from(document.querySelectorAll("li[data-tab-h]"))
    for (let e of elements) {
        if (e.style.display != 'none') {
            $(e.firstChild).trigger( "click" )
            break;
        }
    }

    
}