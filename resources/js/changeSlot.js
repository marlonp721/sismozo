export default (className) => {

    const htmlCol = document.getElementsByClassName(className);
    const optionsSelectedArray = [];

    Array.from(htmlCol).forEach((element) => {
        Array.from(element.options).forEach(op => {
            if (op.selected && op.value) {
                optionsSelectedArray.push(op.value + op.text);
            }
        });
    });

    Array.from(htmlCol).forEach((element) => {
        Array.from(element.options).forEach(op => {
            if (!op.seleted && optionsSelectedArray.includes(op.value + op.text)) {
                op.style.display = 'none';
            } else {
                op.style.display = 'block'
            }
        });
    });

}