        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?>
            </div> 
           <div id = "content" class = "profile">
                <div class = 'row'>
                    <div class = 'value'>
                        <img width = "130" height = "130" alt = "group-pic" itemprop = "image" src = "
                            <?=$this->group_data['picture'] ? content($this->group_data['picture']) : url('img/gdef.png');?>" />
                    </div>
                </div>
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
						University
					</div>
					<div class = "value">
						<?php echo $this->group_data['university_name'];?>
					</div>
				</div>
				<div class = 'row'>
					<div class = 'title'>
						Promotion
					</div>
					<div class = "value">
						<?php echo $this->group_data['promotion'];?>
					</div>
				</div>
				<div class = 'row'>
					<div class = 'title'>
						Members
					</div>
					<div class = "value group_list">
						<?php
							foreach($this->users as $user)
							{
								if (!$this->user->logged_in() && !$user['visible'])
								{
									continue;
								}
								echo "<div>".
									 "<img alt = '{$user['full_name']}' src = '".content($user['profile'])."'/>{$user['full_name']} ".
									 "&lt;<a href = 'mailto:{$user['email']}'>{$user['email']}</a>&gt;".
								 	"</div>";
							}
						?>
					</div>
				</div>
				<div class = 'row'>
					<div class = 'title'>
						Timeline
					</div>
					<div class = "value">
						<a href = "<?=url('timeline/group/'.$this->group_data['id']);?>">View group timeline</a>
					</div>
				</div>
				<? if ($this->user->logged_in()): ?>
					<div class = 'row'>
						<div class = 'title'>
							Join
						</div>
						<div class = "value">
							<a href = "<?=url('group/join/'.$this->group_data['id']);?>">Join this group</a>
						</div>
					</div>
				<? endif; ?>
				<div class = 'row'>
					<div class = 'title'>
						Edit
					</div>
					<div class = "value">
						<a href = "<?=url('group/edit/'.$this->group_data['id']);?>">Edit group</a>
					</div>
				</div>
			</div>
            <? $this->render_view('footer'); ?>
		</div>
    </body>
</html>
