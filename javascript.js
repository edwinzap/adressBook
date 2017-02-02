
function validate() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("confirm_password").value;
    if (pass1 != pass2) {
        document.getElementById("password").style.borderColor = "red";
        document.getElementById("confirm_password").style.borderColor = "red";

        var message = document.getElementById("message");
        message.innerHTML = "Les mots de passe ne correspondent pas";
        message.style.color = "red";

        return false;
    } else {
        return true;
    }
}

function Submit() {
    //  alert('ok');
    document.forms[0].submit();
}

function SetFocus(champ)
{
    document.getElementById(champ).focus();
}

function GetBackSpace(e)
{
    var keynum;

    if(window.event) { // IE                    
      keynum = e.keyCode;
    } else if(e.which){ // Netscape/Firefox/Opera                   
      keynum = e.which;
    }
    //8 = backspace
    if(keynum==8){
        
    }
}


