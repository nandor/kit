<div id = "messages">
<?
    if (isset($_SESSION['messages']))
    {
        foreach ($_SESSION['messages'] as $message)
        {
            echo "<div class = \"".($message['type'] ? 'okay' : 'error')."\">{$message['msg']}</div>";
        }
        
        unset($_SESSION['messages']);
    }    
?>
</div>
