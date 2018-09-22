new tooltip(document.getElementById("permlink-tt"));
new tooltip(document.getElementById("tags-tt"));
new tooltip(document.getElementById("benefactors-tt"));
new tooltip(document.getElementById("rewardshare-tt"));


$(document).ready(function() {
    $("#subjs").removeClass("no-js");
});

/*setInterval(function () {
    var markAble = "";
    $(".CodeMirror-line").each(function (index) {
        markAble = markAble + $($(".CodeMirror-line")[index]).text() + "\n";
    });
    document.getElementById('yourpost').innerHTML = simplemd.options.previewRender(markAble);
    $('#yourpost').find("code").addClass("w3-codespan ch-mono");
}, 1000);*/

function createCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}