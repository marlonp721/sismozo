export default function (ref, tabName, models, nSlots) {
    let count = $("a[data-toggle='tab']").length;
    try {
        count = parseInt(count);
        console.log('Que fue: ' + count);
    } catch (error) {
        console.log(error)
        count = 0;
    }
    count++;
    ref += count;
    tabName += count;
    let h = _.template(document.getElementById("tab-tpl").innerHTML);
    let b = _.template(document.getElementById("tab-body-tpl").innerHTML)
    let tap = $(h({ ref, tabName, count })).insertBefore($("#more-cards").parent());
    document.querySelectorAll("ul[role] li").forEach((elm) => {
        elm.classList.remove("active");
    });

    tap.addClass("active");
    var tt = document.getElementById("tpl-cards-form").innerHTML;

    var tpl = _.template(tt);

    var data_shelf=[{SeriaNumber:'',shelf:'',version_sw:'',ip_gestion:''}];

    $("#tab-content").append(b({ content: tpl({ count, models, nSlots ,cardModels: [{},{},{}],data_shelf }), ref, count }));
    document.querySelectorAll('div [role="tabpanel"]').forEach((elm) => {
        elm.classList.remove("active");
    }); 
    document.getElementById('tab-content').querySelector('[role="tabpanel"]:last-child').classList.add("active");
};
