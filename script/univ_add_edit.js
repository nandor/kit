// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.


$(document).ready(function()
{
    var map_holder = document.querySelector("#address .addr_map");
    var map_center = new google.maps.LatLng(46.75, 23.6);
    var myOptions = {
        zoom: 3,
        center: map_center,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(map_holder, myOptions);
    geocoder = new google.maps.Geocoder();   
   
    var marker = new google.maps.Marker({
        map: map,
        position: map_center,
        draggable: true
    });     
    
    init_marker(marker);
    
    $("#address input").keyup(function()
    {
        var address = $("#address input").val();
             
        geocoder.geocode({'address': address}, function(results, status) 
        {
            if (status == google.maps.GeocoderStatus.OK) 
            {
                map.setCenter(results[0].geometry.location);
 
                if (marker)
                {
                    marker.setMap(null);           
                }
                
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    draggable: true
                });
                
                init_marker(marker);
            }
        });
    });
});


function init_marker(marker)
{
    google.maps.event.addListener(marker, 'dragend', function() 
    {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) 
        {
            if (status == google.maps.GeocoderStatus.OK && results[1])
            {
                $("#address input").val(results[1].formatted_address);
            }
        });
    });
}
