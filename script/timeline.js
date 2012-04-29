// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

var site_url = "http://localhost/kit/";

$(document).ready(function()
{
    $("#timeline .year_title, #timeline .month_title").next().hide();
    $("#timeline .year_title, #timeline .month_title").click(function()
    {
        if ($(this).next().is(":visible"))
        {
            $(this).next().slideUp('fast');
        } else {
            $(this).next().slideDown('fast');
        }
    });
});
