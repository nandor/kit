// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

$(document).ready(function()
{
    $(window).resize(layout);
    layout();
});

function layout()
{
    var height;
    
    height = Math.max($("#sidebar").height(), $("#content").height());
    
    $("#sidebar").css("height", height);
    $("#content").css("height", height);
    $("footer").css("top", height + 50);
    $("#container").css("height", height + 50);
}
