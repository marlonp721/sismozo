export default (elm, e) => {
  
  e.preventDefault();
  elm.classList.add("disabled");
  const text = elm.innerHTML;
  while (elm.firstChild) {
    elm.removeChild(elm.firstChild);
  }
  const spinner = document.createElement("i");
  spinner.classList.add("fa", "fa-refresh", "fa-spin");
  const textNode = document.createTextNode(" " + text);
  elm.appendChild(spinner);
  elm.appendChild(textNode);

  if ($("#select_sync_port").length != 0) {
    var data = $("#select_sync_port").val();
    var technology= $("#technology").val();
    console.log(technology);

  } else {
    var data = [];
  }

  $.ajax({
    url: elm.href,
    data: { source: data ,technology:technology},
    //processData: false,
    contentType: false,
    type: "GET",
    success: function(data) {
      if (data.abort) {
        AlertMessage.printError(
          ".side-body",
          "SYNC: No se tiene conexión con el U2000"
        );
      } else if (data.me) {
        AlertMessage.printError(
          ".side-body",
          "Parámetro: ME incorrecto; valor actual: " + data.valor
        );
      } else if (data.null) {
        $("#select_sync_port").select2("focus");
        AlertMessage.printError(
          ".side-body",
          "Debe seleccionar una fuente"
        );
      } else if (data.total) {
        AlertMessage.printError(
          ".side-body",
          "Ya se tiene actualizados los equipos"
        );
      }else if (data.null_equipos) {
        AlertMessage.printError(
          ".side-body",
          "Debe seleccionar uno o varios equipos"
        );
      }else if (data.cero_equipos) {
        AlertMessage.printError(
          ".side-body",
          "No se encontraron equipos para actualizar"
        );
      }else if (data.cero_puertos) {
        AlertMessage.printError(
          ".side-body",
          "No se encontraron puertos para actualizar"
        );
      }else if (data.gestor_off) {
        AlertMessage.printError(
          ".side-body",
          "Los Gestores NFM-T Nokia no responden."
        );
      }else if (data.ssh_off) {
        AlertMessage.printError(
          ".side-body",
          "No se tiene acceso a los Gestores OptiX."
        );
      }else {
        $("#content-sync").empty();
        $.ajax({
          url: url_get_sync,
          data: {
            datos: data
          },
          type: "POST",
          dataType: "json",
          success: function(d) {
            $("#content-sync").append(d["html"]);
            $("#ModalSync").modal("show");
          },
          error: function(jqXHR) {}
        });

        $(".content-kendo")
          .data("kendoGrid")
          .dataSource.read();
      }
      elm.classList.remove("disabled");
      elm.innerHTML = text;
    }
  }).fail(() => {
    elm.classList.remove("disabled");
    elm.innerHTML = text;
  });
};
