$(document).ready(function() {
	
	$('#contact-form').jqTransform();

	$("#contact-form").validationEngine({
		inlineValidation: false,
		promptPosition: "centerRight",
		ajaxSubmit: true,
		ajaxSubmitFile: "/lib/php/sendMail.php",
		ajaxSubmitMessage: "<h1>Flechaweb</h1> <p> Agradecemos seu contato, aguarde o retorno de nossa equipe! </p>",
		success :   false,
		failure :   function() {}
	 })	
	 
	   
    // expose the form when it's clicked or cursor is focused 
    $("#contact-form").bind("click keydown", function() { 
 
        $(this).expose({ 
            // custom mask settings with CSS 
            maskId: 'mask',
            api: true 
        }).load();
        
    }); 
    
});