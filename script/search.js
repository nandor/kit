// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

var filter = {
    "name": {"dir": false, "val": ""},
    "addr": {"dir": false, "val": ""},
    "edu": {"dir": false, "val": ""},
    "work": {"dir": false, "val": ""},
    "page": 0
};

var count = 0, waiting = false;

$(function()
{
	$(".filter .row").each(function()
	{
		count++;
		$(this).addClass((count & 1) ? "odd" : "even");
	});
			
	$(".filter .more").click(function()
	{
		filter['page']++;
		get_users();
	});
	
	$(".filter img").click(function()
	{  	   
	   var id = $(this).attr("data-filter");
	   filter[id].dir = !filter[id].dir;
	   
	   $(this).attr("src", site_url + "img/sort_" + (filter[id].dir ? "up" : "down") + ".png");
       
       filter['column'] = id;
       filter['page'] = 0;
       
       $(".filter .row").remove();
       count = 0;
	   get_users();
	});
    
    $(".filter input[type='text']").keyup(function()
    {
        filter['name'].val = $(".filter input[name='name']").val();
        filter['addr'].val = $(".filter input[name='addr']").val();
        filter['edu'].val = $(".filter input[name='edu']").val();
        filter['work'].val = $(".filter input[name='work']").val();
        filter['page'] = 0;
        
       $(".filter .row").remove();
       count = 0;
        get_users();
    });
});

function get_users()
{
	if (waiting)
	{
		return;
	}
	
	waiting = true;
    $.ajax({
        type: 'POST',
        url: site_url + "api/filter/", 
        dataType: 'json',
        data: {
            filter: JSON.stringify(filter)
        },
        success: function(res)
        {
        	waiting = false;
        	if (!res || !res.data || !res.data.users)   
            {
                $(".filter .more").hide();
            	return;
            }
            
        	for (var i in res.data.users)
        	{	
        		var user = res.data.users[i];
        		
    			++count;
        		$(".filter .more").before(
        			"<tr class = 'row " + ((count & 1) ? "odd" : "even") +"'>" +
        				"<td><a href='" + site_url + "/profile/" + user.id + "'>" + user.name + "</a></td>" +
        				"<td>" + user.addr + "</td>" + 
        				"<td>" + user.univ + "</td>" + 
        				"<td>" + user.work + "</td>" +
        			"</tr>"
    			);
        	}
        	
            if (!res.data.more)
            {
                $(".filter .more").hide();
            }
            else
            {
        		$(".filter .more").show();
    		}
        }
    });
}

