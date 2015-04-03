$('#username').keyup(function() {
	var id=0;
	var input=$('#username').val();
	$.ajax({        
		type: "POST",
		url: "ranking/getAllRanks",
		data: {
			'username':input 
		},
		success: function(data) 
		{
			output=JSON.parse(data);
			var username=input;
			if(typeof output.cf !=='undefined')
			{
				if(output['cf'][0]!='null' && $('.rating-list-cf>tbody>tr:last>td').html()!=output['cf'][0])
				{
					$('.rating-list-cf>tbody').remove();
					$('.rating-list-cf').append('<tbody>');
					$('.rating-list-cf>tbody').append('<tr><td>'+output['cf'][0]+'</td><td>'+output['cf'][1]+'</td></tr>');   
				}
			}
			if(typeof output.cc !=='undefined')
			{
				var count=(output.cc).length;
				if(count==7)
				{
					if(output['cc'][0]!='null' && $('.rating-list-cc>tbody>tr:last>td').html()!=output['cc'][0])
					{
						var types=['Long','Short','LTime(All)'];
						$('.rating-list-cc>tbody').remove();
						$('.rating-list-cc').append('<tbody>');
						var i;
						for(i=0;i<3;i++)
						{
							var type=types[i];
							if(i==0)
								$('.rating-list-cc>tbody').append('<tr><td>'+username+'</td><td>'+type+'</td><td>'+output['cc'][2*i+1]+'</td><td>'+output['cc'][2*i+2]+'</td></tr>');
							else
								$('.rating-list-cc>tbody').append('<tr><td></td><td>'+type+'</td><td>'+output['cc'][2*i+1]+'</td><td>'+output['cc'][2*i+2]+'</td></tr>');
						} 
					}
				}
				else if(count==9)
				{
					var types=['Long','Short','LTime','LTime(All)'];
					$('.rating-list-cc>tbody').remove();
					$('.rating-list-cc').append('<tbody>');
					var i;
					for(i=0;i<4;i++)
					{
						var type=types[i];
						if(i==0)
							$('.rating-list-cc>tbody').append('<tr><td>'+username+'</td><td>'+type+'</td><td>'+output['cc'][2*i+1]+'</td><td>'+output['cc'][2*i+2]+'</td></tr>');
						else
							$('.rating-list-cc>tbody').append('<tr><td></td><td>'+type+'</td><td>'+output['cc'][2*i+1]+'</td><td>'+output['cc'][2*i+2]+'</td></tr>');
					} 

				}
			}
		}	
	}); 
});
$('.clear-btn-cf').click(function(){
	$('.rating-list-cf>tbody').remove();
	$('.rating-list-cf').append('<tbody>');
});
$('.clear-btn-cc').click(function(){
	$('.rating-list-cc>tbody').remove();
	$('.rating-list-cc').append('<tbody>');
});