
$(document).ready(function() {

    $('form').submit(function() {
        //alert($(this).serialize());
        //return false;
    });


    // ****************
    // form properties
    // ****************

    //$('.properties-form').hide();

    $('.properties-button').click( function(e) {
        $('.properties-form').slideToggle('slow');
    });

    $('#container .div-page .edit-block').click( function(e) {
        $('h3', $(this).parent()).slideToggle('slow');
        $('.content', $(this).parent()).slideToggle('slow');
    });
        
}); // end $(document).ready

function list_back(url) {
	window.location='/admin/'+url;
}

function page_del(id) {
	var check = confirm('Deseja realmente Excluir a Página ? \r\n Esta operação não poderá ser desfeita!');

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
