//ustawienie placeholder onfocus i onblur
window.onload=function(){
	
	var login_log_onfocus=document.getElementById("login_log");
	login_log_onfocus.onfocus = function() {
		document.getElementById("login_log").setAttribute("placeholder", "");
	};
	
	document.getElementById("login_log").onblur = function() {myFunction2()};
	document.getElementById("pass_log").onfocus = function() {myFunction3()};
	document.getElementById("pass_log").onblur = function() {myFunction4()};


	function myFunction2() {
	  document.getElementById("login_log").setAttribute("placeholder", "login");
	}

	function myFunction3() {
	  document.getElementById("pass_log").setAttribute("placeholder", "");
	}

	function myFunction4() {
	  document.getElementById("pass_log").setAttribute("placeholder", "haslo");
	}
}

