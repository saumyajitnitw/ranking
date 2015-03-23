
$(document).ready(function(){
	$('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
  });
});


$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});


$('#username').keyup(function() {
	var id=0;
	var input=$('#username').val();
	var x="";
	$.ajax({        
		type: "POST",
		url: "ranking/getAllRanks",
		data: {
			'username':input 
		},
		success: function(data) {
			input=JSON.parse(data);
			if(input[0]!='null')
			{
				$('.rating-list>tbody').remove();
				$('.rating-list').append('<tbody>');
				$('.rating-list').append('<tbody><tr><td>'+input[0]+'</td><td>'+input[1]+'</td></tr></tbody>');   
			}
			else
			{
				$('.rating-list>tbody').remove();
				$('.rating-list').trigger(toast('The user does not have a rating or does not exist', 400,'rounded'));
			}
		}	
	}); 
	var z=1;
	//alert(x);
});