UserSettings.create.conditions.validation = {
    rules:{
      fullname: {required: true, maxlength: 100},
      area: {required: true},
      status: {required: true},
      cellphone: {required: true},
      email: {required: true, email: true},
      email_repeat: {required:'#email',equalTo: "#email"},
      "roles[]": {digits: true,required:true}
    },
    ignore: ".ignore",
    errorPlacement: function (error, element) {
      console.log($(element));
      if( $(element).hasClass("select2-hidden-accessible") )
      {
        console.log($(element));
        $(element).next().find(".select2-selection").addClass('error');
        error.insertAfter("#"+$(element).attr("id")+ " + span.select2-container");
      }

      if (element.attr("type") == "checkbox") {

        $(element).parents('table').addClass('error')
        $(element).parents('table').removeProp('border-collapse')


        error.insertAfter($(element).parents('table'));
      }
    },
  };