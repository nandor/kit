// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

$(function()
{
    $("#searchbox > input")
        .keyup(function()
        {
            var name = $(this).val();
            if (name == '')
            {
                $("#searchresult").hide();
                return;
            }
            
            $.ajax({
                type: 'POST',
                url: site_url + "api/search/", 
                dataType: 'json',
                data: {
                    what: name
                },
                success: function(res)
                {
                    if (!res || res.status != 'success')
                    {
                        return;
                    }
                       
                    $("#searchresult > div").html('');
                    if (res.data.people)
                    {
                        for (var i in res.data.people)
                        {
                            $("#searchresult > #peopleresult").append(
                                "<a href = '" + site_url + "profile/" + i + "'><img src = '" + res.data.people[i].img + "'/>" + res.data.people[i].name + "</div>"
                            );
                        }
                    }
                    else
                    {
                        console.log("A");
                        $("#searchresult > #peopleresult").html(
                            '<div style = "text-align:center">No people named "' + name + '" found!</div>'
                        );
                    }
                    
                    $("#searchresult").show();
                }
            });
        })
        
    $("#searchresult")
        .click(function(evt)
        {
            evt.stopPropagation();
        })
        .hide();
    
    $(document.body).click(function()
    {
        $("#searchresult").hide();
    });
});

