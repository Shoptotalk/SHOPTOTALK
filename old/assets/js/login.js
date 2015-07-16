$(function(){
	var errorMsg,validForm;
	$("#loginForm").validate();
	$('#loginForm').ajaxForm({
		success: showResponse
	});
	
	$("#registerForm").validate();	
	$('#registerForm').ajaxForm({
		success: showResponse
	});
	
	function showResponse(responseText, statusText, xhr, $form)  { 
		if(responseText == "true") {
			$(".form_error").remove();
			$($form).find("input[type='submit']").attr("value","Loading...");
			$($form).find("input[type='submit']").after('<img src="images/loader.gif" id="loader" alt="Loading" />');
			$("#loader").show();
			setTimeout(function(){
				location.href = '/main';
			},3000);
		} else {
			if(responseText == "11000") msg = messages['userExist']; // MongoDB duplicate err = 11000;
				else msg = messages[ $($form).attr("id") + '_error'];
				
			$("#loader").remove();
			$($form).find("input[type='password']").clearFields();
			$($form).find("input[type='submit']").removeAttr("disabled");
			if(!$($form).hasClass("error-form")) $($form).before(msg);
			$($form).addClass("error-form");
		}
	} 
	
});