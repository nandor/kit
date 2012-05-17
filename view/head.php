<!DOCTYPE html>
<html>
    <head>
        <title> KIT </title>
        
        <link rel = "stylesheet" type = "text/css" href = "<?=url('style/main.css');?>" />
        
        <script type="text/javascript" src="<?=url('script/jquery.js');?>"></script>
        <script type="text/javascript" src="<?=url('script/searchbox.js');?>"></script>
        <?php
            if ($this->scripts)
            {
                foreach ($this->scripts as $script)
                {
                    echo "<script type=\"text/javascript\" src=\"$script\"></script>";
                }
            }
        ?>
        <script type = "text/javascript">
            var site_url = "<?="{$cfg['host']}{$cfg['base_url']}/";?>";
        </script>
    </head>
    <body>
        <div id = "toolbar">
            <div>
                <div id = "searchbox">
                    <input type = "text" placeholder = "Search..." />
                    <div id = "searchresult">
                        <span>People</span>
                        <div id = "peopleresult">
                        
                        </div>
                        <span>Groups</span>
                        <div id = "groupresult">
                        
                        </div>
                        <span>Universities</span>
                        <div id = "univresult">
                        
                        </div>
                        <a class = 'advsearch' href ="<?=url('search');?>">Advanced search</a>
                    </div>
                </div>
                <script type = "text/javascript" src = "<?=url('script/searchbox.js');?>"></script>
                <nav>
                    <a href = "<?=url('');?>"> Home </a>
                    <? if ($this->user && $this->user->logged_in()): ?>    
                        <a href = "<?=url('user/edit');?>">Profile</a>
                        <a href = "<?=url('timeline');?>">Timeline</a>
                        <a href = "<?=url('logout');?>">Logout</a>
                    <? endif; ?>
                </nav>
            </div>
        </div>
    
