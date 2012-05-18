        <div id = "container">
            <div id = "sidebar">
                <? if (!$this->user->logged_in()): ?>
                <div id = "login">
                    <h3> Login </h3>
                    <form method = "POST" action = "<?=url('login');?>">
                        <div><input name = "user" type = "text" placeholder = "Username"/></div>
                        <div><input name = "pass" type = "password" placeholder = "Password"/></div>
                        <div>
                            <input type = "submit" value = "Login" />
                            <a href = "register"> Need an account? </a>
                        </div>
                    </form>                    
                </div>
                <? else: ?>
                <? $this->render_view('profile_short'); ?> 
                <? endif; ?>
            </div> 
            <div id = "content" style = 'text-align: center;'>
                <div class = 'profile'>
                    <h1><?=$this->univ_profile['name'];?></h1>
                    <div class = 'row'>
                        <div class = 'title'> About </div>
                        <div class = 'value'>
                            <?=$this->univ_profile['about'] ?>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'> Address </div>
                        <div class = 'value'>
                            <?=$this->univ_profile['address'] ?>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'> Email </div>
                        <div class = 'value'>
                            <?=$this->univ_profile['email'] ?>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'> Phone Number </div>
                        <div class = 'value'>
                            <?=$this->univ_profile['phone_number'] ?>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'>
                            Groups
                        </div>
                        <div id = 'groups'>
                            <div id = 'groups_list'>
                                <?
                                    while ($group = DB::next($this->groups))
                                    {
                                    	echo "<div>".
                                    		"<img width = '35' height = '35' alt = '{$group['name']}'".
                                    		"src = '".($group['picture'] ? content($group['picture']) : url('img/gdef.png'))."'/>".
                                    		"<a href = \"".url('group/'.$group['id'])."\">{$group['name']}</a>".
										 	"</div>";
									}
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    	if ($this->user->university == $this->univ_profile['id'])
                    	{
                    		?>
					        <div class = 'row'>
					            <div class = 'value'>
					            	<a href = "<?=url('group/add/'.$this->user->university);?>"> Add group </a>
				            	</div>
					        </div>
					        <div class = 'row'>
					            <div class = 'value'>
					            	<a href = "<?=url('univ/edit/'.$this->user->university);?>"> Edit </a>
				            	</div>
					        </div>
					        <?
						}
                    ?>
                </div>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
