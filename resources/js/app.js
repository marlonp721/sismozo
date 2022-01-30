let changeSlot = require("./changeSlot").default;
let _ = require('lodash');
import createTab  from "./createTab";
let createRow = require("./createRow").default;
import openModal from "./openModal";
let createSubRow = require("./createSubRow");
import deleteSubRow, { removedCards, removedSubCars } from "./deleteSubRow";
let loadTab = require("./loadFirstTab").default;
let changeVendor = require('./changeVendor').default;
let clickTab = require('./clickTab').default;
let getPorts = require('./getPorts').default;
import {deleteTab, toDeleteCol} from './deleteTab'
let myObj = {
    cardModels: [],
    nSlots: 0
};


export  {
    deleteTab,
    getPorts,
    clickTab,
    changeVendor,
    loadTab,
    createTab,
    createRow,
    myObj,
    openModal,
    createSubRow,
    deleteSubRow,
    changeSlot
}




$(document).ready(() => {
   
    $("#more-cards").click(() => {
        try {
            const selectedModel = document.getElementById('id_modelo');
            const selectedOption = selectedModel.options[selectedModel.selectedIndex]
            const cardsFromSeletecModel = selectedOption.dataset.collect;
            const nSlots = selectedOption.dataset.nSlots;
            createTab('shelf', 'SHELF', JSON.parse(cardsFromSeletecModel), nSlots);
        } catch (error) {
            const dialog = bootbox
                .dialog({
                    className: "modal-danger",
                    backdrop: true,
                    message: "Seleccione un modelo",
                    title: "AVISO"
                });

            hideModal(dialog, 2);
        }

    });

    $('#new-equipment').click((e) => {

        console.log("Todelete: " + toDeleteCol);
        //alert(items_card_remove)
        //alert(items_subcard_remove);
        e.preventDefault();
        let idElm = document.getElementById("register_equipment");
        const inputs = idElm.getElementsByTagName('input');
        const selects = idElm.getElementsByTagName('select');
        const subCards = document.querySelectorAll('td[data-order]');

        let form = new FormData(idElm);
        form.append('__todelete__', [...toDeleteCol])
        form.append('__todeleteCards__', [...removedCards])
        form.append('__todeleteSubCards__', [...removedSubCars])

        subCards.forEach((e) => {
            
            form.append(e.dataset.name, e.dataset.value);

        });

        [...inputs, ...selects].forEach((i) => {
            
            form.append(i.name, i.value);
        });



        console.log("TOTAL: " + [...inputs, ...selects].length);
        console.log(subCards.length);
        //console.log(JSON.stringify(form));

        // items_card_remove.forEach((h)=>{
        //     form.append("equipment[remove_card][]", h);
        // });

        //  items_subcard_remove.forEach(sb => {
        //    form.append("equipment[remove_subcard][]", sb);
        //  });
        
        var object = {};

        $.ajax({
          url: idElm.action,
          async: false,
          data: form,
          processData: false,
          contentType: false,
          type: "POST",
          success: function(data) {
            console.log(data);
          }
        });

       form.forEach((value, key) => { object[key] = value });
        var json = JSON.stringify(object);
        console.log(object);
        location.href= idElm.dataset.redirect;
        
        
        
    });

    $(document).on('change', '.type_status_select', function (e) {

        if (e.target.dataset.default !== '') {
            var success_dialog = bootbox.dialog({
                className: "modal-primary",
                backdrop: true,
                message: 'Se eliminarán todas las tarjetas y sub tarjetas',
                title: "Aviso",                
                buttons: {
                    confirm: {
                        label: 'ACEPTAR',
                        className: 'btn-success',
                        callback: function () {
                            /** getting card Id  */
                            const input = document.querySelector('select.type_status_select').parentElement.firstElementChild;
                            if (input.tagName != 'INPUT')
                                return;
                            const cardId = input.value;
                            let url = document.getElementById('register_equipment').dataset.delSubsUrl
                            if (!url || url == '')
                                return;
                            url = url.replace('#card#', cardId);
                            $.ajax({
                                type: 'POST',
                                url: url,
                            }).done(() => {
                                e.target.dataset.default = '';
                                $("a[role='tab']").parent().remove();
                                $("div[role='tabpanel']").remove()
                                
                            });

                        }
                    },
                    cancel: {
                        label: 'CANCELAR',
                        className: 'btn-danger',
                        callback: () => {
                            e.target.value = e.target.dataset.default;
                        }

                    }
                }
            });
        }


        let elm = e.target.parentElement.parentElement;
        let selected = e.target.options[e.target.selectedIndex]
        let initSub = selected.dataset.initSub;
        let nSub = selected.dataset.nSub;
        let moId = selected.value;
        let toElm = elm.querySelector("div button");
        toElm.dataset.nSub = nSub;
        toElm.dataset.initSub = initSub;
        toElm.dataset.moId = moId;
        toElm.dataset.moName = selected.text;

    });


    $("#id_site").change(function () {
        let value = $(this).val();
        let elm = document.getElementById('id_site');
        let toInner = document.getElementById('id_sala');
        let url = elm.dataset.url;

        $.ajax({
            url: url + '/' + value,
            processData: false,
            contentType: false,
            type: 'GET',
            success: function (data) {
                const singleOption = '<option></option><% _.forEach(salas, function(s) { %><option value="<%= s.id %>"><%= s.sala %></option><% }); %>'
                const out = _.template(singleOption);
                const toDelete = toInner.querySelectorAll('option')
                toDelete.forEach(i => toInner.removeChild(i));
                toInner.insertAdjacentHTML('beforeend', out({ salas: JSON.parse(data) }));
            }
        });

    });


});