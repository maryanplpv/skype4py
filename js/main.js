$(document).ready(function(){

// login
$("#login_form").submit(function( event ) {
	
	event.preventDefault();
	
	// show progress
	$('.loading-p').css('display', 'inline-block');
	
	// send data AJAX
	$.post("./authentication/login/", $(this).serialize(), function(r){

		// hide progress
		$('.loading-p').hide();
		
		// successful
		if (r == 1) {
			url = "http://localhost/test2017.loc";
			$( location ).attr("href", url);					
		} else {
			alert('Логин или пароль с ошибками!');
		}
		
	});
});
	

// Send skype message form
$("#message-form").submit(function( event ) {

		
	event.preventDefault();
	
	// show progress
	$('.btn-primary', this).append('<span class="loading-p" style="display: inline-block"></span>');

			
	// ajax login
	$.post("./messages/savenew/", $(this).serialize(), function(r){

		if (r == 1) {				
		
			//reset form
			$('#message-form').trigger("reset");
			
			// close modal
			$('#send-message-dialog').modal('hide');
			
			get_messages_list();
				
		} else {
			alert("Поля заполнены с ошибками!");
		}
	
		// hide progress
		$('.btn-primary .loading-p').remove();
			
	});
	
		
});
	
	
// logout
$('#logout').click(function(){
	
	// send data
	$.post("./authentication/logout/", {}, function(r){
		
		if (r == 1) {
			url = "http://localhost/test2017.loc";
			$( location ).attr("href", url);
		}
		
	});
});

	
});



// reload complaint list
function get_messages_list(page = 1, sortfield = get_sortfield() ) {

	$.post("./messages/index/", {listpage: page, sort: sortfield}, function(j) {

		
		if (($("#content tbody tr").length <=0) || (typeof($("#content table").html()) == 'undefined')) {
	
			$('.alert-success').remove();
			$('#content').html('<table class="table table-striped">'+$('table', j).html()+'</table>');
			$('#content').append('<ul class="pagination">'+$('.pagination', j).html()+'</ul>');
			
			
		} else {
			$('#content table > tbody').html($('table > tbody', j).html());
			$('#content .pagination').html($('.pagination', j).html());
			
		}
		
		if (total_pages() == 0 && $("#content tbody tr").length == 0) {
			$('#content').html('<div class="alert alert-success" role="alert">Sent messages not found!</div>');
		}
		

	});
	
}


// get_sortfield()
function get_sortfield() {
	
	var id;
	
	$(".sorting-radio input[name='sort']:checked").each(function() {

		id = $(this).attr('id');
		id = id.replace('_', ' ');

	});
	
	if (typeof(id) == 'undefined') {return '';} else {return id;}	
	
}



// get cur page
function active_page() {
	return $('.pagination .active').text();
}


// total pages
function total_pages() {
	return $(".pagination li").length;
}


// if sorting click
$(function() {
	
	$(".sorting-radio input[type=radio]").click(function() {
		id = $(this).attr('id');
		get_messages_list(active_page(), id.replace('_', ' '));

	});
});
