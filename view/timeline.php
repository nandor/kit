        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div>
            <div id = 'timeline'>
            <?php
                $last_year = 0;
                $last_month = 0;
                $last_year = 0;
                
                $months = array(
                    'None', 'January', 'February', 'March', 
                    'April', 'May','June', 'July', 'August', 
                    'September', 'October', 'November', 'December'
                );
               
                foreach ($this->events as $event)
                {
                    $year = $month = $day = 0;
                    sscanf($event['date'], "%d-%d-%d", $year, $month, $day); 
                    
                    if ($last_year != $year)
                    {
                        if ($last_year != 0)
                        {
                            echo "</div></div></div></div></div>";
                        }
                        
                        ?>
                        <div class = 'year'>
                            <div class = 'year_title'><?=$year;?></div>
                            <div class = 'year_content'>
                        <?
                        
                        $last_year = $year;
                        $last_month = 0;
                        $last_day = 0;
                    }
                    
                    if ($last_month != $month)
                    {
                        if ($last_month != 0)
                        {
                            echo "</div></div></div>";
                        }
                        
                        ?>
                        <div class = 'month'>
                            <div class = 'month_title'><?=$months[$month];?></div>
                            <div class = 'month_content'>
                        <?
                        
                        $last_month = $month;
                        $last_day  = 0;
                    }
                    
                    if ($last_day != $day)
                    {
                    	if ($last_day != 0)
                    	{
							echo "</div>";
						}
						$last_day = $day;
						
						?><div class = 'event'>
		                    <div class = 'time'>
		                        On <?=date("jS", strtotime($event['date']));?> of <?=$months[$month];?>
		                    </div>
	                    <?
                    }
                    
                    $user = $this->users[$event['user']]; 
                    $self = $user['id'] == $this->user->id;
                    $who = "<a href = \"".url("profile/{$user['id']}")."\">".($self ? 'You' : $user['name'])."</a>";
                    ?><p><?                 
                    switch ($event['field'])
                    {
                        case 'profile':
                        {
                            print("$who uploaded a new profile picture: <img width = '60px' height = '60px'src = '".content($event['value'])."' />");
                            break;
                        }
                        case 'address':
                        {
                            print("$who changed ".($self ? "your" : "his")." address to <span class = 'value'>{$event['value']}</span>.");
                            break;
                        }
                        case 'email':
                        {
                            print("$who changed ".($self ? "your" : " his")." email address to <span class = 'value'>{$event['value']}</span>.");
                            break;
                        }
                        case 'full_name':
                        {
                            print("$who changed ".($self ? "your" : "his")." name to <span class = 'value'>{$event['value']}</span>.");
                            break;
                        }
                    }
                    
                    ?></p><?
                }
                
            ?>  
                </div></div></div></div></div>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
