        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <h1> Add a New Group </h1> <br/> <br/>
            <form method = "POST" action = "<?=url('group/add/data')?>">
                <input name = 'university' type = 'hidden' value = "<?=$this->university;?>"/>
                <div class = 'profile'>
                    <div class = 'row'>
                        <div class = 'title'>
                            Name
                        </div>
                        <div id = 'name'>
                            <input name = 'name' placeholder = "The new group's name" type = 'text' style = 'width: 250px;' />
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'>
                            Promotion
                        </div>
                        <div id = 'year_started'>
                            <input name = 'promotion' placeholder = "Promotion" type = 'text' style = 'width: 250px;'/>
                        </div>
                    </div>
					<div class = 'row'>
						<div class = 'title'>
							About
						</div>
						<div id = "group_about">
							<textarea name = "about" placeholder = "Describe the group in a few words"></textarea>
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
