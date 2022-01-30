// ALERT MESSAGES SETTINGS

var AlertMessage = {
    SUCCESS: 1,
    ERROR: 0,
    spinId: '32er32',
    printError: function ($elm, msg) {
        var out = '';
        console.log(msg);
        console.log(typeof  msg);
        if (typeof msg["errors"] === "object") {
            var a = [];
            for (var i in msg["errors"]) {
              // for (var j in msg[i]) {
              //
              //   a.push(msg[i][j]);
              // }
                a.push(msg["errors"][i]);
            }
            out = a.join("<br/>");
        } else {
            out = msg;
        }

        var tpl = AlertMessage.errorTpl();
        var msg = tpl.replace("##msg##", "<br/>" + out);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printSuccess: function ($elm, msg) {
        var tpl = AlertMessage.successTpl();
        msg = tpl.replace("##msg##", msg);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printInfo: function ($elm, msg) {
        var tpl = AlertMessage.infoTpl();
        msg = tpl.replace("##msg##", msg);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    errorTpl: function () {
        return "<div class='alert fresh-color alert-danger alert-dismissible' role='alert'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                        "<strong></strong> ##msg##" +
                "</div>"
    },
    successTpl: function () {
        return "<div class='alert fresh-color alert-success alert-dismissible' role='alert'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                        "<strong>Éxito!</strong> ##msg##" +
                "</div>"
    },
    infoTpl: function () {
        return "<div class='alert fresh-color alert-info alert-dismissible' role='alert'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                        "##msg##" +
                "</div>"
    },
    spin: function () {
        return "<div id='32er32' class='loader-container text-center color-white'>" +
                    "<div><i class='fa fa-spinner fa-pulse fa-3x'></i></div>" +
                    "<div>Cargando</div>" +
                "</div>"
    },
    showSpining: function (idElement) {
        $('.modal-content', idElement).append(AlertMessage.spin());
        $('.modal-content', idElement).addClass('loader');
    },
    hideSpining: function (idElement) {
        $(idElement).find("#" + AlertMessage.spinId).remove();
        $('.base-animation-load').removeClass( "loader-div" )
    },
    removeCurrentAlerts: function(){
        $('body .alert').remove()
    },
      showSpiningDiv: function (idElement) {
        $('.base-animation-load', idElement).append(AlertMessage.spinDiv());
        $('.base-animation-load', idElement).addClass('loader-div');
      },
      spinDiv: function () {
        return "<div id='32er32' class='loader-div-container text-center'>" +
          "<div><i class='fa fa-spinner fa-pulse fa-3x'></i></div>" +
          "<div>Cargando</div>" +
          "</div>"
      },
    };