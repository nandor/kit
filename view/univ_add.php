        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
		        <h1> Add a new University </h1>
		        <form method = "POST" action = "<?=url('univ/add/save')?>">
                <div class = 'profile'>
                    <div class = 'row'>
                        <div class = 'title'> Name</div>
                        <div class = 'value'>
                            <input name = 'name' placeholder = "Your University's name" type = 'text' />
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'>Address</div>
                        <div class = 'value' id = "address">
                            <input id = 'univ_address_input' name = 'address' placeholder = "Street, Town, Country" type = "text" />
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
                        <div class = 'title'>Submit</div>
                        <div class = 'value'>
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
