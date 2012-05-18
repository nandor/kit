// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

var page = 1;
var per_page = 10;

$(function ()
{
	function get_page(num_page)
	{    
		if(num_page > num_pages || num_page < 1) {
		    alert('Invalid page number!');
		    return;
		}
		
		$.ajax({
		    url: site_url + "univ/" + num_page,
		    type: 'POST',
		    dataType: 'json',
		    success: function(result) {
		        if(num_page == 1) {
		            $('#prev_button').attr('disabled', 'disabled');
		        } else {
		            $('#prev_button').removeAttr('disabled');
		        }
		        
		        if(num_page == num_pages) {
		            $('#next_button').attr('disabled', 'disabled');
		        } else {
		            $('#next_button').removeAttr('disabled');
		        }
		        
		        $("#univ_table .row").remove();
		        
		        var i, key;
		        for(i = 0; i < result.length; i++)
		        {
		        	$(".last").before(
		        		"<tr class = 'row " + ((i & 1) ? "odd" : "even") + "'>" +
		            		"<td><a href = \"" + site_url + 'univ/profile/' + result[i]['id'] + "\">" +
		            			result[i]['name'] +
		        			"</a></td>" + 
                        	"<td>" + result[i]['address'] + "</td>" +
                        	"<td>" + result[i]['phone_number'] + "</td>" +
                        	"<td><a href = \"mailto:" + result[i]['email'] + "\">" + result[i]['email'] + "</a></td>" +
		        		"</tr>"
					);
		        }
		    },
		    error: function(jqXHR, textStatus, errorThrown) {
		        alert('Error getting ' + url + ' (called from \"univ_table.js\"). Error: ' + textStatus + ': ' + errorThrown);
		    }
		});
	}
	
	$("#next_button").click(function ()
	{
		page++;
		get_page(page);
	});
	
	$("#prev_button").click(function ()
	{
		page--;
		get_page(page);
	});
	
	$("#goto_button").click(function ()
	{
		page = parseInt($('#page_number_input').val());
		get_page(page);
	});
	
	$("#prev_button").attr("disabled", "disabled");
	
	if (page >= num_pages)
	{
		$("#next_button").attr("disabled", "disabled");
	}
});
