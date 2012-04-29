        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div>
            <div id = 'timeline'>
            <?php
                $last_year = 0;
                $last_month = 0;
                
                $months = array(
                    'None', 'January', 'February', 'March', 
                    'April', 'May','June', 'July', 'August', 
                    'September', 'October', 'November', 'December'
                );
                
                foreach ($this->events as $event)
                {
                    $year = $month = 0;
                    sscanf($event['date'], "%d-%d-%*d", $year, $month); 
                    
                    if ($last_year != $year)
                    {
                        if ($last_year != 0)
                        {
                            echo "</div></div></div></div>";
                        }
                        
                        ?>
                        <div class = 'year'>
                            <div class = 'year_title'><?=$year;?></div>
                            <div class = 'year_content'>
                        <?
                        
                        $last_year = $year;
                        $last_month = 0;
                    }
                    
                    if ($last_month != $month)
                    {
                        if ($last_month != 0)
                        {
                            echo "</div></div>";
                        }
                        
                        ?>
                        <div class = 'month'>
                            <div class = 'month_title'><?=$months[$month];?></div>
                            <div class = 'month_content'>
                        <?
                        
                        $last_month = $month;
                    }
                    
                    $user = $this->users[$event['user']]; 
                    $self = $user['id'] == $this->user->id;
                    $who = "<a href = \"".url("profile/{$user['id']}")."\">".($self ? 'You' : $user['name'])."</a>";
                                   
                    ?><div class = 'event'>
                        <div class = 'time'>
                            On <?=date("jS", strtotime($event['date']));?> of <?=$months[$month];?>
                        </div>
                    <?
                    
                    switch ($event['field'])
                    {
                        case 'profile':
                        {
                            print("$who uploaded a new profile picture: <img width = '60px' height = '60px'src = '".content($event['value'])."' />");
                            break;
                        }
                        case 'address':
                        {
                            print("$who changed ".($self ? "your" : "his")." address to {$event['value']}.");
                            break;
                        }
                    }
                    
                    ?></div><?
                }
                
            ?>  
                </div></div></div></div>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
