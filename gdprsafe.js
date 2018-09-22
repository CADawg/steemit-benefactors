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

function prompt(message = "", callback = "console.log", callbackFunction = console.log, uniqueID = "", buttonOK = "Yes", buttonCANCEL = "No", pagename = "This page", killPrev = false) {
    if (killPrev === true) {
        $(".fs-overlay").remove();
    }

    if (readCookie(uniqueID) == null) {
        $("<div class='fs-overlay'><div class='midbox'><p>" + pagename + " says:</p>" + message + "<br><br><button class='chrome-alert' onclick='" + callback + "(true);$(this).parent().parent().remove();'>" + buttonOK + "</button><button class='chrome-cancel' onclick='" + callback + "(false);$(this).parent().parent().remove();'>" + buttonCANCEL + "</button></div></div>").appendTo("body");
    } else {
        if (readCookie(uniqueID) == true) {
            callbackFunction(true);
        } else {
            callbackFunction(false);
        }
    }
}

function injectTracking(should) {
    if (readCookie("gdprtracking") == null) {
        createCookie("gdprtracking", should, 31);
    }

    if(should) {

        var script=document.createElement('script');
        script.type='text/javascript';
        script.src= 'https://www.googletagmanager.com/gtag/js?id=UA-45168180-9';
        script.async = true;

        $("body").append(script);
        window.dataLayer=window.dataLayer || []; function gtag(){dataLayer.push(arguments);}gtag('js', new Date()); gtag('config', 'UA-45168180-9');
    }
}
$(document).ready(function() {
    prompt("<p>Allow us to run Analytics? 🙏</p>", "injectTracking", injectTracking, "gdprtracking");
});