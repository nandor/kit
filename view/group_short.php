<div id = 'profile'>
	<div> Group image </div>
	<div class = "value"> 
		<?php echo $this->group_data['name']; ?> 
	</div>
	<div> Promotion </div>
    <a href="<?=url("group/edit/{$this->group_data['id']}");?>">Edit</a><br />
</div>
