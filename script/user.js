// This file is part of the licj11c KIT project
// Licensing information can be found in the LICENSE file
// (c) 2012 licj11c. All rights reserved.

var site_url = "http://localhost/kit/";
var file_size = 2 * 1024 * 1024;        // Max uploaded file size
var map, geocoder;

$(document).ready(function()
{
    init_upload();
    init_map();
});

function init_upload()
{    
    var elem = document.querySelector("#upload");
    var preview = elem.querySelector(".preview");
    var drop_zone = elem.querySelector(".drop_zone");
    var progress_holder = $(".progress", elem);
    var progress = $(".progress > div", elem);
    
    if (preview.src == "")
    {
        drop_zone.parentNode.style.color = "gray";
        preview.style.visibility = "hidden";
    }
    
    progress_holder.hide();
    
    drop_zone.addEventListener("dragenter", function(evt)
    {
        $(this).parent().removeClass('drop_normal').addClass('drop_over');
    });
    
    drop_zone.addEventListener("dragleave", function(evt)
    {
        $(this).parent().removeClass('drop_over').addClass('drop_normal');
    });
    
    drop_zone.addEventListener("dragover", function(evt)
    {
        evt.stopPropagation();
        evt.preventDefault();  
    });
    
    drop_zone.addEventListener("drop", function(evt)
    {
        evt.stopPropagation();
        evt.preventDefault();
         
        var files = evt.dataTransfer.files;
        
        $(this).parent().removeClass('drop_over').addClass('drop_normal'); 
        
        if (files.length != 1)
        {
            alert("A single file must be provided!");
            return false;
        }
        
        var file = files[0];
        var ext = file.fileName.split('.').pop();
        
        if (ext != "jpg" && ext != "jpeg" && ext != "gif" && ext != "png")
        {
            alert("Invalid file type!");
            return false;
        }
        
        if (file.fileSize > file_size)
        {
            alert("File is too large!");
            return false;
        }
        
        var reader = new FileReader();
        reader.onloadend = function(evt)
        {
            preview.style.visibility = "visible";
            preview.src = evt.target.result;                        
            drop_zone.parentNode.style.color = "white";
            
            var xhr = new XMLHttpRequest();
            xhr.open("POST", site_url + "user/upload/" + ext); 
            
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader("X-File-Name", encodeURIComponent(name));
            xhr.setRequestHeader("Content-Type", "application/octet-stream");
            
            xhr.upload.addEventListener("progress", function(evt)
            {
                progress.css("width", parseInt(evt.loaded / evt.total) + "%");
            }, false);
            
            xhr.upload.addEventListener("load", function(evt)
            {
                progress_holder.hide();
            }, false);
            
            progress_holder.show();
            xhr.send(file);
        };
        
        reader.readAsDataURL(file);
        
        return false;
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
                console.log(results[0].geometry.location);
                
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
    {console.log("A");
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) 
        {
            if (status == google.maps.GeocoderStatus.OK && results[1])
            {
                $("#address input").val(results[1].formatted_address);
            }
        });
    });
}


