// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

$(document).ready(function()
{
    init_map();
});

function init_map()
{
    var map_holder = document.querySelector("#trail");
    var map_center = new google.maps.LatLng(46.75, 23.6);
    var myOptions = {
        zoom: 3,
        center: map_center,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(map_holder, myOptions);
    geocoder = new google.maps.Geocoder();   
    
    var num_points = trail.length, points_left = trail.length;
    var res_points = [];
    
    for (var loc in trail)
    {
        geocoder.geocode({'address': trail[loc]}, function(results, status) 
        {
            points_left --;
            if (status == google.maps.GeocoderStatus.OK) 
            {
                res_points[this] = results[0].geometry.location;
            }
            
            if (points_left <= 0)
            {
                var line = [];
                for (var i in res_points)
                {
                    if (res_points[i])
                    {
                        line.push(res_points[i]);
                    }
                }               

                console.log(line);
                var path = new google.maps.Polyline({
                    path: line,
                    strokeColor: "#FF0000",
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });
                
                path.setMap(map);
            }
        }.bind(loc));            
    }
}
