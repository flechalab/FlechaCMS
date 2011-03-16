function list_back(url) {
	window.location='/admin/'+url;
}

function page_del(id) {
	var check = confirm('Deseja realmente Excluir a Página ? \r\nEsta operação não poderá ser desfeita!');

	if(check) {
		window.location='/admin/pages/del/'+id;
	}
		
}

function div_del(page_id, id) {
	var check = confirm('Deseja realmente Excluir a Div ? \r\nEsta operação não poderá ser desfeita!');

	if(check) {
		window.location='/admin/pages/'+page_id+'/divs/del/' + id;
	}
		
}

function user_del(id) {
	var check = confirm('Deseja realmente Excluir o Usuário ? \r\nEsta operação não poderá ser desfeita!');

	if(check) {
		window.location='/admin/users/del/'+id;
	}
		
}
