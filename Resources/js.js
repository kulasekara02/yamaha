
//////////////check if field is number//////////////
function isnumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

//////////////check if email address is valid // contains @. signs.// @ must not be the first character // . must at least be one character after @ //////////////
function checkEmail() {
var Email = document.ContactForm.txtemail.value;
symbolone = Email.indexOf("@");
symboltwo = Email.lastIndexOf(".");        
   if (symbolone < 1 || ( symboltwo - symbolone < 2 )) {alert("Please Enter A Correct Email Address")
	document.ContactForm.txtemail.focus();
   return false;
}
   return(true);
}
