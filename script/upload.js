

$(function ()
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
            xhr.open("POST", $(elem).attr("data-url") + ext); 
            
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
});

