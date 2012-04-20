<!DOCTYPE html>
<html>
    <head>
        <title> KIT </title>
        
        <?php
            if ($this->scripts)
            {
                foreach ($this->scripts as $script)
                {
                    echo "<script type=\"text/javascript\" src=\"$script\"></script>";
                }
            }
        ?>
        
        <link rel = "stylesheet" type = "text/css" href = "<?=url('style/main.css');?>" />
    </head>
    <body>
        <div id = "toolbar">
            <div>
                <div id = "searchbox">
                    <input type = "text" placeholder = "Search..." />
                </div>
                <nav>
                    <a href = "<?=url('');?>"> Home </a>
                    <? if ($this->user->logged_in()): ?>    
                        <a href = "<?=url('user');?>">Profile</a>
                        <a href = "<?=url('timeline');?>">Timeline</a>
                        <a href = "<?=url('logout');?>">Logout</a>
                    <? endif; ?>
                </nav>
            </div>
        </div>
    
