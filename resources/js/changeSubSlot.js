let pro = new Promise((resolve, reject) => {
      resolve(); 
  });
  
  pro.then((successMessage) => {
    $("#sub-form-" + item + '-' + count).append(tpl({ count, item, subItem, models, init, q, cardParent, oldModel: {}}));
  });

  pro.then(() => {
    changeSlot('select-slot' + count+item);
  });