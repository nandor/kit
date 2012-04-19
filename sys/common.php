<?
    /**
        File to store common functions
    */
    
    function url($link)
    {
        global $cfg;
        
        return "{$cfg['host']}{$cfg['base_url']}/$link";
    }  
    
    function content($file)
    {
        global $cfg;
        
        return "{$cfg['host']}{$cfg['base_url']}/{$cfg['dir']['content']}$file";
    }
?>
