        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content" style = 'text-align: center;'>
                <? $this->render_view('messages'); ?>
                <h2> Edit: <?=$this->univ_profile['name'] ?> </h2>
                <form method = "POST" action = "<?=url('univ/save')?>">
                    <input name = 'id' type = 'hidden' value = '<?=$this->univ_profile['id']?>'/>
                    <div class = 'profile'>
                        <div class = 'row'>
                            <div class = 'title'>
                                Name
                            </div>
                            <div id = 'name'>
                                <input name = 'name' type = 'text' placeholder = "Your University's name" value = '<?=$this->univ_profile['name'];?>' />
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'title'> Address </div>
                            <div id = 'address'>
                                <input id = 'univ_address_input' name = 'address'  class = 'default_unknown' type = 'text' placeholder = "Street, Town, Country" />
                                <div class = 'addr_map'></div>
                            </div>
                        </div>
						<div class = 'row'>
							<div class = 'title'>
								About
							</div>
							<div id = "univ_about">
								<textarea name = "about" placeholder = "About"></textarea>
							</div>
						</div>
                        <div class = 'row'>
                            <div class = 'title'> Phone </div>
                            <div class = 'value'>
                                <input name = 'phone_number' type = 'text' placeholder = "University's Phone Number" />
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'title'> Email </div>
                            <div>
                                <input name = 'email' type = 'text' placeholder = "University's Email address" />
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'title'>
                                Save
                            </div>
                            <div>
                                <input type = 'submit' value = 'Submit'/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
