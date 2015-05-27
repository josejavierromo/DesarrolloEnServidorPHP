$(document).ready(function(){

	/**
	* While pressed the button, it show the password
	*
	*/
	$("#showPassword").on("mousedown", function(e){
		$("#loginform-password").attr("type","text");
	});

	/**
	* When the button end click, it hide the password.
	*
	*/
	$("#showPassword").on("mouseup", function(e){
		$("#loginform-password").attr("type","password");
	});

	/**
	* Clear the user text box
	*
	*/
	$("#clearUser").on("click", function(e){
		$("#loginform-username").val("");
	});

	/**
	* Clear the password text box
	*
	*/
	$("#clearPassword").on("click", function(e){
		$("#loginform-password").val("");
	});

});