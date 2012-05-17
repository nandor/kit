        <div id = "container">
            <div id = "sidebar">
                <div> Group image </div>
				<div> Group </div>
				<div> Promotion </div>
            </div> 
            <div id = "content" class = "profile">
					<div class = 'row'>
                        <div class = 'title'>
                            Group picture
                        </div>
                        <div id = 'upload'>   
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
								Group
							</div>
							<div id = "group_name">
								<input type = "text" name = "name" placeholder = "Group"/>
							</div>
						</div>
						<div class = 'row'>
							<div class = 'title'>
								Promotion
							</div>
							<div id = "group_promotion">
								<input type = "text" name = "promotion" placeholder = "Promotion"/>
							</div>
						</div>
						<div class = 'row'>
							<div class = 'title'>
								About
							</div>
							<div id = "group_about">
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
