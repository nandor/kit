// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

var map, geocoder;

$(document).ready(function()
{
    init_facebook();
    init_map();
});

function OnLoadCallback()
{
    init_google();
}

function init_facebook()
{
    window.fbAsyncInit = function() {
        FB.init({
            appId      : fb_app_id,
            channelUrl : fb_channel_url,
            status     : true,
            cookie     : true,
            xfbml      : true  // parse XFBML
        });
    };

    (function(d){
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
    
    $("#facebook_import").click(function()
    {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                var uid = response.authResponse.userID;
                var accessToken = response.authResponse.accessToken;
                
                fb_import_data();
            } else {
                FB.login(function(response) {
                    if (response.status == 'connected')
                    {
                        fb_import_data();
                    } else {                    
                        alert("Cannot connect to Facebook!");
                    }
                }, {
                    scope: fb_scope
                });
            }
        });
    });
    
    function fb_import_data()
    {
        FB.api('/me', function(response) {
            
            if (response.name)
            {
                $('input[name="full_name"]').val(response.name);
            }
            
            if (response.location)
            {
                $('input[name="address"]').val(response.location.name);
            }
            
            if (response.email)
            {
                $('input[name="email"]').val(response.email);
            }
            
            if (response.work && response.work[0])
            {
            	work = response.work[0];
            	$('input[name="workplace"]').val(work.employer.name);
            	$('input[name="job"]').val(work.position.name);
            }
        });
    }
}

function init_google()
{
    gapi.client.load('oauth2', 'v2', function() {    
        gapi.client.setApiKey('AIzaSyCrOywnmHqUvUjDsd2f8V4KA5K53QIHHG8');

        $("#google_import").click(function()
        {           
            gapi.auth.authorize({
                client_id: google_client_id, 
                scope: google_scopes, 
                immediate: true
            }, function (response)
            {	
            	if (response)
            	{
          			var request = gapi.client.oauth2.userinfo.get();
			  		request.execute(function (response)
			  		{
						if (response.name)
						{
						    $('input[name="full_name"]').val(response.name);
						}
						
						if (response.location)
						{
						    $('input[name="address"]').val(response.location.name);
						}
						
						if (response.email)
						{
						    $('input[name="email"]').val(response.email);
						}
						
						if (response.work && response.work[0])
						{
							work = response.work[0];
							$('input[name="workplace"]').val(work.employer.name);
							$('input[name="job"]').val(work.position.name);
						}
			  		});
            	}
            });
        });
    });
}

function init_map()
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
}

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


