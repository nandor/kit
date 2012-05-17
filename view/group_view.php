        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('group_short'); ?>
            </div> 
           <div id = "content" class = "profile">
					<div class = 'row'>
						<div class = 'title'>
							About
						</div>
						<div class = "value">
							<?php echo $this->group_data['about'];?>
						</div>
					</div>
					<div class = 'row'>
						<div class = 'title'>
							Members
						</div>
						<div class = "value">
							<?php
								foreach($this->users as $user)
								{
									echo $user['full_name'], "<br />";
								}
							?>
						</div>
					</div>
            <? $this->render_view('footer'); ?>
			</div>
		</div>
    </body>
</html>
