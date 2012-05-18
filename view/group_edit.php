        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?>
            </div> 
            <div id = "content" class = "profile">
                <? $this->render_view('messages'); ?>
				<div class = 'row'>
                    <div class = 'title'>
                        Group picture
                    </div>
                    <div id = 'upload' data-url = "<?=url('/group/upload/');?>">   
                        <div class = "drop_normal">
                            <img class = "preview" width = "120" height = "120"/>
                            <div class = "text">Drag here to upload</div>
                            <div class = "drop_zone"></div>
                        </div>
                    </div>
                </div>
				<form method = "POST" action = "<?=url('group/save');?>">
					<div class = 'row'>
						<div class = 'title'>
							Name
						</div>
						<div id = "group_name">
							<input type = "text" name = "name" placeholder = "Name"/>
						</div>
					</div>
					<div class = 'row'>
						<div class = 'title'>
							Promotion
						</div>
						<div class = 'value'>
							<input type = "text" name = "promotion" placeholder = "Promotion"/>
						</div>
					</div>
					<div class = 'row'>
						<div class = 'title'>
							About
						</div>
						<div class = 'value'>
							<textarea name = "about" placeholder = "About"></textarea>
						</div>
					</div>
					<div class = 'row'>
						<div class = 'title'>
							Save
						</div>
						<input type = "submit" value = "Submit" />
					</div>
				</form>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
