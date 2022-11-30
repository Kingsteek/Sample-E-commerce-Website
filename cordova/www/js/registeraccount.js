
var password = document.getElementById("password"), //get the password field
confirm_password = document.getElementById("confirm_password"); //get the confirme password field

function validatePassword() //compare if the passwords entered indeed match.
{
    if(password.value != confirm_password.value) 
    {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } 
    else 
    {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
            
     