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

$("#subjs").click(function() {
    e.preventDefault();
    var url = "submitpost.php?js"; // the script where you handle the form input.

    $.ajax({
        type: "POST",
        url: url,
        data: $("#postform").serialize(), // serializes the form's elements.
        success: function(data)
        {
            var ds = data.split(":|:&*83252835723&&+£");
            if (1 in ds) {
                alert(ds[1], "Steemit Benefactors", true)
            } else {
                alert(ds[0], "Steemit Benefactors", true);
            }

        }
    });

    return false;
});

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