export default (e, event) => {
    event.preventDefault();
    const url = e.href;
    $.get(url)
        .done(function (data) {
            let content = _.template(document.getElementById("modal-ports").innerHTML);
            let equipo = data.equipo;
            let ports = data.puertos;
            const c = content({ ports, equipo });
            bootbox.dialog({
                className: "modal-primary",
                backdrop: true,
                message: c,
                title: equipo.Hostname,
                size: 'large',
                buttons: {
                    cancel: {
                        label: 'SALIR',
                        className: 'btn-secondary',

                    }
                }
            });

        });


}