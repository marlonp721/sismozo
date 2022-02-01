// CRUD MODAL SETTINGS

var ModalSettings = {
  entity: 'ENTIDAD',
  selector: 'entity',
  create: {
    class_modal: 'modal-primary',
    url: false,
    title: 'NUEVO REGISTRO DE ::ENTITY::',
    size: 'large',
    element: '.new-::selector::-entity',
    form: '#form-::selector::-create',
   // submit: 'GUARDAR',
    submit: 'GUARDAR PEDIDO',
    messages: {
      confirm: {
        title: 'CREACIÓN DE ::ENTITY::',
        body: '¿Está seguro de crear este registro de ::ENTITY::?',
        success: 'El registro se creó correctamente.',
      }
    },
    conditions: {
      confirm_dialog: true,
      validation: false,
      ignore_fields: false,
    },
    redirect: {
      url: false
    }
  },
  edit: {
    class_modal: 'modal-primary',
    url: false,
    name: 'NAME',
    title: 'EDITAR ::ENTITY:: "::NAME::"',
    element: '.edit-::selector::-entity',
    form: '#form-::selector::-update',
    submit: 'EDITAR PEDIDO',
    //submit: 'ACTUALIZAR',
    messages: {
      confirm: {
        title: 'EDICIÓN DE ::ENTITY::',
        body: '¿Está seguro de actualizar este registro de ::ENTITY::?',
        success: 'El registro se actualizó correctamente.',
      }
    },
    conditions: {
      confirm_dialog: true,
      validation: false,
      ignore_fields: false,
    },
  },
  delete: {
    class_modal: 'modal-danger',
    url: false,
    name: 'NAME',
    title: 'ELIMINAR ::ENTITY:: "::NAME::"',
    element: '.delete-::selector::-entity',
    form: '#form-::selector::-delete',
    //submit: 'ELIMINAR',
    submit: 'ELIMINAR PEDIDO',
    messages: {
      confirm: {
        title: 'ELIMINACIÓN DE ::ENTITY::',
        body: '¿Está seguro de eliminar este registro de ::ENTITY::?',
        success: 'El registro se eliminó correctamente.',
      }
    },
    conditions: {
      confirm_dialog: false,
      validation: false,
      ignore_fields: false,
    },
  },
  show: {
    class_modal: 'modal-primary',
    url: false,
    title: '::ENTITY:: #::NAME::',
    element: '.show-::selector::-entity',
    submit: false,
  },
  show_reprocesar: {
    class_modal: 'modal-primary',
    url: false,
    title: '::ENTITY::', // #::NAME::',
    element: '.show-reprocesar-::selector::',
    form: '#form-::selector::-update-reprocesar',
   // submit: 'GUARDAR',
    submit: 'ACEPTAR',
    messages: {
      confirm: {
        title: 'CONFIRMACION PARA REPROCESAR ::ENTITY::',
        body: '¿Está seguro de reprocesar estos registros de ::ENTITY::?',
        success: 'El registro se reprocesó correctamente.',
      }
    },
    conditions: {
      confirm_dialog: true,
      validation: false,
      ignore_fields: false,
    },
    redirect: {
      url: false
    }
  }

}

var ModalCRUD = {

  create: function (MS) {

    var MC = this;

    $(MS.create.element.replace('::selector::', MS.selector)).on('click', function () {

      var action_element = MC.disableElement($(this))
      console.log(action_element)
      $.get(MS.create.url).done(function (view) {

        ModalForm(MC, MS, MS.create, view, null, action_element)
      });
    });
  },
  edit: function (MS) {

    var MC = this;


    $('body').on('click', MS.edit.element.replace('::selector::', MS.selector), function () {

      MC.customRUD(MS, $(this), 'edit')
    });
  },
  show: function (MS) {

    var MC = this;

    $('body').on('click', MS.show.element.replace('::selector::', MS.selector), function () {

      MC.customRUD(MS, $(this), 'show'); 
    });
  },
  show_reprocesar: function (MS) {
  
    var MC = this;

    $('body').on('click', MS.show_reprocesar.element.replace('::selector::', MS.selector), function () {
	  console.log('jjj');
      MC.customRUD(MS, $(this), 'show_reprocesar'); 
      
    });
  },
  delete: function (MS) {

    var MC = this;

    $('body').on('click', MS.delete.element.replace('::selector::', MS.selector), function () {

      MC.customRUD(MS, $(this), 'delete')
    });
  },
  customRUD: function (MS, _this, method) {

    var MC = this;

    var action_element = MC.disableElement(_this)
    
    var id = $(action_element).parent().data('id');

    MS[method].name = String($(action_element).parent().data('name'));

    var url = MS[method].url.replace(':ROW_ID', id);
    
    console.log('el row id'+id);
    
    console.log('url .'+url);

    $.get(url).done(function (view) {
    	console.log(view);

      ModalForm(MC, MS, MS[method], view, id, action_element)
    });
  },
  sendAjax: function (url, data, settings) {

    var MC = this;

    $.ajax({
      url: url,
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function (data) {
        
        if(typeof data ==='object') {
          $('.bootbox').modal('hide');
          AlertMessage.printError(".side-body",data.msg);
        }else{
              $('.bootbox').modal('hide');
            if (settings.kendo) {
              refreshKendo(settings.kendo)
            } else {
            refreshKendo()
            }
            var success_dialog = bootbox.dialog({
              className: 'modal-success',
              backdrop: true,
              message: settings.messages.confirm.success,
              title: "ÉXITO",
            })

            hideModal(success_dialog, 3)
        }
        
      },
      error: function (jqXHR) {
        MC.closeConfirmDialog()
      }
    });
  },
  closeConfirmDialog: function () {
    AlertMessage.hideSpining('.confirm-dialog')
    $('.confirm-dialog').modal('hide')
  },
  disableElement: function (action_element) {
    $(action_element).addClass('not-active')
    return action_element
  },
  init: function (MS) {
    var MC = this;

    $.each(MS, function (index, object) {

      if (object.url != false && object.url != undefined) {
        console.log('public/js/custom/functions.js : '+index);
        MC[index](MS);
      }
    });
   
  }

}; //modalCRUD
var CRUD = {

  create: function (MS) {

    var MC = this;

    FormView(MC, MS, MS.create, null)

  },
  edit: function (MS) {

    var MC = this;

    $('body').on('click', MS.edit.element.replace('::selector::', MS.selector), function () {

      MC.customRUD(MS, $(this), 'edit')
    });
  },
  show: function (MS) {

    var MC = this;

    $('body').on('click', MS.show.element.replace('::selector::', MS.selector), function () {

      MC.customRUD(MS, $(this), 'show')
    });
  },
  delete: function (MS) {

    var MC = this;

    $('body').on('click', MS.delete.element.replace('::selector::', MS.selector), function () {

      MC.customRUD(MS, $(this), 'delete')
    });
  },
  customRUD: function (MS, _this, method) {

    var MC = this;

    var action_element = MC.disableElement(_this);

    var id = $(action_element).parent().data('id');

    MS[method].name = String($(action_element).parent().data('name'));

    var url = MS[method].url.replace(':ROW_ID', id);
	console.log('url .'+url);
    $.get(url).done(function (view) {
	console.log('view '+view);
      ModalForm(MC, MS, MS[method], view, id, action_element)
    });
  },
  sendAjaxCrud: function (url, data, settings, MS) {
    // console.log(url)
    // console.log(data)
    // console.log(settings)
    // console.log(MS)
    // return false;
    var MC = this;

    $.ajax({
      url: url,
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function (data) {
        
        $('.bootbox').modal('hide');

        //refreshKendo()
        console.log('close');
        var success_dialog = bootbox.dialog({
          className: 'modal-success',
          backdrop: true,
          message: settings.messages.confirm.success,
          title: "ÉXITO",
        })

        hideModal(success_dialog, 3)
        window.location.href = MS.create.redirect.url;
      },
      error: function (jqXHR) {
        console.log(jqXHR);
        MC.closeConfirmDialog()
      }
    });
  },
  closeConfirmDialog: function () {
    AlertMessage.hideSpining('.confirm-dialog')
    $('.confirm-dialog').modal('hide')
  },
  disableElement: function (action_element) {
    $(action_element).addClass('not-active')
    return action_element
  },
  init: function (MS) {
    var MC = this;

    $.each(MS, function (index, object) {

      if (object.url != false && object.url != undefined) {
        MC[index](MS);
      }
    })
  }

}; //modalCRUD

function ModalForm(MC, MS, settings, view, id, action_element) {
  //Solo los Forms modales de las operaciones edit, create, destroy 
  //tienen settings.submit diferente de false
  if (settings.submit) {
  	
    var idform = settings.form;
	
    console.log(idform)
    //Este codigo se aplica para el modulo security/users 
    if(MS.selector=='user' && idform!="#form-::selector::-delete"){
      buttons = {
        main: {
          label: settings.submit,
          className: 'btn-primary',
          callback: function () {

            if (settings.conditions.ignore_fields) {
              ignoreFields(settings.conditions.ignore_fields)
            }

            var form = $(settings.form.replace('::selector::', MS.selector));

            var url = form.attr('action').replace(':ROW_ID', id);

            AlertMessage.removeCurrentAlerts()

            if (settings.conditions.validation) {
              $(form).validate(settings.conditions.validation);
            }

            var data = $(form).serialize();

            if (settings.conditions.validation && !form.valid()) {
              return false;
            }

            if (settings.conditions.confirm_dialog) {
              ModalConfirm(MC, MS, form_dialog, url, data, settings)
            }
            else {
              MC.sendAjax(url, data, settings)
            }

            return false;
          }
        },
       /* clean: {
          label: 'LIMPIAR',
          className: 'btn-clean',
          callback: function () {
            var form = $(settings.form.replace('::selector::', MS.selector));
            $(form)[0].reset();
            $("input[type='text'],input[type='checkbox'], textarea").each(
              function(){
                $(this).val('');
                this.checked = false;
              }
            );
            $('.select2').val('').trigger('change');
            return false;
          }
        },*/
        default: {
          label: 'CANCELAR',
          className: 'btn-default',
        }
      }
    } //if(MS.selector=='user' && 
    else{
      buttons = {
        main: {
          label: settings.submit,
          className: 'btn-primary valpedido',
          callback: function () {
            if(cont==1){
                    cont=0;
                        if (settings.conditions.ignore_fields) {
                          ignoreFields(settings.conditions.ignore_fields)
                        }

                        var form = $(settings.form.replace('::selector::', MS.selector));

                        var url = form.attr('action').replace(':ROW_ID', id);
                        AlertMessage.removeCurrentAlerts()
                        if (settings.conditions.validation) {
                          $(form).validate(settings.conditions.validation);
                        }

                        var data = $(form).serialize();

                        if (settings.conditions.validation && !form.valid()) {
                          return false;
                        }

                        if (settings.conditions.confirm_dialog) {
                          ModalConfirm(MC, MS, form_dialog, url, data, settings)
                        }
                        else {
                          MC.sendAjax(url, data, settings)
                        }
                        return false;
            }
            else{
              
            $v_ajidegallina = $('#cmb_ajidegallina').val();
            $v_tallarinconpollo = $('#cmb_tallarinconpollo').val();
            $v_lomosaltado = $('#cmb_lomosaltado').val();
            $v_estofadodepollo = $('#cmb_estofadodepollo').val();
            $v_tacutacu = $('#cmb_tacutacu').val();
            $v_chicharron = $('#cmb_chicharron').val();
            if( $v_ajidegallina=="" && $v_tallarinconpollo=="" && $v_lomosaltado=="" && $v_estofadodepollo=="" && $v_tacutacu=="" && $v_chicharron==""){
                bootbox.dialog({
                  className: 'modal-danger',
                  closeButton: false,
                  message: "NO SE INTRODUJO EL PEDIDO, NO HAY CANTIDADES",
                  title: "VALIDACION",
                  buttons: {
                      default: {
                          label: "CERRAR",
                          className: "btn-danger pr",
                          callback: function() {
                              
                          }
                      },
                  }
                });
              }else{
                if( isNaN($v_ajidegallina) || isNaN($v_tallarinconpollo) || isNaN($v_lomosaltado) || isNaN($v_estofadodepollo) || isNaN($v_tacutacu) || isNaN($v_chicharron) )
                {
                validacion_pedidos();
                }
                else{
                        if (settings.conditions.ignore_fields) {
                          ignoreFields(settings.conditions.ignore_fields)
                        }

                        var form = $(settings.form.replace('::selector::', MS.selector));

                        var url = form.attr('action').replace(':ROW_ID', id);


                        AlertMessage.removeCurrentAlerts()

                        if (settings.conditions.validation) {
                          $(form).validate(settings.conditions.validation);
                        }

                        var data = $(form).serialize();

                        if (settings.conditions.validation && !form.valid()) {
                          return false;
                        }

                        if (settings.conditions.confirm_dialog) {
                          ModalConfirm(MC, MS, form_dialog, url, data, settings)
                        }
                        else {
                          MC.sendAjax(url, data, settings)
                        }

                        return false;
                  }
                }
            }
          }

        },
        default: {
          label: 'CANCELAR',
          className: 'btn-default',
        }
      }
    } //else if(MS.selector=='user' && 


  }
  else {
    //bloque de codigo original, en lugar del else para el if de forecast
    //se aplica para el metodo show
  	buttons = {
      default: {
        label: 'SALIR',
        className: 'btn-default',
      }
    }
  	
  	
  } //function ModalForm

  //objeto dialog que se muestra con los datos en forma de popup
  var form_dialog = bootbox.dialog({
    className: settings.class_modal + ' modal-form',
    closeButton: false,
    size: 'large',
    message: view,
    title: settings.title.replace('::ENTITY::', MS.entity).replace('::NAME::', settings.name),
    buttons: buttons
  }).on('hidden.bs.modal', function (e) {
	
    var modal = e.target

    if ($(modal).hasClass('modal-form')) {
      $(action_element).removeClass('not-active')
    }
  });

  $('.modal').scrollTop(0)
  $('.modal').animate({ scrollTop: 0 }, 'slow');
}

function FormView(MC, MS, settings, id) {
  
  $('.btn-primary').on('click', function () { alert('FormView');

    if (settings.conditions.ignore_fields) {
      ignoreFields(settings.conditions.ignore_fields)
    }

    var form = $(settings.form.replace('::selector::', MS.selector));

    var url = form.attr('action').replace(':ROW_ID', id);

    AlertMessage.removeCurrentAlerts()

    if (settings.conditions.validation) {
      $(form).validate(settings.conditions.validation);
    }

    var data = $(form).serialize();

    console.log(settings.conditions.confirm_dialog);

    if (settings.conditions.validation && !form.valid()) {
      return false;
    }

    //return false;
    if (settings.conditions.confirm_dialog) {
      ConfirmCrud(MC, MS, url, data, settings)
    }
    // else
    // {
    //   MC.sendAjax(url, data, settings)
    // }

    return false;


  });


}

function ModalConfirm(MC, MS, form_dialog, url, data, settings) {
  console.log(form_dialog);
  var confirm_dialog =
    bootbox.dialog({
      className: 'modal-primary confirm-dialog',
      closeButton: false,
      backdrop: true,
      message: settings.messages.confirm.body.replace('::ENTITY::', MS.entity),
      title: settings.messages.confirm.title.replace('::ENTITY::', MS.entity),
      buttons: {
        default: {
          label: 'NO',
          className: 'btn-default',
          callback: function (e) {
          }
        },
        main: {
          label: 'SÍ',
          className: 'btn-primary',
          callback: function () {

            AlertMessage.showSpining('.confirm-dialog')
            //

            MC.sendAjax(url, data, settings)
            //
            return false;
          }
        }
      }
    }).init(function () {

      form_dialog.addClass('push-back');

    }).on('hidden.bs.modal', function (e) {

      form_dialog.removeClass('push-back');

      var modal = e.target

      if ($(modal).hasClass('confirm-dialog')) {
        var $body = $('body')
        $body.addClass('modal-open')
      }
    });
}

function ConfirmCrud(MC, MS, url, data, settings) {


  var confirm_dialog =
    bootbox.dialog({
      className: 'modal-primary confirm-dialog',
      closeButton: false,
      backdrop: true,
      message: settings.messages.confirm.body.replace('::ENTITY::', MS.entity),
      title: settings.messages.confirm.title.replace('::ENTITY::', MS.entity),
      buttons: {
        default: {
          label: 'NO',
          className: 'btn-default',
          callback: function (e) {
          }
        },
        main: {
          label: 'SÍ',
          className: 'btn-primary',
          callback: function () {

            AlertMessage.showSpining('.confirm-dialog')
            //
            // console.log(MC)
            // return false;
            MC.sendAjaxCrud(url, data, settings, MS)
            //
            return false;
          }
        }
      }
    }).init(function () {

      //form_dialog.addClass('push-back');

    }).on('hidden.bs.modal', function (e) {

      // form_dialog.removeClass('push-back');

      var modal = e.target

      if ($(modal).hasClass('confirm-dialog')) {
        var $body = $('body')
        $body.addClass('modal-open')
      }
    });
}

// OTHER SETTINGS

function ignoreFields(fields) {
  $(fields).addClass('ignore')
}

function hideModal(element, seconds) {
  setTimeout(function () {
    $(element).modal('hide');
  }, seconds * 1000);
}

function exportGrid(urlExport, filter, report_name) {
  if (current_grid_total > 50000) {
    AlertMessage.printInfo('.side-body', 'La cantidad de registros para la exportación debe ser menor a 50 mil.')
    $('.btn_export').attr('disabled', true);

    return false;
  }

  $.ajax({
    url: urlExport,
    type: "get",
    data: {filter: {filters: filter}, report: report_name, sort: sorter},
    beforeSend: function (xhr) {
      window.location = this.url
      xhr.abort();
    }
  });
}

function newModalSettings() {
  return $.extend(true, {}, ModalSettings);
}

function newModalCRUD() {

  return $.extend(true, {}, ModalCRUD);
}

function newCRUD() {
  return $.extend(true, {}, CRUD);
}
function newModalConfirm() {
  return $.extend(true, {}, SettingsConfirm);
}

/*CRUD SIN MODAL*/
var SettingsConfirm = {
  entity: 'ENTIDAD',
  selector: 'entity',
  messages: {
    confirm: {
      title: '',
      body: '',
      //success: 'El registro se creó correctamente.',
    }
  },
  redirect:{
    url_direct:false
  }

}

function ConfirmSave(settings,functions,parametros,modalform) {



  var confirm_dialog =
    bootbox.dialog({
      className: 'modal-primary confirm-dialog',
      closeButton: false,
      backdrop: true,
      message: settings.messages.confirm.body,
      title: settings.messages.confirm.title,
      buttons: {

        main: {
          label: 'SÍ',
          className: 'btn-primary',
          callback: function () {

            AlertMessage.showSpining('.confirm-dialog')
            //
            // console.log(MC)
            // return false;
            //MC.sendAjaxCrud(url, data, settings, MS)
            if(typeof parametros !=="undefined"){
              functions(parametros);
            }
            else{
              functions();
            }

            return false;
          }
        },
        default: {
          label: 'NO',
          className: 'btn-default',
          callback: function (e) {
          }
        }
      }
    })
      .init(function () {
      if(typeof modalform !=="undefined"){
        console.log(modalform);
        modalform.addClass('push-back');
      }


    }).on('hidden.bs.modal', function (e) {
//
       if(typeof modalform !=="undefined"){
//       //   console.log('hidden');
//       //   console.log(modalform);
           modalform.removeClass('push-back');
//       //
//       //   var modal = e.target
//       //
//       //   if ($(modal).hasClass('confirm-dialog')) {
//       //     var $body = $('body')
//       //     $body.addClass('modal-open')
//       //   }
       }
//
//
    });
 }

function sendFormSubmit(id){

  //console.log(id);
  document.getElementById(id).submit();

}// CRUD MODAL SETTINGS