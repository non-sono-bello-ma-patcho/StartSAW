/**
    Ajax
 **/
function loadDiv(doc, target){
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", doc, true);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(target).innerHTML =
                this.responseText;
        }
    };
    xhttp.send();
}

function showform() {
    $('#modalviewer').css('display', 'block');
}

function hideform() {
    $('#modalviewer').css('display', 'none').html('');
}


/* remove bullets from list on user */
function processBullets() {
    var lastElement = false;
    $("br").remove(".tempbreak");
    $("ul li").each(function() {
        $(this).removeClass("nobullet");
        if (lastElement && lastElement.offset().top != $(this).offset().top) {
            $(lastElement).addClass("nobullet");
            $(lastElement).append('<br class="tempbreak" />');
        }
        lastElement = $(this);
    }).last().addClass("nobullet");
}