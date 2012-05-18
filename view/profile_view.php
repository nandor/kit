        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?>       
            </div> 
            <div id = "content" class = 'profile' itemscope itemtype="http://schema.org/Person">
                <div style = "visibility:hidden" itemprop = "url"><?=url("profile/{$this->user->id}");?></div>
                <div class = 'row'>
                    <div class = 'value'>
                    	<a href = "<?=url('timeline/'.$this->user_data['id']);?>">
                        <img width = "130" height = "130" alt = "profile" itemprop = "image" src = "
                            <?=$this->user_data['profile'] ? content($this->user_data['profile']) : url('img/pdef.png');?>" />
                        </a>
                    </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Full Name </div>
                    <div class = 'value' itemprop = 'name'> <?=$this->user_data['full_name'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Email Address </div>
                    <div class = 'value' itemprop = 'email'> <?=$this->user_data['email'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Birthday </div>
                    <div class = 'value' itemprop = 'birthDate'> <?=date("F j, o", strtotime($this->user_data['birthday']));?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Date joined </div>
                    <div class = 'value' itemprop = 'dateCreated'> <?=date("F j, o", $this->user_data['time_registered']);?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Address </div>
                    <div class = 'value' itemprop = 'address'> <?=$this->user_data['address'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Workplace </div>
                    <div class = 'value' itemprop = 'address'> <?=$this->user_data['workplace'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Job </div>
                    <div class = 'value' itemprop = 'address'> <?=$this->user_data['job'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Interests </div>
                    <div class = 'value' itemprop = 'address'> <?=$this->user_data['hobby'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Group </div>
                    <div class = 'value'>
                    	<?php
                    		if ($this->user_data['group'])
                    		{
				            	echo '<a href = "'.url('group/'.$this->user_data['group']).'">';
				            	echo $this->user_data['group_name'].'</a>';
			            	}
		            	?>
                    </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> University </div>
                    <div class = 'value'>
                    	<?php
                    		if ($this->user_data['university'])
                    		{
				            	echo '<a href = "'.url('univ/profile/'.$this->user_data['university']).'">';
				            	echo $this->user_data['university_name'].'</a>';
			            	}
		            	?>
                    </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Trail </div>
                    <div class = 'value'>
                        <div id = "trail"></div>
                        <script type = "text/javascript">
                            var trail = [
                            <?php
                                foreach($this->user_trail as $location)
                                {
                                    print("\"{$location['value']}\",");
                                }
                            ?>
                            ];
                        </script>
                    </div>
                </div>  
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
