Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 0 : c,
        d = d == undefined ? "," : d,
        t = t == undefined ? "." : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

$(document).ready(function () {
    $('.price').each(function () {
        var value = $(this).html();
        console.log(parseInt(value).formatMoney());
        $(this).html(parseInt(value).formatMoney());
    });
});