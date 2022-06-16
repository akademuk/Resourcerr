function calcCount() {
    for (var i = 0; i < $('.number').length; i++) {
        var end = $('.number').eq(i).text();
        countStart(end, i);
    }
}

function countStart(end, i) {
    var start = 0;
    var interval = setInterval(function () {
        $('.number').eq(i).text(++start);
        if (start == end) {
            clearInterval(interval);
        }
    }, 8);
}
calcCount();