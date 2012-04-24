<!DOCTYPE html>
<html>
    <head>
        <title> KIT </title>
        <link rel = "stylesheet" type = "text/css" href = "<?=url('style/main.css');?>" />
    </head>
    <body>
        <div id = "toolbar"></div>
        <div id = "error_mbox">
            <span class = "title">Ooops!</span>
            <p class = "error"><?=$exception->getMessage();?></p>
            <span>
            <?php 
                global $cfg;
                
                if ($cfg['debug'])
                {
                    echo "[{$exception->getFile()}:{$exception->getLine()}]";
                }
            ?>
            </span>
            <a class = "home" href = "<?=url('');?>"> Home </a>
            <div class = "footer">
                <p>
                    <a href = "<?=url('about');?>">About</a> |
                    <a href = "<?=url('about');?>">Credits</a> |
                    <a href = "<?=url('about');?>">License</a>
                </p>
                &copy; 2012 licj11c Team. All rights reserved.
            </div>
        </div>
    </body>
</html>
