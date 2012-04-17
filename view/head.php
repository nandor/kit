<!DOCTYPE html>
<html>
    <head>
        <title> KIT </title>
        
        <script type = "text/javascript" src = "<?=url('script/jquery.js');?>"> </script>
        <script type = "text/javascript" src = "<?=url('script/main.js');?>"> </script>
        <link rel = "stylesheet" type = "text/css" href = "<?=url('style/main.css');?>" />
    </head>
    <body>
        <div id = "toolbar">
            <div>
                <div id = "searchbox">
                    <img src = "<?=url('img/sleft.png');?>" />
                    <input type = "text" placeholder = "Search..." />
                    <img src = "<?=url('img/sright.png');?>" />
                </div>
                <nav>
                    <a href = "<?url('');?>"> Home </a>
                </nav>
                <? if ($this->user): ?>
                    <div id = "userdata">
                    
                    </div>
                <? endif; ?>
            </div>
        </div>
    
