

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = 	{"required":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* Este Campo não pode ser nulo",
						"alertTextCheckboxMultiple":"* Selecione uma Opção",
						"alertTextCheckboxe":"* Seleção necessária"},
					"length":{
						"regex":"none",
						"alertText":"*Entre  ",
						"alertText2":" e ",
						"alertText3": " Caracteres permitidos "},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* Quantidade de Seleções excedidas "},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* Por favor, Selecione ",
						"alertText2":" Opções"},	
					"confirm":{
						"regex":"none",
						"alertText":"* Your field is not matching"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* Telefone inv&aacute;lido "},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* E-Mail inv&aacute;lido "},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* Data inv&aacute;lida, Deve ser informado no seguinte formato: YYYY-MM-DD "},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* Somente N&uacute;meros"},	
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z]+$/",
						"alertText":"* Caracteres especiais não permitido"},	
					"ajaxUser":{
						"file":"validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"* Usuário dispon&iacute;vel",	
						"alertTextLoad":"* Carregando, Aguarde",
						"alertText":"* Usu&aacute;rio indisponivel"},	
					"ajaxName":{
						"file":"validateUser.php",
						"alertText":"* This name is already taken",
						"alertTextOk":"* This name is available",	
						"alertTextLoad":"* Loading, please wait"},		
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* Somente Texto"}
					}	
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});