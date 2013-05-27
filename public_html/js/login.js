
var login = {
	submit:function(){
		if ( $('#usuario').val().trim() != '' && $('#clave').val().trim() != '' ){
			document.form_login.submit();
		}
	}
}

$(document).ready(function(){
	$('#btn_ingresar').click(login.submit);
});