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