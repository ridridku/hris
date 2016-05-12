function Check_Form(){
			if (document.login.txt_username.value == "") 
			{
				alert("Silahkan isi user name !");				
				document.login.txt_username.focus();
				return false;
				
			}
			if (document.login.txt_password.value == "") 
			{
				alert("Silahkan isi Password !");				
				document.login.txt_password.focus();
				return false;
				
			}
			else
			{
				document.login.submit();
				
			}
return false;

}

function set_focus()
{
		document.login.txt_username.focus();	
}
function CheckEnter() {
	if (event.keyCode==13) {
		return Check_Form();
		return false;
	}
	return false;
}
