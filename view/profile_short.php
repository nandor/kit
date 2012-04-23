<div id = 'profile'>
    <? if ($this->user->profile): ?>
        <img src = "<?=content($this->user->profile);?>" width = "120" height = "120" />
    <? else: ?>
        <img src = "<?=url('img/pdef.png');?>" width = "120" height = "120" />
    <? endif; ?>
    
    <?= $this->user->name; ?><br />
    <?= date("F j, o", $this->user->time_registered); ?>
</div>
