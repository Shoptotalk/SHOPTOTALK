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
			var $btn = $($form).find("input[type='submit']");
			$btn.button('loading');
            location.href = '/';

		} else {
			if(responseText == "11000") msg = messages['userExist'];
				else msg = 'Error';
				
			$($form).find("input[type='password']").clearFields();
			$($form).find("input[type='submit']").removeAttr("disabled");
			if(!$($form).hasClass("error-form")) $($form).before(msg);
			$($form).addClass("error-form");
		}
	} 
	
});