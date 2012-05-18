<div id = 'group'>
    <? if ($this->group_data['picture']): ?>
        <img src = "<?=content($this->group_data['picture']);?>" width = "120" height = "120" />
    <? else: ?>
        <img src = "<?=url('img/gdef.png');?>" width = "120" height = "120" />
    <? endif; ?>
    
    <div><span class = 'title'>Group name</span> <?=$this->group_data['name'];?> </div>
    <div><span class = 'title'>University</span> <?= $this->group_data['university_name']; ?></div>
    <div><span class = 'title'>Promotion</span> <?= $this->group_data['promotion']; ?></div>
    <div><a href="<?=url("group/edit/{$this->group_data['id']}");?>">Edit this group</a><br /></div>     
</div>
